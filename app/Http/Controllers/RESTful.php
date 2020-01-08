<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/8/20
 * Time: 18:51
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;


trait RESTful
{

    protected $repositoryClass;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return response()->apiReturn([], '404', "page not found",404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $r = resolve($this->repositoryClass);

        $model = $r->seekShow($id);

        return response()->apiReturn([$model], 0);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = resolve($this->repositoryClass);

        try {
            $data = $this->storeData($request);

            $model = $r->store($data);
            return response()->apiReturn($model);
        } catch (\Exception $e) {
            return response()->apiReturn([], $e->getCode(), $e->getMessage(), 400);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $r = resolve($this->repositoryClass);
        try {
            $data = $this->updateData($request);
            $oldModel = $r->find($id);
            $model = $r->update($oldModel, $data);
            return response()->apiReturn($model);
        } catch (\Exception $e) {
            return response()->apiReturn([], $e->getCode(), $e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $r = resolve($this->repositoryClass);
        try {
            $oldModel = $r->find($id);
            $model = $r->delete($oldModel);
            return response()->apiReturn($model);
        } catch (\Exception $e) {
            return response()->apiReturn([], $e->getCode(), $e->getMessage(), 400);
        }
    }
}