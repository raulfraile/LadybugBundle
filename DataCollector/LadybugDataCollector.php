<?php

namespace RaulFraile\Bundle\LadybugBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * The LadybugDataCollector class.
 */
class LadybugDataCollector extends DataCollector
{
    /**
     *
     * @var ContainerInterface $container The Symfony DIC.
     */
    private $container;

    /**
     * Main constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Log an info.
     */
    public function log()
    {
        $ladybug = $this->container->get('ladybug.dumper');
        $content = call_user_func_array(array($ladybug,'dump'), func_get_args());

        $trace   = debug_backtrace();

        $this->data['vars'][] = array(
            'file' => isset($trace[0]['file']) ? $trace[0]['file'] : '',
            'line' => isset($trace[0]['line']) ? $trace[0]['line'] : '',
            'content' => $content
        );
    }

    /**
     * Get all vars.
     *
     * @return array
     */
    public function getVars()
    {
        return $this->data['vars'];
    }

    /**
     * @param Request   $request   The request object
     * @param Response  $response  The response object
     * @param Exception $exception The exception
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
    }

    /**
     * Returns the name of the debug collector.
     *
     * @return string
     */
    public function getName()
    {
        return 'ladybug';
    }
}