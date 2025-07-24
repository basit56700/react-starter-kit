<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'module:up')]
class ModuleUp extends Command
{
    protected $description = 'Create a module with web.php, controller, and React view';

    protected $signature = 'module:up {module} {controller}';

    public function handle()
    {
        $module = Str::studly($this->argument('module'));
        $controller = Str::studly($this->argument('controller'));

        $basePath = app_path("Modules/{$module}");

        if (File::exists($basePath)) {
            $this->warn("❗ Module '{$module}' already exists.");
            return;
        }

        // Create module folder
        File::makeDirectory($basePath, 0755, true, true);

        // Create controller
        $controllerPath = "{$basePath}/{$controller}.php";
        File::put($controllerPath, $this->controllerTemplate($module, $controller));
        $this->info("✅ Created controller: {$controllerPath}");

        // Create web.php
        $routePath = "{$basePath}/web.php";
        File::put($routePath, $this->routeTemplate($module, $controller));
        $this->info("✅ Created routes file: {$routePath}");

        // Create React view
        $reactPath = resource_path("js/Pages/{$module}");
        $viewFile = "{$reactPath}/Index.jsx";

        if (!File::exists($reactPath)) {
            File::makeDirectory($reactPath, 0755, true);
        }

        File::put($viewFile, $this->reactViewTemplate($module));
        $this->info("✅ Created React view: {$viewFile}");

        $this->info("🎉 Module '{$module}' created successfully.");
    }

    protected function controllerTemplate($module, $controller)
    {
        return <<<PHP
<?php

namespace App\Modules\\{$module};

use Illuminate\Routing\Controller;
use Inertia\Inertia;

class {$controller} extends Controller
{
    public function index()
    {
        return Inertia::render('{$module}/Index');
    }
}
PHP;
    }

    protected function routeTemplate($module, $controller)
    {
        $lowerModule = strtolower($module);
        return <<<PHP
<?php

use Illuminate\Support\Facades\Route;
use App\Modules\\{$module}\\{$controller};

Route::get('/{$lowerModule}', [{$controller}::class, 'index']);
PHP;
    }

    protected function reactViewTemplate($module)
    {
        return <<<JSX
import React from 'react';

export default function Index() {
    return (
        <div className="p-4">
            <h1 className="text-2xl font-bold">{$module} Module</h1>
            <p>This is the React view for the {$module} module.</p>
        </div>
    );
}
JSX;
    }
}
