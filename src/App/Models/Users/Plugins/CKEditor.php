<?php

namespace App\Models\Users\Plugins;

use System\Core\Model;
use System\Libraries\View\View;

class CKEditor extends Model
{

    public static function load(View $view, array $plugins = [])
    {
        return $view->template('ext/ckeditor', [
                    'plugins' => implode(',', $plugins)
        ]);
    }

}
