<?php

namespace App\Controllers;

use System\Core\Controller;
use Illuminate\Database\Capsule\Manager;
use App\Models\Users;

class TestCtrl extends Controller
{

    public function index()
    {
        try
        {
            //return var_export(Manager::connection()->getPdo()->getAvailableDrivers(), true);
            $users = Users::all();
            $this->response = $this->response->withAddedHeader('Content-Type', 'application/json');
            $this->response->getBody()->write(\GuzzleHttp\json_encode($users));
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

}
