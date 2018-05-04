<?php

namespace App\Repositories;


class RecipeRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    function getModelPath()
    {
        return '\App\Recipe';
    }

}