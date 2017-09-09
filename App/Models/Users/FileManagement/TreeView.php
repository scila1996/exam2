<?php

namespace App\Models\Users\FileManagement;

use App\Models\DataTable;
use System\Libraries\Database\DB;
use App\Models\Session;

class TreeView extends DataTable
{

    /**
     * 
     * @return string
     */
    public function tableName()
    {
        return 'files';
    }

    public function get()
    {
        return $this->recursive();
    }

    protected function recursive($parent = null)
    {
        $data = [];
        $list = DB::execute(DB::query()->table($this->tableName())
                                ->select("{$this->tableName()}.*")
                                ->selectRaw('count(b.parent_id) as c')
                                ->leftJoin('files as b', 'b.parent_id', '=', "{$this->tableName()}.id")
                                ->where([
                                    ["{$this->tableName()}.parent_id", $parent],
                                    ["{$this->tableName()}.user_id", $this->controller->session->get(Session::USER_AUTH)->id]
                                ])
                                ->groupBy("{$this->tableName()}.id")
        );
        foreach ($list as $file)
        {
            $item = [
                'text' => $file->name,
                'nodes' => null,
                'data' => $file,
                'icon' => [1 => 'fa fa-folder', 2 => 'fa fa-file-o'][$file->filetype_id]
            ];
            if ($file->c)
            {
                $item['nodes'] = $this->recursive($file->id);
            }
            $data[] = (object) $item;
        }
        return $data;
    }

}
