<?php

namespace App\Models\Users\Plugins;

use System\Core\Model;

class MathJax extends Model
{

    public static function load(View $view)
    {
        return $view->template('ext/mathjax');
    }

}
