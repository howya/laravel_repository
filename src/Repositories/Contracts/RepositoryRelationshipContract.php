<?php

namespace RBennett\Contracts;

use RBennett\Contracts\RelationshipContract as Relationship;

interface RepositoryRelationshipContract
{
    /**
     * @param bool $status
     * @return $this
     */
    public function skipRelationship($status = true);

    /**
     * @return mixed
     */
    public function getRelationship();

    /**
     * @param RelationshipContract $relationship
     * @return $this
     */
    public function getByRelationship(Relationship $relationship);

    /**
     * @param RelationshipContract $relationship
     * @return $this
     */
    public function pushRelationship(Relationship $relationship);

    /**
     * @return $this
     */
    public function  applyRelationship();
}