<?php

namespace RaulFraile\Bundle\LadybugBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LadybugConfigListener
{
    protected $ladybugConfigs;

    public function __construct($ladybugConfigs)
    {
        $this->ladybugConfigs = $ladybugConfigs;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        foreach ($this->ladybugConfigs as $rootKey => $configurationSettings) {
            foreach ($configurationSettings as $configKey => $configValue) {
                ladybug_set(sprintf('%s.%s', $rootKey, $configKey), $configValue);
            }
        }
    }
}
