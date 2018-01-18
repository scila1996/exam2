<?php

namespace App\Models\Users\FileManagement;

use App\Models\DataTable;
use Illuminate\Database\Capsule\Manager as DB;

class Files extends DataTable
{

    const CATEGORY = 1;
    const EXAM = 2;

    /** @var string */
    protected static $table = 'files';

    /**
     * 
     * @param type $user_id
     */
    public function __construct($user_id)
    {
        $this->query = DB::table(self::$table)
                ->select(self::$table . '.*')
                ->where(self::$table . '.user_id', $user_id);
        parent::__construct();
    }

    /**
     * 
     * @param string $id
     * @return \Illuminate\Support\Collection
     */
    public function listFrom($id)
    {
        $table = &self::$table;
        $query = clone $this->query;
        $query->selectRaw('count(b.parent_id) as c')
                ->leftJoin("{$table} as b", 'b.parent_id', '=', "{$table}.id")
                ->where("{$table}.parent_id", $id)
                ->groupBy("{$table}.id");
        return $query->get();
    }

    public function insert($name, $parent_id, $user_id, $type)
    {
        $query = clone $this->query;
        return $query->insertGetId([
                    'name' => $name,
                    'parent_id' => $parent_id ? $parent_id : null,
                    'user_id' => $user_id,
                    'type_id' => $type
        ]);
    }

    public function get($id)
    {
        $query = clone $this->query;
        return $query->where(self::$table . '.id', $id)->first();
    }

    public function update($id, $name)
    {
        $query = clone $this->query;
        $query->where(self::$table . '.id', $id);
        return $query->update([
                    'name' => $name
        ]);
    }

    public function delete($id)
    {
        $query = clone $this->query;
        $query->where(self::$table . '.id', $id);
        return $query->delete();
    }

}
