<?php

namespace App\Models\Users\Plugins;

use System\Core\Model;

class MathJax extends Model
{

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->controller->view->template('plugin/mathjax')->getContent();
    }

}
