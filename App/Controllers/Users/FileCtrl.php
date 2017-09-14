<?php

namespace App\Controllers\Users;

use App\Models\Users\FileManagement\Manage;
use PDOException;

class FileCtrl extends MainCtrl
{

    /**
     *
     * @var Manage
     */
    protected $model = null;

    public function __init()
    {
        parent::__init();
        $this->model = new Manage($this);
        $this->view['title'] .= ' - File Management';
    }

    public function index()
    {
        $this->view['content'] = $this->view->template('user/files/main');
        $this->view['message'] = $this->session->splice('message');
        $this->view['category'] = 'Quản lý danh mục';
    }

    /**
     * 
     * @param string $id
     * @param string $action
     */
    public function category($id, $action)
    {
        if ($this->request->isGet())
        {
            switch ($action)
            {
                case 'get':
                    return $this->response->withJson($this->model->getTreeView());
                case 'create':
                    if ($this->request->getQueryParam('type') == 'exam')
                    {

                        $data = [
                            'ckeditor' => $this->view->template('user/plugin/ckeditor/ckeditor')->getContent()
                        ];
                        $this->view['content'] = $this->view->template('user/files/exam/insert', $data);
                        $this->view['category'] = 'Tạo mới một tệp đề thi';
                    }
                    else
                    {
                        $this->view['content'] = $this->view->template('user/files/category/insert');
                        $this->view['category'] = 'Tạo danh mục mới';
                    }
                    break;
                case 'edit':
                    $data = ['value' => $this->model->getFolder($id)->name];
                    $this->view['content'] = $this->view->template('user/files/category/update', $data);
                    $this->view['category'] = 'Chỉnh sửa danh mục này';
                    break;
                case 'delete':
                    try
                    {
                        if ($this->model->deleteFile($id))
                        {
                            $this->session->set('message', ['type' => 'success', 'str' => 'Đã xóa thành công.']);
                        }
                        else
                        {
                            return $this->response->withStatus(404);
                        }
                    }
                    catch (PDOException $e)
                    {
                        $this->session->set('message', ['type' => 'warning', 'str' => 'Dữ liệu trong thư mục vẫn còn, không thể xóa.']);
                    }
                    $this->redirect('/user/files');
                    break;
            }
        }
        else if ($this->request->isPost())
        {
            switch ($action)
            {
                case 'create':
                    if ($this->request->getQueryParam('type') == 'exam')
                    {
                        if ($this->request->isPost())
                        {
                            if ($this->model->createExam($id))
                            {
                                $this->session->set('message', ['type' => 'success', 'str' => 'Đã tạo mới một đề thi.']);
                            }
                        }
                    }
                    else
                    {
                        if ($this->request->isPost())
                        {
                            if ($this->model->createFolder($id))
                            {
                                $this->session->set('message', ['type' => 'success', 'str' => 'Đã tạo mới một thư mục.']);
                            }
                        }
                    }
                    break;
                case 'edit':
                    if ($this->request->isPost())
                    {
                        if ($this->model->updateFolder($id))
                        {
                            $this->session->set('message', ['type' => 'success', 'str' => 'Đã chỉnh sửa thành công.']);
                        }
                    }
                    break;
            }
            $this->redirect('/user/files');
        }
    }

    /**
     * 
     * @param string $id
     * @param string $action
     */
    public function exam($id, $action)
    {
        
    }

}
