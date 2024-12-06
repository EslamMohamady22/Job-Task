<?php
namespace App\Repository;
interface RepositoryInterface
{
    public function store($model, $data);
    public function update($model, $id,$data);
    public function find($model, $id);
    public function all($model);
    // public function getDataByQuery($model);
}
