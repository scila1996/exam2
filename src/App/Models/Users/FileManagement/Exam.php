<?php

namespace App\Models\Users\FileManagement;

use System\Core\Controller;
use System\Libraries\Database\DB;

class Exam extends File
{

    /**
     * 
     * @return string
     */
    public static function tableName()
    {
        return 'exams';
    }

    /**
     * 
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $table = static::tableName();
        $ftable = parent::tableName();
        $this->query
                ->addSelect("{$table}.header", "{$table}.footer", "{$table}.date")
                ->join($table, "{$table}.file_id", '=', "{$ftable}.id");
    }

    /**
     * 
     * @param string|integer $id
     * @return \System\Libraries\Database\Query\Builder
     */
    public function get($id)
    {
        return $this->setId($id)->query;
    }

    /**
     * 
     * @param string|integer $category
     * @param string|integer $type
     * @return \System\Libraries\Database\Query\Builder
     */
    public function create($category, $type = self::EXAM)
    {
        $file = parent::create($category, $type);
        DB::execute($file);
        $file_id = DB::connection()->getPdo()->lastInsertId();
        $data = [
            'file_id' => $file_id,
            'header' => $this->controller->request->getParsedBodyParam('header'),
            'footer' => $this->controller->request->getParsedBodyParam('footer'),
            'date' => $this->controller->request->getParsedBodyParam('event') ?
            $this->controller->request->getParsedBodyParam('date') : null
        ];

        return DB::query()->table(static::tableName())->insert($data);
    }

    /**
     * 
     * @param string|integer $id
     * @return \System\Libraries\Database\Query\Builder
     */
    public function update($id)
    {
        $this->setId($id);
        $data = [
            'name' => $this->controller->request->getParsedBodyParam('name'),
            'header' => $this->controller->request->getParsedBodyParam('header'),
            'footer' => $this->controller->request->getParsedBodyParam('footer'),
            'date' => $this->controller->request->getParsedBodyParam('event') ?
            $this->controller->request->getParsedBodyParam('date') : null
        ];

        return $this->query->update($data);
    }

    /**
     * 
     * @param string|integer $id
     * @param integer $type
     * @return \System\Libraries\Database\Query\Builder
     */
    public function delete($id, $type = self::EXAM)
    {
        $query = parent::delete($id, $type);
        $query->joins = null;
        return $query;
    }

}
