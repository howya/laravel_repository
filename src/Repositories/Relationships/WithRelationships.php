<?php

namespace App\Repositories\Relationships;

use App\Repositories\Contracts\RelationshipContract;
use App\Repositories\Contracts\RepositoryContract as Repository;

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