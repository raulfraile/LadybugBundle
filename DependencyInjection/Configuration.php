<?php

namespace RaulFraile\Bundle\LadybugBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Set the configuration of the bundle.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('raul_fraile_ladybug');

        $rootNode
            ->children()
                ->scalarNode('theme')->defaultValue('modern')->end()
                ->scalarNode('expanded')->defaultValue(false)->end()
                ->scalarNode('silenced')->defaultValue(false)->end()
                ->scalarNode('array_max_nesting_level')->defaultValue(9)->end()
                ->scalarNode('object_max_nesting_level')->defaultValue(3)->end()
            ->end();

        return $treeBuilder;
    }
}
