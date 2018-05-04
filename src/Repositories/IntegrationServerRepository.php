<?php

namespace App\Repositories;


class IntegrationServerRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    function getModelPath()
    {
        return '\App\IntegrationServer';
    }

}