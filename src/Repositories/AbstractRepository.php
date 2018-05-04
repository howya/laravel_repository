<?php

namespace RBennett\AbstractRepository;


use RBennett\AbstractRepository\Contracts\CriteriaContract as Criteria;
use RBennett\AbstractRepository\Contracts\RelationshipContract as Relationship;
use RBennett\AbstractRepository\Contracts\RepositoryCriteriaContract;
use RBennett\AbstractRepository\Contracts\RepositoryRelationshipContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application as App;
use RBennett\AbstractRepository\Contracts\RepositoryContract;
use Illuminate\Support\Collection;

abstract class AbstractRepository implements RepositoryContract, RepositoryCriteriaContract, RepositoryRelationshipContract
{
    /**
     * @var app
     */
    private $app;

    /**
     * @var model
     */
    private $model;

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var Collection
     */
    protected $relationship;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * @var bool
     */
    protected $skipRelationship = false;

    /**
     * AbstractRepository constructor.
     * @param App $app
     * @param Collection $collection
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->relationship = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * @return Model|mixed
     * @throws RepositoryException
     */
    private function makeModel()
    {
        $model = $this->app->make($this->getModelPath());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->getModelPath()} must be instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    abstract function getModelPath();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        $this->applyCriteria();
        $this->applyRelationship();
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 5, $columns = array('*')) {
        $this->applyCriteria();
        $this->applyRelationship();
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        $this->applyCriteria();
        $this->applyRelationship();
        return $this->model->find($id, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = array('*')) {
        $this->applyCriteria();
        $this->applyRelationship();
        return $this->model->findOrFail($id, $columns);
    }


    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyRelationship();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);
        $this->skipRelationship(false);
        $this->criteria = new Collection();
        $this->relationship = new Collection();
        $this->makeModel();
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function  applyCriteria()
    {
        if($this->skipCriteria === true)
            return $this;

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipRelationship($status = true)
    {
        $this->skipRelationship = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * @param Relationship $relationship
     * @return $this
     */
    public function getByRelationship(Relationship $relationship)
    {
        $this->model = $relationship->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Relationship $relationship
     * @return $this
     */
    public function pushRelationship(Relationship $relationship)
    {
        $this->relationship->push($relationship);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyRelationship()
    {
        if($this->skipRelationship === true)
            return $this;

        foreach($this->getRelationship() as $relationship) {
            if($relationship instanceof Relationship)
                $this->model = $relationship->apply($this->model, $this);
        }

        return $this;
    }


}