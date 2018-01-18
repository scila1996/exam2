<?php

namespace App\Controllers\Users;

use App\Controllers\Users\MainCtrl;
use App\Models\Users\Users;

class ProfileCtrl extends MainCtrl
{

    public function __init()
    {
        parent::__init();
        $this->view['title'] = "Quản lý tài khoản - ({$this->user->name})";
    }

    public function index()
    {
        $this->view['category'] = 'Xem thông tin cá nhân';
        $this->view['content'] = $this->view->template('user/profile/menu', [
            'content' => $this->view->template('user/profile/info')
        ]);
    }

    public function change_password()
    {
        $this->view['category'] = 'Thay đổi mật khẩu tài khoản cá nhân';
        $this->view['content'] = $this->view->template('user/profile/menu', [
            'content' => $this->view->template('user/profile/chpw')
        ]);
    }

    public function do_change_password()
    {
        $postdata = $this->request->getParsedBody();

        if (Users::changePassword($this->user->id, $postdata['o_pass'], $postdata['n_pass']))
        {
            $this->session->getFlashBag()->add('success', 'Đã thay đổi mật khẩu thành công, vui lòng đăng nhập lại để kiểm tra.');
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Mật khẩu cũ không chính xác.');
        }

        return $this->redirect($this->request->getUri());
    }

    public function edit_info()
    {
        $this->view['category'] = 'Chỉnh sửa thông tin cá nhân';
        $this->view['content'] = $this->view->template('user/profile/menu', [
            'content' => $this->view->template('user/profile/edit')
        ]);
    }

}
