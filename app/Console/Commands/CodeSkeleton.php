<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class CodeSkeleton extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:code';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller Repository and Database class ';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelName = $this->argument('name');

        // $controllerName = $modelName . "Controller";
        // $controllerTraitName = $controllerName . "Trait";
        //$repositoryName = $modelName . "Repository";
      //  $repositoryTraitName = $repositoryName . "Trait";
       // $databaseTraitName = $modelName . "Trait";
        $force = $this->option('force');

        $metadata = config('metadata.'.$modelName);

        if(!$metadata)
        {
            $this->error("{$modelName} no metadata config!");
            return false;
        }
        if(!isset($metadata['module']))
        {
            $this->error("{$modelName} config must has module key");
            return false;
        }


        if(in_array('ctrl',$metadata['module']))
        {
            $this->info("begin generator Controller.....................");
            $this->call('make:ctrl', ['name' => $modelName]);
            $this->call('make:ctrl', ['name' => $modelName, '--trait' => true, '--force' => $force]);
            $this->info(" generator Controller end");
        }

        if(in_array('repo', $metadata['module']))
        {
            $this->info("begin generator Repository.....................");
            $this->call('make:repo', ['name' => $modelName]);
            $this->call('make:repo', ['name' => $modelName, '--trait' => true, '--force' => $force]);
            $this->info(" generator Repository end");
        }
        if(in_array('data', $metadata['module']))
        {
            $this->info("begin generator database.....................");
            $this->call('make:database', ['name' => $modelName]);
            $this->call('make:database', ['name' => $modelName, '--trait' => true, '--force' => $force]);
            $this->info(" generator database end");
        }


        return true;
    }

    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'force Generate.'],
        ];
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
