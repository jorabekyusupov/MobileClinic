<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Builder;

class Repository
{

    protected $model;

    public function query($relation = null): Builder
    {
        if($relation){
            return $this->model->with(...$relation);
        }
        return $this->model->query();
    }

    public function store($params): object
    {
        return $this->model->create($params);
    }

    public function update($id, $params): object
    {
        $model = $this->query();
        $model = $model->find($id);
        $model->update($params);
        return $model;
    }

    public function show($id, $relation = null): object
    {
        $model = $this->query($relation);
        return $model->find($id);
    }

    public function destroy($id): bool
    {
        $model = $this->query();
        $model = $model->find($id);
        return $model->delete($model);
    }


}


?>
