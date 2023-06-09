<?php

namespace Khantnyar\ScaffoldedLaravel\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolded:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to install scaffolded project via my package Khantnyar\ScaffoldedLaravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->generateScaffolded();

        $this->call('passport:install');
        $this->info('Passport installed successfully.');

        $this->call('vendor:publish', [
            '--provider' => 'Vendor\Package\PackageServiceProvider',
            '--tag' => 'package-public',
            '--force' => true,
        ]);
        $this->info('Package assets published successfully.');

        $this->call('migrate');
        $this->info('Migrations executed successfully.');

        $this->info('Package installed successfully.');
    }

    protected function generateScaffolded()
    {
        $controllerPath = 'app/Http/Controllers/Api/';
        $stubPath = base_path('../../../stubs/ApiController.stub');
    }
}
