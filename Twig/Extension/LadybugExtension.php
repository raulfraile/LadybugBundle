<?php

namespace RaulFraile\Bundle\LadybugBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Twig extension for the bundle.
 */
class LadybugExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface $container The Symfony2 DIC.
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
     * Getter.
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
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
        $ladybug = $this->container->get('ladybug.dumper');
        $html = call_user_func_array(array($ladybug, 'dump'), func_get_args());

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
