<?php

namespace Khantnyar\ScaffoldedLaravel\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class MakeApiControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apicontroller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API controller by using ScaffoldedLaravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $controllerName = $name . 'Controller';
        $controllerPath = 'app/Http/Controllers/Api/' . $controllerName . '.php';
        $stubPath = base_path('../../../stubs/ApiController.stub');

        $stub = File::get($stubPath);
        $stub = str_replace('{{CLASS}}', $controllerName, $stub);

        $methods = $this->generateMethods($name);
        $stub = str_replace('{{METHODS}}', $methods, $stub);

        if (!File::isDirectory('app/Http/Controllers/Api')) {
            File::makeDirectory('app/Http/Controllers/Api', 0755, true);
        }

        File::put($controllerPath, $stub);

        $this->info('API controller created successfully!');
    }

    protected function generateMethods($name)
    {
        $model = Str::singular($name);
        $modelClass = 'App\\Models\\' . $model;

        $methods = [
            'list' => <<<EOT
                public function list()
                {
                    \$models = {$modelClass}::latest()->get();

                    return response()->json(\$models);
                }
            EOT,
            'detail' => <<<EOT
                public function detail(\$id)
                {
                    \$model = {$modelClass}::findOrFail(\$id);

                    return response()->json(\$model);
                }
            EOT,
            'update' => <<<EOT
                public function update(Request \$request, \$id)
                {
                    \$model = {$modelClass}::findOrFail(\$id);
                    \$model->update(\$request->all());

                    return response()->json(\$model);
                }
            EOT,
            'destroy' => <<<EOT
                public function destroy(\$id)
                {
                    \$model = {$modelClass}::findOrFail(\$id);
                    \$model->delete();

                    return response()->json(['message' => 'Model deleted successfully']);
                }
            EOT,
        ];

        return implode("\n\n", $methods);
    }
}
