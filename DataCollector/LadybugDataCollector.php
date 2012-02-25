<?php

namespace RaulFraile\Bundle\LadybugBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LadybugDataCollector extends DataCollector
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function log()
    { 
        $ladybug = \Ladybug\Dumper::getInstance();
        $content = call_user_func_array(array($ladybug,'dump'), func_get_args());
        $trace = debug_backtrace();
        
        $this->data['vars'][] = array(
            'file' => isset($trace[0]['file']) ? $trace[0]['file'] : '',
            'line' => isset($trace[0]['line']) ? $trace[0]['line'] : '',
            'content' => $content
        );
    }

    public function getVars()
    {
        return $this->data['vars'];
    }

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
    }

    public function getName()
    {
        return 'ladybug';
    }
}
