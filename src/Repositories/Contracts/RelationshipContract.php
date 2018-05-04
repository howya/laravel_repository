<?php

namespace RBennett\AbstractRepository\Contracts;


interface RelationshipContract
{
    /**
     * @param $model
     * @param RepositoryContract $repository
     * @return mixed
     */
     function apply($model, RepositoryContract $repository);
}