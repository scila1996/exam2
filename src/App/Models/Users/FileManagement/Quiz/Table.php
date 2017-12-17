<?php

namespace App\Models\Users\FileManagement\Quiz;

use System\Core\Model;

class Table extends Model
{

    public function get($collection)
    {
        $uri = $this->controller->request->getUri()->getPath();
        $html = <<<EOF
<table class="table table-striped">
    <thead>
        <tr>
        <th> <input type="checkbox" id="check-all" /> </th>
        <th> Số câu hỏi </th>
        <th> Nội dung câu hỏi </th>
        <th></th>
        <th></th>
        </tr>
    </thead>
    <tbody>
EOF;
        foreach ($collection as $key => $row)
        {
            $html .= <<<eof
    <tr>
        <td> <input type="checkbox" name="id[]" value="{$row->id}"> </td>
        <td> Câu $key </td>  
        <td> $row->content </td>
        <td><a href="{$uri}/{$row->id}/delete" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span> Edit </a></td>
        <td><a href="{$uri}/{$row->id}/delete" class="btn btn-danger btn-xs"><span class="fa fa-remove"></span> Delete </a></td>
    </tr>
eof;
        }
        $html .= '</tbody></table>';
        return $html;
    }

}
