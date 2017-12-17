<?php

namespace App\Models\Users\FileManagement;

use App\Controllers\Users\MainCtrl;
use App\Models\DataTable;
use App\Models\Users\FileManagement\Quiz\Table;
use System\Libraries\Database\DB;

class Quiz extends DataTable
{

    /**
     *
     * @var \System\Libraries\Database\Query\Builder
     */
    public $query = null;

    /**
     * 
     * @return string
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * 
     * @param MainCtrl $controller
     */
    public function __construct(MainCtrl $controller)
    {
        parent::__construct($controller);

        $file = File::tableName();
        $exam = Exam::tableName();
        $quiz = static::tableName();

        $this->query = DB::query()->table($quiz)->select("{$quiz}.*")
                ->join($exam, "{$exam}.id", '=', "{$quiz}.exam_id")
                ->join($file, "{$file}.id", '=', "{$exam}.file_id")
                ->where("{$file}.user_id", $controller->user->id)
                ->orderBy('position', 'asc');
    }

    /**
     * 
     * @param integer $id
     * @return $this
     */
    public function setExamId($id)
    {
        $this->query->where(File::tableName() . '.id', intval($id));
        return $this;
    }

    /**
     * 
     * @param integer $id
     * @return \System\Libraries\Database\Collection
     */
    public function getTableFromExam($id)
    {
        $this->setExamId($id);
        return (new Table($this->controller))->get(DB::execute($this->query));
    }

}
