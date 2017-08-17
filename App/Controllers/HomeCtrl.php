<?php

namespace App\Controllers;

class HomeCtrl extends MainCtrl
{

    public function index()
    {
        $this->view['content'] = $this->view->template('home');
    }

    public function asset($file)
    {
        $response = $this->response->withHeader('Content-Type', mime_content_type(
                        $this->view->setFileExtension('')->set($file)->file)
        );
        $response->write($this->view->getContent());
        return $response;
    }

}
