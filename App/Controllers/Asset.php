<?php

namespace App\Controllers;

use System\Core\Controller;
use System\Libraries\View\Mime;

class Asset extends Controller
{

    /**
     * 
     * @param string $file
     * @return \System\Libraries\Http\Messages\Response
     */
    public function index($file)
    {
        $response = $this->response->withHeader('Content-Type', Mime::TYPES[
                pathinfo($this->view->setFileExtension('')->set($file)->file, PATHINFO_EXTENSION)
        ]);
        $response->write($this->view->getContent());
        return $response;
    }

}
