<?php

namespace Search\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class SearchableGenerator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:searchable {name} {--f|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new serchable class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Searchable';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Search';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  __DIR__ . '/Stubs/Searchable.stab';
    }
}
