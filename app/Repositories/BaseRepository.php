<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = new $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function findData($id)
    {
        return $this->model->find($id);
    }

    public function firstWhere($condition)
    {
        return $this->model->firstWhere($condition);
    }

    public function whereData($conditions, $fetch = 'get')
    {
        return $this->model->where($conditions)->$fetch();
    }

    public function wherePluck($condition, $column)
    {
        return $this->model->where($condition)->pluck($column)->all();
    }

    public function whereInData($column, $conditions)
    {
        return $this->model->whereIn($column, $conditions)->get();
    }

    public function insertData($data)
    {
        return $this->model->Create($data);
    }

    public function count(array $cond = null)
    {
        if (empty($cond)) {
            return $this->model->count();
        } else {
            return $this->model->where($cond)->count();
        }
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
