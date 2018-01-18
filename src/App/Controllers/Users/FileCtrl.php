<?php

namespace App\Controllers\Users;

use App\Models\Users\FileManagement\Manager;
use App\Models\Users\Plugins\CKEditor;

class FileCtrl extends MainCtrl
{

    /**
     *
     * @var Manager
     */
    protected $model = null;

    public function __init()
    {
        parent::__init();
        $this->model = (new Manager($this))->setUserId($this->user->id);
        $this->view['title'] .= ' - File Management';
    }

    public function index()
    {
        $this->view['content'] = $this->view->template('user/files/main');
        $this->view['category'] = 'Quản lý danh mục';
    }

    public function ajax_get_category_data($id)
    {

        return $this->json($this->model->getTreeView($id == 0 ? NULL : $id));
    }

    public function add_category()
    {
        $this->view['content'] = $this->view->template('user/files/category/insert');
        $this->view['category'] = 'Tạo danh mục mới';
    }

    public function do_add_category($id)
    {
        if ($this->model->createFolder($id))
        {
            $this->session->getFlashBag()->add('success', 'Đã tạo mới một thư mục.');
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Lỗi không thể tạo thư mục.');
        }

        return $this->redirect('/user/files');
    }

    public function edit_category($id)
    {
        $data = ['value' => $this->model->getCategoryData($id)->name];
        $this->view['content'] = $this->view->template('user/files/category/update', $data);
        $this->view['category'] = 'Chỉnh sửa danh mục này';
    }

    public function do_edit_category($id)
    {
        if ($this->model->updateCategoryData($id))
        {
            $this->session->getFlashBag()->add('success', 'Đã chỉnh sửa thành công.');
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Lỗi không thể sửa được thư mục này.');
        }

        return $this->redirect('/user/files');
    }

    public function delete_category($id)
    {
        if ($this->model->deleteCategory($id))
        {
            $this->session->getFlashBag()->add('success', 'Đã xóa thành công.');
        }
        else
        {
            $this->session->getFlashBag()->add('danger', 'Dữ liệu trong thư mục vẫn còn, không thể xóa.');
        }

        return $this->redirect('/user/files');
    }

    public function create_exam()
    {
        $this->view['content'] = $this->view->template('user/files/exam/insert', [
            'ckeditor' => CKEditor::load($this->view)
        ]);
        $this->view['category'] = 'Tạo một tệp đề thi mới';
    }

    public function do_create_exam($category_id)
    {
        if ($this->model->createExam($category_id, $this->request->getParsedBody()))
        {
            $this->session->getFlashBag()->add('success', "Đã tạo mới một tệp đề thi.");
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Lỗi không thể tạo tệp đề thi, vui lòng kiểm tra lại.');
        }

        return $this->redirect('/user/files');
    }

    public function edit_exam($category_id, $id)
    {
        $this->view['category'] = 'Chỉnh sửa thông tin đề thi';
        $this->view['content'] = $this->view->template('user/files/exam/update', [
            'ckeditor' => CKEditor::load($this->view),
            'data' => $this->model->getExamData($category_id, $id)
        ]);
    }

    public function do_edit_exam($category_id, $id)
    {
        if ($this->model->updateExamData($category_id, $id, $this->request->getParsedBody()))
        {
            $this->session->getFlashBag()->add('success', 'Đã chỉnh sửa tệp đề thi.');
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Lỗi không thể chỉnh sửa tệp đề thi này.');
        }

        return $this->redirect('/user/files');
    }

    public function delete_exam($category, $id)
    {
        if ($this->model->deleteExam($category, $id))
        {
            $this->session->getFlashBag()->add('success', 'Đã xóa một tệp đề thi.');
        }
        else
        {
            $this->session->getFlashBag()->add('warning', 'Không thể xóa.');
        }

        return $this->redirect('/user/files');
    }

}
