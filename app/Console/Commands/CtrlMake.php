<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/8/21
 * Time: 18:53
 */

namespace App\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Console\Command;

class CtrlMake extends Command
{
    use GeneratorTrait;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $name = 'make:ctrl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new restful controller  class ';
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('trait'))
            $namespace = '\Generator\Controllers';
        else
            $namespace = '\Http\Controllers';
        return $rootNamespace . $namespace;
    }

    protected function getStub()
    {
        if ($this->option('trait'))
            $stub = 'controller_trait';
        else
            $stub = 'controller';
        return  "stubs.{$stub}";

    }

    protected function getReplace()
    {
        $inputName = $this->getNameInput();
        $metadata = config('metadata.' . $inputName);
        $repositoryName = $this->option('repository') ?? $inputName . "Repository";

        $storeInput = $this->storeInput($metadata);
        $updateInput = $this->updateInput($metadata);
        $storeValidates = $this->getValidates($metadata);
        $updateValidates = $this->getValidates($metadata, false);
        return [
            'DummyRepositoryClass' => $repositoryName,
            'storeInput' => $storeInput,
            'updateInput' => $updateInput,
            'storeValidates' => $storeValidates,
            'updateValidates' => $updateValidates,
        ];
    }

    public function getValidates($metadata, $isNew = true)
    {

        $validates = [];
        foreach ($metadata['propertys'] as $property => $config) {
            $validate = [];

            if (isset($config['validate'])) {
                $validate[] = $config['validate'];
            }

            if ($isNew && isset($config['required']) && $config['required']) {
                $validate[] = 'required';
            }

            if ($validate)
                $validates[$property] = implode("|", $validate);

        }
        return $validates;

    }

    public function storeInput($metadata)
    {

        $ret = [];
        foreach ($metadata['propertys'] as $property => $config) {
            if ($config['insert']) {
                $default = null;
                $type = 0;
                if (isset($config['uid']) && $config['uid']){

                    $type = 2;
                }
                else {

                    if(isset($config['default']))
                    {
                        $type = 1;
                        $default = is_numeric($config['default']) ? "{$config['default']}" : "'{$config['default']}'";
                    }

                }
                $ret[$property] = ['type'=>$type, 'default'=>$default];
            }
        }

        return $ret;


    }

    public function updateInput($metadata)
    {

        $ret = [];
        foreach ($metadata['propertys'] as $property => $config) {
            if ($config['update']) {

                $type = 0;
                if (isset($config['uid']) && $config['uid']){

                    $type = 2;
                }
                $ret[$property] = ['type'=>$type];
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
            ['trait', 't', InputOption::VALUE_NONE, 'Generate Custom Controller Trait class.'],
            ['suffix', 's', InputOption::VALUE_REQUIRED, 'The suffix of the class', 'Controller'],
            ['repository', 'r', InputOption::VALUE_REQUIRED, 'a repository  class name'],


        ];
    }


}