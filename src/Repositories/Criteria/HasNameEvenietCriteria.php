<?php

namespace App\Repositories\Criteria;

use App\Repositories\Contracts\CriteriaContract;
use App\Repositories\Contracts\RepositoryContract as Repository;

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