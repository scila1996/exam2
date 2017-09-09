<?php

namespace App\Controllers\Users;

class HomeCtrl extends MainCtrl
{

    public function index()
    {
        $this->view['category'] = 'Xem lịch thi';
        $this->view['content'] = $this->view->template('user/home/main');
    }

}
