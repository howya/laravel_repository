<?php

namespace App\Repositories\Relationships;

use App\Repositories\Contracts\RelationshipContract;
use App\Repositories\Contracts\RepositoryContract as Repository;

class WithRecipeItems implements RelationshipContract
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->with(['recipeItems']);
        return $query;
    }

}