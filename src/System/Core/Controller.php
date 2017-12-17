<?php

namespace System\Core;

use System\Core\Container;

/**
 * @property-read \Psr\Http\Message\ServerRequestInterface $request
 * @property-read \Psr\Http\Message\ResponseInterface $response
 * @property-read View $view
 */
class Controller
{

    /** @var \Psr\Http\Message\ServerRequestInterface */
    protected $request = null;

    /** @var \Psr\Http\Message\ResponseInterface */
    protected $response = null;

    /** @var \System\Libraries\View\View */
    protected $view = null;

    /**
     * 
     * @param Container $container
     */
    final public function __construct(Container $container)
    {
        foreach ($container as $prop => $obj)
        {
            $this->{$prop} = $obj;
        }
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    final public function __get($name)
    {
        return isset($this->{$name}) ? $this->{$name} : null;
    }

    /**
     * This method can override.
     * 
     * @return $this
     */
    public function __init()
    {
        return $this;
    }

    /**
     * 
     * @param string $link
     * @param object|array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function redirect($link, $params = null)
    {
        if ($params !== null)
        {
            $link .= '?' . http_build_query($params);
        }
        return $this->response = $this->response->withHeader('Location', $link);
    }

}
