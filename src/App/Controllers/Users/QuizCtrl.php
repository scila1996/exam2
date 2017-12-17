<?php

namespace App\Controllers\Users;

use App\Controllers\Users\MainCtrl;
use App\Models\Users\FileManagement\Quiz;
use App\Models\Users\Plugins\MathJax;
use App\Models\Users\Plugins\CKEditor;

class QuizCtrl extends MainCtrl
{

    /**
     *
     * @var Quiz
     */
    public $model = null;

    public function __init()
    {
        parent::__init();
        $this->model = new Quiz($this);
        $this->view['title'] .= ' - File Management';
    }

    public function index($exam_id)
    {
        $data = [
            'mathjax' => new MathJax($this),
            'table' => $this->model->getTableFromExam($exam_id),
            'link' => (object) [
                'mc' => "{$this->request->getUri()->getPath()}/create/multiplechoice",
                'link' => "{$this->request->getUri()->getPath()}/create/link",
                'mc' => "{$this->request->getUri()->getPath()}/create/multiplechoice",
                'mc' => "{$this->request->getUri()->getPath()}/create/multiplechoice",
            ]
        ];
        $this->view['content'] = $this->view->template('user/files/exam/question/main', $data);
        $this->view['category'] = 'Quản lý các câu hỏi';
    }

    public function create()
    {
        return 123;
    }

}
