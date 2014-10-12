<?php

namespace RaulFraile\Bundle\LadybugBundle\Twig\Extension;

use Ladybug\Dumper;

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
     * Main constructor
     *
     * @param Dumper $ladybug Ladybyg Dumper
     */
    public function __construct(Dumper $ladybug)
    {
        $this->ladybug = $ladybug;
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
            'ladybug_log'  => new \Twig_Filter_Method($this, 'ladybug_log'),
            'ldl'  => new \Twig_Filter_Method($this, 'ladybug_log')
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
            'ladybug_log'  => new \Twig_Function_Method($this, 'ladybug_log'),
            'ldl'  => new \Twig_Function_Method($this, 'ladybug_log')
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
     *
     * @return $arg or array of $args, depending on number of arguments
     */
    public function ladybug_log()
    {
        $ladybug = $this->getContainer()->get('ladybug');
        $html = call_user_func_array(array($ladybug, 'log'), func_get_args());

        return func_num_args() == 1 ? func_get_arg(0): func_get_args();
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
