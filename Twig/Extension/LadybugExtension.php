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
            new \Twig_SimpleFilter('ladybug_dump', array($this, 'ladybug_dump'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('ld', array($this, 'ladybug_dump'), array('is_safe' => array('html')))
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
            new \Twig_SimpleFunction('ladybug_dump', array($this, 'ladybug_dump'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('ld', array($this, 'ladybug_dump'), array('is_safe' => array('html')))
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
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ladybug_extension';
    }
}
