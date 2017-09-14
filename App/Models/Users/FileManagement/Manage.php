<?php

namespace App\Models\Users\FileManagement;

use System\Core\Controller;
use App\Models\DataTable;
use System\Libraries\Database\DB;
use App\Models\Session;

class Manage extends DataTable
{

    const CATEGORY = 1;
    const EXAM = 2;

    /**
     *
     * @var \System\Libraries\Database\Query\Builder
     */
    public $query = null;

    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $this->query = DB::query()->table($this->tableName())
                ->select("{$this->tableName()}.*")
                ->where("{$this->tableName()}.user_id", $this->controller->session->get(Session::USER_AUTH)->id);
    }

    /**
     * 
     * @return string
     */
    public function tableName()
    {
        return 'files';
    }

    /**
     * 
     * @param string|integer $parent
     * @param string|integer $type
     * @return int
     */
    public function createFile($parent, $type = self::CATEGORY)
    {
        $name = $this->controller->request->getParsedBodyParam('name');
        $parent_id = $parent == 0 ? null : $parent;
        $user_id = $this->controller->session->get(Session::USER_AUTH)->id;
        $type_id = $type;
        $query = $this->query->insert([
            'name' => $name,
            'parent_id' => $parent_id,
            'user_id' => $user_id,
            'type_id' => $type_id
        ]);
        if (DB::execute($query))
        {
            return DB::connection()->getPdo()->lastInsertId();
        }
        return 0;
    }

    /**
     * 
     * @param string|integer $parent
     * @return integer
     */
    public function createFolder($parent)
    {
        return $this->createFile($parent);
    }

    /**
     * 
     * @param integer|string $id
     * @return object
     */
    public function getFolder($id)
    {
        return DB::execute($this->query->select()->where('id', $id))->first();
    }

    /**
     * 
     * @param integer|string $id
     * @return integer
     */
    public function updateFolder($id)
    {
        $name = $this->controller->request->getParsedBodyParam('name');
        $query = $this->query->update([
                    'name' => $name
                ])->where('id', $id);
        return DB::execute($query);
    }

    /**
     * 
     * @param string|integer $id
     * @return integer
     */
    public function deleteFile($id)
    {
        return DB::execute($this->query->delete()->where('id', $id));
    }

    /**
     * 
     * @param integer|string $category_id
     * @return integer
     */
    public function createExam($category_id)
    {
        DB::begin();
        $file_id = $this->createFile($category_id, self::EXAM);

        $data = [
            'file_id' => $file_id,
            'header' => $this->controller->request->getParsedBodyParam('header'),
            'footer' => $this->controller->request->getParsedBodyParam('footer'),
            'date' => $this->controller->request->getParsedBodyParam('event') ?
            $this->controller->request->getParsedBodyParam('date') : null
        ];
        $query = DB::query()->table('exam')->insert($data);
        $r = DB::execute($query);
        DB::commit();
        return $r;
    }

    /**
     * 
     * @param integer|string $parent
     * @return array
     */
    public function getTreeView($parent = null)
    {
        $data = [];
        $query = clone $this->query;
        $list = DB::execute($query->selectRaw('count(b.parent_id) as c')
                                ->leftJoin('files as b', 'b.parent_id', '=', "{$this->tableName()}.id")
                                ->where("{$this->tableName()}.parent_id", $parent)
                                ->groupBy("{$this->tableName()}.id")
        );
        //return $this->query->toSql();
        foreach ($list as $file)
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
