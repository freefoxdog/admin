<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/8/21
 * Time: 18:53
 */

namespace App\Console\Commands;

use Illuminate\Filesystem\Filesystem;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Console\Command;

class DatabaseMake extends Command
{
    use GeneratorTrait;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $name = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new  Database  class ';
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function other()
    {
    /**
    $table->increments('id');
    $table->integer('user_id');
    $table->integer('topic_id');
    $table->string('pics',255);
    $table->integer('comments_sum');
    $table->string('title',64);
    $table->string('pics',256);
    $table->text('content');
    $table->integer('created_at' )->nullable();
    $table->integer('updated_at')->nullable();
    $table->integer('deleted_at')->nullable()->default(null);
     */
        $inputName = $this->getNameInput();

        $metadata = config('metadata.' . $inputName);

        foreach ($metadata['propertys'] as $property)
        {

            $fieldName = $property['fieldName'];
           $type = $property['schema']['type'];

           $len =  $property['schema']['len'] ?? 0;

           $enableNull = isset($property['schema']['null']) ? $property['schema']['null'] : false;

           $default = false;
           if(array_key_exists  ('default',$property['schema']))
           {

               $default = $property['schema']['default'];

               switch (gettype($default))
               {
                   case 'string':
                       $default = "'{$default}'";
                       break;
                   case 'integer':
                       $default = "{$default}";
                       break;
                   case 'NULL':
                       $default = 'null';
                       break;
               }

           }


           $str =  "\n \$table->{$type}('$fieldName',{$len})";

           if($enableNull)
           {
               $str.= "->nullable()";
           } if($default)
           {
               $str .= "->default({$default})";
           }

           echo $str;

        }

    }


    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('trait'))
            $namespace = '\Generator\Storage\Database';
        else
            $namespace = '\Storage\Database';

        return $rootNamespace . $namespace;
        return $rootNamespace . '\Storage\Database';
    }

    protected function getStub()
    {


        if ($this->option('trait'))
            $stub = 'database_trait';
        else
            $stub = 'database';

        return  "stubs.{$stub}";


    }


    protected function getReplace()
    {
        $inputName = $this->getNameInput();

        $metadata = config('metadata.' . $inputName);

        $fieldsData = $this->getFieldsData($metadata);
        $table = $this->getTableName($metadata);


        $relationFunc = $this->relationFunc($metadata);



        return [
            'fieldsData' => $fieldsData,
            'softDelete'=>$metadata['softDelete'] ?? true,
            'tableName' => $table,
            'relation' => $relationFunc,
    ];

    }

    public function relationFunc($metadata)
    {
        $return  = [];

        if (!isset($metadata['relation']))
            return $return;


        foreach ($metadata['relation'] as $name => $config) {
            $methodDefine = $this->getRelationFunDefine($config);
            if (!$methodDefine)
                continue;
            $return[$name] = $methodDefine;
        }


        return $return;

    }


    protected function getRelationFunDefine($config)
    {

        $num = $config['num'];
        $type = $config['type'];
        $fun = "";
        if ($num == '1tn') {
            if ($type == 'simple')
                $fun = 'hasMany';
            if ($type == 'morph')
                $fun = 'morphMany';
        }
        if($num == 'nt1')
        {
            if ($type == 'simple')
                $fun = 'belongsTo';
            if ($type == 'morph')
                $fun = 'morphTo';
        }
        if($num == 'ntn')
        {
            if ($type == 'simple')
                $fun = 'belongsToMany';
            if ($type == 'morph')
                $fun = 'morphTo';

        }

        if (!$fun)
            return false;

        /* if($fun == 'morphTo')
            $fun .='(';
        else
            $fun = "{$fun} (\\App\\Storage\\Database\\".$config['class']."::class";

                if (isset($config['arg1']))
                    $fun .= ",'{$config['arg1']}'";
                if (isset($config['arg2']))
                    $fun .= ",'{$config['arg2']}'";
                $fun .= ")";*/

        return [
            'fun'=>$fun,
            'class'=> $fun == 'morphTo' ? '':"\\App\\Storage\\Database\\".$config['class']."::class",
            'arg1'=> $config['arg1'] ?? '',
            'arg2'=> $config['arg2'] ?? '',
            'arg3'=> $config['arg3'] ?? '',
        ];

    }

    public function getTableName($metadata)
    {

        $table = $metadata['table'] ?? str_replace(
                '\\', '', Str::snake(Str::plural(class_basename($this->getNameInput())))
            );


        return $table;
    }



    public function getFieldsData($metadata)
    {
        $ret  = [];
        foreach ($metadata['propertys'] as $property => $config) {


            $ret[$config['fieldName']] = $property;
            //$str .= "'{$config['fieldName']}'=>'{$property}',\n\t\t";
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
            ['suffix', 's', InputOption::VALUE_REQUIRED, 'The suffix of the class', ''],


        ];

    }


}