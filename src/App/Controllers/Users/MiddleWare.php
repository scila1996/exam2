<?php

namespace App\Controllers\Users;

use System\Core\Controller;

class MiddleWare extends Controller
{

    const USER = 'user';

    public function __init()
    {
        if ($this->session->isStarted())
        {
            $this->session->start();
        }
    }

    public function require_login()
    {
        if (!$this->isLogin())
        {
            return $this->redirect('/user/login');
        }
    }

    public function valid_login()
    {
        if ($this->isLogin())
        {
            return $this->redirect('/');
        }
    }

    public function isLogin()
    {
        return $this->session->has(self::USER);
    }

}
