<?php

namespace System\Core;

use Phroute\Phroute\HandlerResolverInterface;
use Closure;

/**
 * @property-read Container $container
 * @property-read string $namespace
 * @property-read Controller $controller
 */
class Handler implements HandlerResolverInterface
{

    /** @var Container */
    private $container = null;

    /** @var string */
    private $namespace = null;

    /** @var Controller */
    private $controller = null;

    public function __construct(Container $container, $namespace)
    {
        $this->container = $container;
        $this->namespace = $namespace;
    }

    /**
     * 
     * @param array|Closure $handler
     * @return array|Closure
     */
    public function resolve($handler)
    {
        if (is_array($handler) && is_string($handler[0]))
        {
            if (count($handler) < 2)
            {
                $handler[1] = 'index';
            }
            $clsCtrl = "{$this->namespace}\\{$handler[0]}";
            $this->controller = ($handler[0] = new $clsCtrl($this->container));
            $this->controller->__init();
        }

        return $handler;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

}
