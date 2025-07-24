<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;
#[AsCommand(name: 'make:module')]
class MigrateFromJson extends Command
{
    protected $signature = 'migrate:from-json';
    protected $description = 'Migrate multiple tables using a JSON config';

    public function handle()
    {
        $this->info("🔄 Starting JSON-based migration...");

        $jsonPath = storage_path('app/migrations/map.json');

        if (!file_exists($jsonPath)) {
            $this->error("❌ Mapping file not found: $jsonPath");
            return;
        }

        $tableConfigs = json_decode(file_get_contents($jsonPath), true);

        if (!is_array($tableConfigs)) {
            $this->error("❌ Invalid JSON structure.");
            return;
        }

        foreach ($tableConfigs as $legacyTable => $config) {
            // Transform flat style JSON to expected structure
            if (isset($config['new_table']) && isset($config['columns'])) {
                $config['legacy_table'] = $legacyTable;
                $config['target_table'] = $config['new_table'];
            } else {
                $this->warn("⚠️ Skipping $legacyTable: invalid format.");
                continue;
            }

            $this->migrateTable($config);
        }

        $this->info("✅ All tables processed.");
    }

    protected function migrateTable(array $config)
    {
        $legacyTable = $config['legacy_table'];
        $targetTable = $config['target_table'];
        $columns     = $config['columns'];
        $uniqueBy    = $config['unique_by'] ?? null;

        $this->info("➡️ Migrating: $legacyTable → $targetTable");

        try {
            $rows = DB::connection('legacy')->table($legacyTable)->get();
        } catch (Throwable $e) {
            $this->error("❌ Failed to fetch data from $legacyTable: " . $e->getMessage());
            return;
        }

        $migrated = 0;

        foreach ($rows as $row) {
            try {
                $data = [];

                foreach ($columns as $newCol => $oldCol) {
                    if (is_array($oldCol)) {
                        $values = array_map(fn($col) => $this->cleanValue($row->$col ?? null), $oldCol);
                        $data[$newCol] = trim(implode(' ', $values));
                    } else {
                        $value = $row->$oldCol ?? null;
                        $data[$newCol] = $this->cleanValue($value);
                    }
                }

                if ($uniqueBy && isset($data[$uniqueBy])) {
                    DB::table($targetTable)->updateOrInsert(
                        [$uniqueBy => $data[$uniqueBy]],
                        $data
                    );
                } else {
                    DB::table($targetTable)->insert($data);
                }

                $migrated++;

            } catch (Throwable $e) {
                $this->warn("⚠️ Warning: Failed to migrate row from '$legacyTable': " . $e->getMessage());
                continue;
            }
        }

        $this->info("✅ Done: $migrated rows migrated from $legacyTable.");
    }

    protected function cleanValue($value)
    {
        if (is_string($value)) {
            $value = trim($value);
        }

        if (in_array($value, ['0000-00-00', '0000-00-00 00:00:00', ''], true)) {
            return null;
        }

        return $value;
    }
}
