<?php

namespace App\Controllers;

use System\Core\Controller;
use System\Libraries\Database\DB;

class TestCtrl extends Controller
{

    public function index()
    {
        $query = DB::query()->table('question')->where('type_id', 1);
        $data = [];
        foreach (DB::execute($query) as $row)
        {
            $add = [$row->a_title => [], $row->b_title => []];
            foreach (DB::execute(DB::query()->table('_link_option')->where('question_id', $row->_id)) as $a)
            {
                if ($a->a_content)
                {
                    $add[$row->a_title][$a->a_position] = $a->a_content;
                }
                $add[$row->b_title][$a->b_position] = $a->b_content;
            }
            $update = DB::query()->table('question')->where('id', $row->id)->update(['answer' => serialize($add)]);
            DB::execute($update);
            $data[] = $add;
        }
        return var_export($data);
    }

}
