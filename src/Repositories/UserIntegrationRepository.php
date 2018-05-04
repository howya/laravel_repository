<?php

namespace App\Repositories;


class UserIntegrationRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    function getModelPath()
    {
        return '\App\UserIntegration';
    }

}