<?php

namespace RaulFraile\Bundle\LadybugBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ladybug\Dumper;

/**
 * The LadybugDataCollector class.
 */
class LadybugDataCollector extends DataCollector
{
    /**
     * @var Dumper
     *
     * Ladybug Dumper
     */
    private $ladybug;

    /**
     * Main constructor
     *
     * @param Dumper $ladybug Ladybyg Dumper
     */
    public function __construct(Dumper $ladybug)
    {
        $this->ladybug = $ladybug;
        $this->ladybug->setFormat('html');
    }

    /**
     * Log an info.
     */
    public function log()
    {
        $content = call_user_func_array(array($this->ladybug,'dump'), func_get_args());

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
        return isset($this->data['vars'])?$this->data['vars']:array();
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
