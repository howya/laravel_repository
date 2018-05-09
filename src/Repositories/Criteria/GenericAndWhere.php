<?php

namespace App\Repositories\Criteria;

use RBennett\AbstractRepository\Contracts\CriteriaContract;
use RBennett\AbstractRepository\Contracts\RepositoryContract;

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
    public function apply($model, RepositoryContract $repository)
    {
        foreach ($this->criteria as $key => $value) {
            $model = $model->where($key, '=', $value);
        }
        return $model;
    }

}