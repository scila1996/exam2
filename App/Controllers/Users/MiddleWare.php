<?php

namespace App\Controllers\Users;

use System\Core\Controller;
use App\Models\Session;

class MiddleWare extends Controller
{

    /**
     *
     * @var Session 
     */
    protected $session = null;

    public function __init()
    {
        $this->session = new Session();
    }

    public function requireLogin()
    {
        if (!$this->isLogin())
        {
            return $this->response->withHeader('Location', '/user/login');
        }
    }

    public function validLogin()
    {
        if ($this->isLogin())
        {
            return $this->response->withHeader('Location', '/');
        }
    }

    public function isLogin()
    {
        return $this->session->has(Session::USER_AUTH);
    }

}
