<?php

namespace RaulFraile\Bundle\LadybugBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Ladybug\Dumper;

/**
 * Bundle extension.
 */
class RaulFraileLadybugExtension extends Extension
{
    /**
     * Load the bundle extension.
     *
     * @param array            $configs   The config parameters
     * @param ContainerBuilder $container The DI container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $options = array(
            'extra_helpers' => array(
                'RaulFraile\Bundle\LadybugBundle\DataCollector\LadybugDataCollector:log'
            )
        );
        foreach ($config as $rootKey => $configurationSettings) {
            $options[$rootKey] = $configurationSettings;
        }

        $container->setParameter('ladybug.options', $options);
        ladybug_set_options($options);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        /** @var $dumper Dumper */
        $dumper = $container->get('ladybug.dumper');
        $dumper->setOptions($options);
    }
}