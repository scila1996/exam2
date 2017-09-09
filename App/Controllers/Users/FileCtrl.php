<?php

namespace App\Controllers\Users;

use App\Models\Users\FileManagement\TreeView;

class FileCtrl extends MainCtrl
{

    public function __init()
    {
        parent::__init();
        $this->view['title'] .= ' - File Management';
    }

    public function index()
    {
        $data = [
            'message' => $this->session->splice('message')
        ];
        $this->view['content'] = $this->view->template('user/files/main', $data);
        $this->view['category'] = 'Quản lý danh mục';
    }

    public function createCategory($parent_id)
    {
        return 123;
    }

    public function rest($data)
    {
        if ($this->request->isGet())
        {
            switch ($data)
            {
                case 'treeview':
                    $model = new TreeView($this);
                    return $this->response->withJson($model->get());
            }
        }
    }

}
