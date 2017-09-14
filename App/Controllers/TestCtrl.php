<?php

namespace App\Controllers;

use System\Core\Controller;

class TestCtrl extends Controller
{

    public function index()
    {
        return $this->response->withJson($this->request->getQueryParams());
    }

}
