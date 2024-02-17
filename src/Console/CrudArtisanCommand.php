<?php

namespace MWGuerra\CrudArtisan\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrudArtisanCommand extends Command
{
    protected $signature = 'mwguerra:crud-generate {model : The model class name}';
    protected $description = 'Generate CRUD operations for a model with Inertia Vue';

    public function handle()
    {
        $modelName = $this->argument('model');
        $controllerName = Str::studly($modelName) . 'Controller';
        $tableName = Str::snake(Str::pluralStudly($modelName));
        $columns = $this->getTableColumns($tableName);

        $this->generateController($modelName, $controllerName);
        $this->generateVueFiles($modelName, $columns);

        $this->info("CRUD for $modelName generated successfully.");
    }

    protected function getTableColumns($tableName)
    {
        return Schema::getColumnListing($tableName); // Returns an array of column names
    }

    protected function generateController($modelName, $controllerName)
    {
        $modelClass = "App\\Models\\$modelName";
        $modelNamePluralLowerCase = Str::plural(Str::snake($modelName));
        $modelNameSingularLowerCase = Str::snake($modelName);

        $controllerTemplate = str_replace(
            ['{{modelName}}', '{{controllerName}}', '{{modelNamePluralLowerCase}}', '{{modelNameSingularLowerCase}}'],
            [$modelClass, $controllerName, $modelNamePluralLowerCase, $modelNameSingularLowerCase],
            file_get_contents(__DIR__.'/stubs/controller.stub')
        );

        if (!is_dir($directory = app_path('Http/Controllers'))) {
            mkdir($directory, 0755, true);
        }

        file_put_contents(app_path("Http/Controllers/{$controllerName}.php"), $controllerTemplate);

        $this->info("$controllerName generated successfully.");
    }


    protected function generateVueFiles($modelName, $columns)
    {
        $modelNamePluralLowerCase = Str::plural(Str::snake($modelName));
        $views = ['index', 'show', 'edit'];

        foreach ($views as $view) {
            $vueTemplate = str_replace(
                ['{{modelName}}', '{{modelNamePluralLowerCase}}', '{{columns}}'],
                [$modelName, $modelNamePluralLowerCase, implode(', ', $columns)],
                file_get_contents(__DIR__."/stubs/vue/{$view}.vue.stub")
            );

            // Ensure the directory exists
            if (!is_dir($directory = resource_path("js/Pages/{$modelNamePluralLowerCase}"))) {
                mkdir($directory, 0755, true);
            }

            file_put_contents(resource_path("js/Pages/{$modelNamePluralLowerCase}/" . ucfirst($view) . ".vue"), $vueTemplate);
        }

        $this->info("Vue files for $modelName generated successfully.");
    }
}
