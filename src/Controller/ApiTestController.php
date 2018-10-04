<?php
/**
 * Created by PhpStorm.
 * User: bavo
 * Date: 04/10/2018
 * Time: 13:47
 */

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;


class ApiTestController extends FOSRestController
{
    /**
     * @Rest\Get("/api/user")
     */
    public function getAction()
    {
        $restResult = ['test', 'test2', 'test3'];

        return $restResult;
    }
}