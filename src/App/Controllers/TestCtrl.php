<?php

namespace App\Controllers;

use System\Core\Controller;
use Illuminate\Database\Capsule\Manager;

class TestCtrl extends Controller
{

    /** @var string */
    protected $title = null;

    public function __init()
    {
        $this->title = $this->request->getServerParams()['SERVER_NAME'];
    }

    public function index()
    {
        $collect = Manager::table('files')->get();
        $collect = $collect->getIterator();
        $collect->next();
        $this->view['test'] = $collect->current()->id;
        $this->view->set('test/index');
    }

}
