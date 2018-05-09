<?php

namespace RBennett\AbstractRepository\Relationships;

use RBennett\AbstractRepository\Contracts\RelationshipContract;
use RBennett\AbstractRepository\Contracts\RepositoryContract as Repository;

class WithRelationships implements RelationshipContract
{
    /**
     * @var
     */
    private $relationships;

    /**
     * WithRelationships constructor.
     * @param array $relationships
     */
    public function __construct(array $relationships)
    {
        $this->relationships = $relationships;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->with($this->relationships);
        return $query;
    }

}