<?php

namespace App\Repository;

class BaseRepo implements RepositoryInterface
{
    // protected $model;
    // public function __construct($model) {
    //     $this->model = $model;
    // }
    public function store($model, $data)
    {
        // return $model->create($data);

        foreach ($data as $key => $itemValue) {
            $model[$key] = $itemValue;
        }
        $model->save();
        return $model;
    }
    public function update($model, $id, $data)
    {
        $record = $model->find($id);
        if($record != null)
        {
            foreach ($data as $key => $itemValue) {
                $record[$key] = $itemValue;
            }
            $record->save();
        }
        return false;
    }
    public function find($model, $id)
    {
        return $model->find($id);
    }
    public function all($model)
    {
        return $model->all();
    }
    // public function getDataByQuery($model)
    // {
    //     return $model->query
    // }
}
