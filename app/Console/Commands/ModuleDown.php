<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:down')]
class ModuleDown extends Command
{
    protected $description = 'Delete a module and its files';

    protected $signature = 'module:down {module}';

    public function handle()
    {
        $module = Str::studly($this->argument('module'));

        $backendPath = app_path("Modules/{$module}");
        $frontendPath = resource_path("js/Pages/{$module}");

        $deletedAnything = false;

        // Delete backend
        if (File::exists($backendPath)) {
            File::deleteDirectory($backendPath);
            $this->info("Deleted: {$backendPath}");
            $deletedAnything = true;
        } else {
            $this->warn("Backend module not found: {$backendPath}");
        }

        // Delete frontend (optional)
        if (File::exists($frontendPath)) {
            File::deleteDirectory($frontendPath);
            $this->info("Deleted: {$frontendPath}");
            $deletedAnything = true;
        } else {
            $this->warn("Frontend module not found: {$frontendPath}");
        }

        if (!$deletedAnything) {
            $this->error("Nothing to delete for module '{$module}'.");
        } else {
            $this->info("Module '{$module}' deleted successfully.");
        }
    }
}
