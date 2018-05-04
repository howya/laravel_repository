<?php
/**
 * Created by PhpStorm.
 * User: rbennett
 * Date: 19/04/2018
 * Time: 09:24
 */

namespace RBennett\;


class UserRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    function getModelPath()
    {
        return '\App\User';
    }

}