<?php

namespace RaulFraile\Bundle\LadybugBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;


class LadybugExtension extends \Twig_Extension
{
    private $container; 
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function getFilters() {
        return array(
            'ladybug_dump'  => new \Twig_Filter_Method($this, 'ladybug_dump', array('is_safe' => array('html')))
        );
    }
  
    public function ladybug_dump($var) {
        
        $ladybug = \Ladybug\Dumper::getInstance();
        $html = $ladybug->dump($var);
     
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
