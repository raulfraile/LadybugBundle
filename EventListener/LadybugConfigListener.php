<?php

namespace RaulFraile\Bundle\LadybugBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LadybugConfigListener
{
    protected $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        ladybug_set_options($this->options);
    }
}