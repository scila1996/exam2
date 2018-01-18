<?php

namespace System\Core;

use GuzzleHttp;
use GuzzleHttp\Psr7;

/**
 * @property-read \Psr\Http\Message\ServerRequestInterface $request
 * @property-read \Psr\Http\Message\ResponseInterface $response
 * @property-read \Symfony\Component\HttpFoundation\Session\Session $session
 * @property-read \System\Libraries\View\View $view
 */
class Controller
{

    /** @var Container */
    private $container = null;

    /**
     * 
     * @param Container $container
     */
    final public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    final public function __get($name)
    {
        return $this->container->{$name};
    }

    /**
     * 
     * @param mixed $json_data
     * @return \Psr\Http\Message\ResponseInterface
     */
    final public function json($json_data)
    {
        $response = $this->response->withHeader('Content-Type', Psr7\mimetype_from_extension('json'));
        $response->getBody()->write(GuzzleHttp\json_encode($json_data));
        return $response;
    }

    /**
     * 
     * @param string $link
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    final public function redirect($link, array $params = [])
    {
        if ($params)
        {
            $link .= '?' . Psr7\build_query($params);
        }

        return $this->response->withHeader('Location', $link);
    }

    /**
     * This method can override.
     */
    public function __init()
    {
        
    }

    public function index()
    {
        return $this->json('Override this method to render your content.');
    }

}
