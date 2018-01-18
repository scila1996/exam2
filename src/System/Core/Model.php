<?php

namespace System\Core;

class Model
{

    /**
     *
     * @var Controller|null
     */
    protected $controller = null;

    public function __construct(Controller $controller = null)
    {
        $this->setController($controller);
    }

    /**
     * 
     * @param \System\Core\Controller $controller
     */
    public function setController(Controller $controller = null)
    {
        $this->controller = $controller;
    }

}
