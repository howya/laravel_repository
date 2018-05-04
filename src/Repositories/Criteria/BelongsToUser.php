<?php

namespace RBennett\Criteria;

use RBennett\Contracts\CriteriaContract;
use RBennett\Contracts\RepositoryContract as Repository;
use Illuminate\Support\Facades\Auth;

class BelongsToUser implements CriteriaContract
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('user_id', '=', Auth::id());
        return $query;
    }

}