<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/8/22
 * Time: 16:18
 */

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
trait GeneratorTrait
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;


    public function handle()
    {

        $className = $this->getClassName();
        $className = $this->option('trait') ? $this->getTraitName($className) : $className ;

        $classFullName   = $this->qualifyClass( $className );
        $path = $this->getPath($classFullName);


        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.



        if ((! $this->hasOption('force') ||
                ! $this->option('force')) &&
            $this->alreadyExists( $className )) {
            $this->error($classFullName.' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($classFullName));

        $this->info($classFullName.' created successfully.');
        $this->other();
    }
    public function other()
    {

    }
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($this->qualifyClass($rawName)));
    }
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'.php';
    }
    protected function getClassName()
    {
        $className   = $this->getNameInput().$this->option('suffix');
        return $className;
    }
    protected function getTraitName( $className )
    {
        return  $className."Trait";
    }

    protected function buildClass($classFullName)
    {

        $className = $this->getClassName();
        $traitName = $this->getTraitName($className);
        $customeReplace = $this->getReplace();

        //$class = str_replace($this->getNamespace($classFullName).'\\', '', $classFullName);
        $replace =  [
            'DummyDate'=>date('Y/m/d'),
            'DummyTime'=>date('H:i:s'),
            'DummyClass' => str_replace($this->getNamespace($classFullName).'\\', '', $classFullName),
            'DummyTraitClass' => $traitName,
            'DummyNamespace'=>$this->getNamespace($classFullName),
            'DummyRootNamespace'=>$this->rootNamespace(),
          //  'NamespacedDummyUserModel'=>config('auth.providers.users.model'),

        ];
        $replace = array_merge($replace, $customeReplace);



       return  view($this->getStub(), $replace)->render();



    }
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],

        ];
    }
    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace();
    }
}