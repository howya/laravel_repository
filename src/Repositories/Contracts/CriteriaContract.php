<?php

namespace RBennett\Contracts;


interface CriteriaContract
{
    /**
     * @param $model
     * @param RepositoryContract $repository
     * @return mixed
     */
     function apply($model, RepositoryContract $repository);
}