<?php

namespace App\Repositories\Criteria;

use App\Repositories\Contracts\CriteriaContract;
use App\Repositories\Contracts\RepositoryContract as Repository;
use Illuminate\Support\Facades\Auth;

class GenericAndWhere implements CriteriaContract
{
    /**
     * @var
     */
    private $criteria;

    /**
     * GenericAndWhere constructor.
     * @param array $criteria
     */
    public function __construct(array $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        foreach($this->criteria as $key => $value){
            $model = $model->where($key, '=', $value);
        }
        return $model;
    }

}