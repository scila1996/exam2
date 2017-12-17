<?php

namespace App\Models\Users\Plugins;

use System\Core\Model;

class CKEditor extends Model
{

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->controller->view->template('plugin/ckeditor/ckeditor')->getContent();
    }

}
