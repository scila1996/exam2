<?php

namespace App\Models\Users\FileManagement;

use System\Core\Controller;
use App\Models\DataTable;
use App\Models\Session;
use System\Libraries\Database\DB;

class File extends DataTable
{

    const CATEGORY = 1;
    const EXAM = 2;

    /**
     *
     * @var \System\Libraries\Database\Query\Builder
     */
    public $query = null;

    public static function tableName()
    {
        return 'files';
    }

    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $table = self::tableName();
        $this->query = DB::query()->table($table)
                ->select("{$table}.*")
                ->where("{$table}.user_id", $this->controller->session->get(Session::USER_AUTH)->id);
    }

    /**
     * 
     * @param string|integer $parent
     * @return \System\Libraries\Database\Query\Builder
     */
    public function listFromParent($parent)
    {
        $query = $this->query->copyQuery();
        $table = self::tableName();
        return $query->selectRaw('count(b.parent_id) as c')
                        ->leftJoin('files as b', 'b.parent_id', '=', "{$table}.id")
                        ->where("{$table}.parent_id", $parent)
                        ->groupBy("{$table}.id");
    }

    /**
     * 
     * @param string|integer $id
     * @return $this
     */
    public function setId($id)
    {
        $table = self::tableName();
        $this->query->where("{$table}.id", intval($id));
        return $this;
    }

    /**
     * 
     * @param string|integer $id
     * @return $this
     */
    public function setType($type)
    {
        $table = self::tableName();
        $this->query->where("{$table}.type_id", intval($type));
        return $this;
    }

    /**
     * 
     * @param string|integer $id
     * @return \System\Libraries\Database\Query\Builder
     */
    public function get($id)
    {
        $this->setId($id);
        return $this->query;
    }

    /**
     * 
     * @param string|integer $parent
     * @param string|integer $type
     * @return \System\Libraries\Database\Query\Builder
     */
    public function create($parent, $type = self::CATEGORY)
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
        return $query;
    }

    /**
     * 
     * @param integer|string $id
     * @return \System\Libraries\Database\Query\Builder
     */
    public function update($id)
    {
        $this->setId($id);
        $name = $this->controller->request->getParsedBodyParam('name');
        $query = $this->query->update([
            'name' => $name
        ]);
        return $query;
    }

    /**
     * 
     * @param string|integer $id
     * @param integer $type
     * @return \System\Libraries\Database\Query\Builder
     */
    public function delete($id, $type)
    {
        $table = self::tableName();
        $this->setId($id)->setType($type);
        return $this->query->delete();
    }

}
