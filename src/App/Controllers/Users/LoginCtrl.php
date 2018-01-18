<?php

namespace App\Controllers\Users;

use System\Core\Controller;
use App\Models\Users\Courses;
use App\Models\Users\Users;

class LoginCtrl extends Controller
{

    /**
     * @var Login
     */
    protected $model = null;

    public function __init()
    {
        if (!$this->session->isStarted())
        {
            $this->session->start();
        }
    }

    public function index()
    {
        $this->view->set('user/login');
        $this->view['courses'] = Courses::all();
        $this->view['flashmsg'] = $this->session->getFlashBag()->all();
    }

    public function do_submit()
    {
        $data = $this->request->getParsedBody();

        if (($result = Users::login($data['username'], $data['password'], $data['courseid'])))
        {
            $this->session->set(MiddleWare::USER, $result);
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Dữ liệu đăng nhập người dùng không chính xác hoặc không tồn tại, vui lòng thử lại.');
        }

        // redirect current URL
        return $this->redirect($this->request->getUri());
    }

    public function logout()
    {
        $this->session->remove(MiddleWare::USER);
        return $this->redirect('/user/login');
    }

}
