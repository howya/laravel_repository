<?php

namespace RBennett\Criteria;

use RBennett\Contracts\CriteriaContract;
use RBennett\Contracts\RepositoryContract as Repository;

class HasNameEvenietCriteria implements CriteriaContract
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('recipe_name', '=', 'eveniet');
        return $query;
    }

}