<?php

namespace RBennett\;


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