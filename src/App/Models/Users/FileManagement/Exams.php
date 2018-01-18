<?php

namespace App\Models\Users\FileManagement;

use App\Models\DataTable;
use Illuminate\Database\Capsule\Manager as DB;

class Exams extends DataTable
{

    protected static $table = 'exams';

    public function __construct($user_id, $category_id)
    {
        $file = Files::getTable();
        $this->query = DB::table(static::$table)
                ->select(static::$table . '.*', "{$file}.name", "{$file}.created_at")
                ->from(static::$table)
                ->join($file, static::$table . '.file_id', '=', "{$file}.id")
                ->where([
            ["{$file}.user_id", '=', $user_id],
            ["{$file}.parent_id", '=', $category_id]
        ]);
        parent::__construct();
    }

    public function insert($file_id, $header, $footer, $date)
    {
        return $this->copyQuery()->insert([
                    'file_id' => $file_id,
                    'header' => $header,
                    'footer' => $footer,
                    'share' => NULL,
                    'date' => $date
        ]);
    }

    public function get($id)
    {
        return $this->copyQuery()->where(Files::getTable() . '.id', $id)->first();
    }

    public function update($file_id, $header, $footer, $date)
    {
        return $this->copyQuery()
                        ->where(Files::getTable() . '.id', $file_id)
                        ->update([
                            'header' => $header,
                            'footer' => $footer,
                            'share' => NULL,
                            'date' => $date
        ]);
    }

    public function delete($file_id)
    {
        return $this->copyQuery()
                        ->where(Files::getTable() . '.id', $file_id)
                        ->delete();
    }

}
