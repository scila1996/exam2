<?php

namespace App\Models\Users\FileManagement;

use System\Core\Controller;
use System\Libraries\Database\DB;
use System\Core\Model;

class Manage extends Model
{

    /**
     *
     * @var File
     */
    public $files = null;

    /**
     *
     * @var Exam
     */
    public $exam = null;

    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $this->files = new File($controller);
        $this->exam = new Exam($controller);
    }

    /**
     * 
     * @param string|integer $parent
     * @return integer
     */
    public function createFolder($parent)
    {
        return DB::execute($this->files->create($parent));
    }

    /**
     * 
     * @param integer|string $id
     * @return object
     */
    public function getFolder($id)
    {
        return DB::execute($this->files->get($id))->first();
    }

    /**
     * 
     * @param integer|string $id
     * @return object
     */
    public function getExam($id)
    {
        return DB::execute($this->exam->get($id))->first();
    }

    /**
     * 
     * @param integer|string $id
     * @return integer
     */
    public function updateExam($id)
    {
        return DB::execute($this->exam->update($id));
    }

    /**
     * 
     * @param integer|string $id
     * @return integer
     */
    public function updateFolder($id)
    {
        return DB::execute($this->files->update($id));
    }

    /**
     * 
     * @param string|integer $id
     * @return integer
     */
    public function deleteFile($id)
    {
        return DB::execute($this->files->delete($id, File::CATEGORY));
    }

    /**
     * 
     * @param integer|string $category_id
     * @return integer
     */
    public function createExam($category_id)
    {
        //DB::begin();
        $query = $this->exam->create($category_id);
        return DB::execute($query);
    }

    /**
     * 
     * @param integer|string $id
     * @return integer
     */
    public function deleteExam($id)
    {
        return DB::execute($this->exam->delete($id));
    }

    /**
     * 
     * @param integer|string $parent
     * @return array
     */
    public function getTreeView($parent = null)
    {
        $data = [];
        foreach (DB::execute($this->files->listFromParent($parent)) as $file)
        {
            $item = [
                'text' => $file->name,
                'nodes' => null,
                'data' => $file,
                'icon' => [1 => 'fa fa-folder', 2 => 'fa fa-file-o'][$file->type_id]
            ];
            if ($file->c)
            {
                $item['nodes'] = $this->getTreeView($file->id);
            }
            $data[] = (object) $item;
        }
        return $data;
    }

}
