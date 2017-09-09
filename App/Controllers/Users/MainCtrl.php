<?php

namespace App\Controllers\Users;

use System\Core\Controller;
use App\Models\Session;

class MainCtrl extends Controller
{

    /**
     *
     * @var Session
     */
    protected $session = null;

    public function __init()
    {

        $this->session = new Session();
        $this->view->set('user/template');
        $this->view['user'] = $this->session->get(Session::USER_AUTH);
        $this->view['title'] = 'Dashboard';
        $this->view['category'] = 'Home';
        $this->view['url'] = (object) [
                    'home' => '/',
                    'files' => '/user/files',
                    'logout' => '/user/logout'
        ];
        $this->view['menu'] = (object) array_fill_keys(array_keys((array) $this->view['url']), null);
    }

}
