<?php

namespace App\Repositories\Relationships;

use RBennett\AbstractRepository\Contracts\RelationshipContract;
use RBennett\AbstractRepository\Contracts\RepositoryContract as Repository;
use Illuminate\Database\Eloquent\Model;

class WithDoesntHaveRelationships implements RelationshipContract
{
    /**
     * @var
     */
    private $relationship;

    /**
     * @var callable
     */
    private $callback;

    /**
     * WithRelationships constructor.
     * @param string $relationship
     * @param callable $callback
     */
    public function __construct(string $relationship, callable $callback)
    {
        $this->relationship = $relationship;
        $this->callback = $callback;
    }

    /**
     * @param Model $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->whereDoesntHave($this->relationship, $this->callback);
        return $query;
    }

}