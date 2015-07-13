<?php

namespace RaulFraile\Bundle\LadybugBundle\Twig\Extension;

use Ladybug\Dumper;
use RaulFraile\Bundle\LadybugBundle\DataCollector\LadybugDataCollector;

/**
 * Twig extension for the bundle.
 */
class LadybugExtension extends \Twig_Extension
{
    /**
     * @var Dumper
     *
     * Ladybug Dumper
     */
    private $ladybug;

    /**
     * @var DataCollector
     *
     * DataCollector
     */
    private $dataCollector;

    /**
     * Main constructor
     *
     * @param Dumper $ladybug Ladybyg Dumper
     * @param DataCollector $dataCollector Ladybug DataCollector
     */
    public function __construct(Dumper $ladybug, LadybugDataCollector $dataCollector)
    {
        $this->ladybug = $ladybug;
        $this->dataCollector = $dataCollector;
    }

    /**
     * Getter.
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'ladybug_dump' => new \Twig_Filter_Method($this, 'ladybug_dump', array('is_safe' => array('html'))),
            'ld'  => new \Twig_Filter_Method($this, 'ladybug_dump', array('is_safe' => array('html'))),
            'ladybug_dump_profiler' => new \Twig_Filter_Method($this, 'ladybug_dump_profiler', array('is_safe' => array('html')))
        );
    }

    /**
     * Getter.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'ladybug_dump' => new \Twig_Function_Method($this, 'ladybug_dump', array('is_safe' => array('html'))),
            'ld'  => new \Twig_Function_Method($this, 'ladybug_dump', array('is_safe' => array('html'))),
            'ladybug_dump_ profiler' => new \Twig_Function_Method($this, 'ladybug_dump_profiler', array('is_safe' => array('html')))
        );
    }

    /**
     * Getter.
     *
     * @return string
     */
    public function ladybug_dump()
    {
        $html = call_user_func_array(array($this->ladybug, 'dump'), func_get_args());

        return $html;
    }

    /**
     * Getter.
     *
     * @return string
     */
    public function ladybug_dump_profiler($object)
    {
        $this->dataCollector->log($object);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ladybug_extension';
    }
}
