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

    /**
     *
     * @var object
     */
    public $user = null;

    public function __init()
    {

        $this->session = new Session();
        $this->user = $this->session->get(Session::USER_AUTH);
        $this->view->set('user/template');
        $this->view['user'] = $this->user;
        $this->view['title'] = 'Dashboard';
        $this->view['category'] = 'Home';
        $this->view['message'] = null;
        $this->view['content'] = 'no content';
        $this->view['url'] = (object) [
                    'home' => '/',
                    'files' => '/user/files',
                    'logout' => '/user/logout'
        ];
        $this->view['menu'] = (object) array_fill_keys(array_keys((array) $this->view['url']), null);
    }

    public function setMessage($type, $text)
    {
        $this->session->set('message', ['type' => $type, 'str' => $text]);
    }

    public function getMessage()
    {
        return $this->session->splice('message');
    }

}
