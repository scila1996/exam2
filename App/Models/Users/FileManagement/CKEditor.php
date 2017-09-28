<?php

namespace App\Models\Users\FileManagement;

use System\Core\Model;

class CKEditor extends Model
{

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->controller->view->template('user/plugin/ckeditor/ckeditor')->getContent();
    }

}
