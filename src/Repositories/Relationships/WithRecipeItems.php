<?php

namespace RBennett\Relationships;

use RBennett\Contracts\RelationshipContract;
use RBennett\Contracts\RepositoryContract as Repository;

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