<?php

namespace App\Controllers\Users;

use System\Core\Controller;
use App\Models\Users\Login;
use App\Models\Session;

class LoginCtrl extends Controller
{

    /**
     *
     * @var Session
     */
    protected $session = null;

    /**
     * @var Login
     */
    protected $model = null;

    public function __init()
    {
        $this->session = new Session();
        $this->model = new Login($this);
    }

    public function index()
    {
        $this->view->set('user/login');
        $this->view['courses'] = $this->model->getListCourses();
        $this->view['message'] = $this->session->splice('message');
    }

    public function doPOST()
    {

        if (($result = $this->model->attemp()))
        {
            $this->session->set(Session::USER_AUTH, $result);
        }
        else
        {
            $this->session->set('message', ['type' => 'danger', 'str' => 'Sai tên tài khoản hoặc mật khẩu.']);
        }

        // redirect current URL
        return $this->response->withHeader('Location', $this->request->getUri());
    }

    public function logout()
    {
        $this->session->delete(Session::USER_AUTH);
        return $this->response->withHeader('Location', '/user/login');
    }

}
