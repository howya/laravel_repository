<?php

namespace App\Repositories\Criteria;

use RBennett\AbstractRepository\Contracts\CriteriaContract;
use Illuminate\Support\Facades\Auth;
use RBennett\AbstractRepository\Contracts\RepositoryContract;

class BelongsToUser implements CriteriaContract
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, RepositoryContract $repository)
    {
        $query = $model->where('user_id', '=', Auth::id());
        return $query;
    }

}