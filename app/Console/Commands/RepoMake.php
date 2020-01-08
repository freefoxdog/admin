<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/8/21
 * Time: 18:53
 */

namespace App\Console\Commands;


use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class RepoMake extends Command
{
    use GeneratorTrait;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $name = 'make:repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new  Repositories  class ';

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        if($this->option('trait'))
            $namespace = '\Generator\Repositories';
        else
            $namespace = '\Repositories';

        return $rootNamespace . $namespace;

    }

    protected function getStub()
    {


        if($this->option('trait'))
            $stub = 'repo_trait';
        else
            $stub = 'repo';

        return  "stubs.{$stub}";



    }

    protected  function getReplace()
    {

        $inputName = $this->getNameInput();

        $metadata = config('metadata.'.$inputName);

        $storeData = $this->storeData($metadata);
        $updateData = $this->updateData($metadata);


        $databaseName =  $this->getNameInput();
        return [
            'DummyDatabaseClass' => $databaseName,
            'storeData' => $storeData,
            'updateData' => $updateData,
        ];
    }

    protected function storeData($metadata)
    {

        $ret = [];

        foreach ($metadata['propertys'] as $property=>$config)
        {
            if($config['insert'])
            {
                $ret[] = $property;
            }
        }


        return $ret;
    }
    protected function updateData($metadata)
    {


        $ret = [];
        foreach ($metadata['propertys'] as $property=>$config)
        {
            if($config['update'])
            {
                 $ret[] = $property;
            }
        }

        return $ret;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

            ['force', 'f', InputOption::VALUE_NONE, 'force Generate.'],
            ['trait', 't', InputOption::VALUE_NONE, 'Generate Custom Repository Trait class.'],
            ['suffix', 's',InputOption::VALUE_REQUIRED, 'The suffix of the class','Repository'],
            ['database', 'd', InputOption::VALUE_REQUIRED, 'a database  class name'],


        ];

    }
}