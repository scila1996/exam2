<?php

namespace System\Core;

class Container
{

    /**
     *
     * @var \Psr\Http\Message\ServerRequestInterface
     */
    public $request = null;

    /**
     *
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    public $session = null;

    /**
     *
     * @var \Psr\Http\Message\ResponseInterface
     */
    public $response = null;

    /**
     *
     * @var \System\Libraries\View\View
     */
    public $view = null;

}
