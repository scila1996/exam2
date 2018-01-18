<?php

namespace App\Controllers\Users;

use System\Core\Controller;

class MainCtrl extends Controller
{

    /**
     *
     * @var object
     */
    public $user = null;

    public function __init()
    {
        if (!$this->session->isStarted())
        {
            $this->session->start();
        }

        $this->user = $this->session->get(MiddleWare::USER);
        $this->view->set('user/template');
        $this->view['user'] = $this->user;
        $this->view['title'] = 'Dashboard';
        $this->view['category'] = 'Tiêu đề';
        $this->view['flashmsg'] = $this->session->getFlashBag()->all();
        $this->view['content'] = 'Chức năng đang xử lý ...';
        $this->view['alert'] = 'Hệ thống đang được phát triển và đang trong quá trình hoàn thiện, vui lòng đóng góp ý kiến thêm !';
        $this->view['url'] = (object) [
                    'home' => '/',
                    'files' => '/user/files',
                    'about' => 'javascript:void(0)'
        ];
        $this->view['menu'] = (object) array_fill_keys(array_keys((array) $this->view['url']), null);
    }

    public function index()
    {
        
    }

}
