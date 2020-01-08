<?php
 

namespace App\Repositories;


use App\Exceptions\AppException;
use App\Storage\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 


abstract class Repository
{

    /**
     * @var Storage
     */
    protected $persistence;

    /**
     * @var \Illuminate\Http\Resources\Json\Resource
     */
    protected $resourceClass;


    public function __construct(Storage $persistence)
    {
        $this->setStorage($persistence);
    }

    public function setStorage(Storage $persistence)
    {
        $this->persistence = $persistence;
    }


    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function find($id, $columns = array('*'))
    {


        try{
            $model = $this->storage()->retrieve($id, $columns);
        }catch(ModelNotFoundException $e){

            throw  new ModelNotFoundException( "data nof found",404);
        }

        return $model;
    }

    public function seekShow($id, $columns = array('*'))
    {
        $model = $this->storage()->finData($id, $columns);

        return $model;
    }

    abstract public function store(array $newData);
    abstract public function update(Storage $oldModel, array $updateData);
   
    public function save(Storage $model)
    {
        if( $model->persist())
            return $model;
        else
            return false;
    }

    public function delete(Storage $oldModel)
    {
        return  $oldModel->delete();
    }

    /**
     * @return \App\Storage\Storage
     */
    public function storage()
    {

        return $this->persistence;
    }

    protected  function getList( \Illuminate\Database\Eloquent\Builder $builder)
    {

      // return  $this->resourceClass::collection(   $builder->get() );
       return  $builder->get();
    }
        protected function paginate( \Illuminate\Database\Eloquent\Builder $builder,  $perPage = 15, $columns = array('*'))
    {


        $paginate  = $builder->paginate($perPage, $columns);

      /*  $return = [
            "meta" => [
                "currentPage" => $paginate->currentPage(),
               'from'=>$paginate->firstItem(),
                'to'=>$paginate->lastItem(),
                "lastPage" => $paginate->lastPage(),
                "perPage" =>$paginate->perPage(),
                "total" => $paginate->total()
            ],
            'items'=>$this->resourceClass::collection($paginate),

        ];
*/

        return $paginate;


    }




}