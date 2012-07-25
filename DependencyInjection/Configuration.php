<?php

namespace RaulFraile\Bundle\LadybugBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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
                ->arrayNode('general')
                    ->children()
                        ->booleanNode('expanded')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('object')
                    ->children()
                        ->variableNode('max_nesting_level')->defaultValue(3)->end()
                        ->booleanNode('show_data')->defaultTrue()->end()
                        ->booleanNode('show_classinfo')->defaultTrue()->end()
                        ->booleanNode('show_constants')->defaultTrue()->end()
                        ->booleanNode('show_methods')->defaultTrue()->end()
                        ->booleanNode('show_properties')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('array')
                    ->children()
                        ->variableNode('max_nesting_level')->defaultValue(8)->end()
                    ->end()
                ->end()
                ->arrayNode('processor')
                    ->children()
                        ->booleanNode('active')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('bool')
                    ->children()
                        ->scalarNode('html_color')->defaultValue('#008')->end()
                        ->scalarNode('cli_color')->defaultValue('blue')->end()
                    ->end()
                ->end()
                ->arrayNode('float')
                    ->children()
                        ->scalarNode('html_color')->defaultValue('#800')->end()
                        ->scalarNode('cli_color')->defaultValue('red')->end()
                    ->end()
                ->end()
                ->arrayNode('int')
                    ->children()
                        ->scalarNode('html_color')->defaultValue('#800')->end()
                        ->scalarNode('cli_color')->defaultValue('red')->end()
                    ->end()
                ->end()
                ->arrayNode('string')
                    ->children()
                        ->scalarNode('html_color')->defaultValue('#080')->end()
                        ->scalarNode('cli_color')->defaultValue('green')->end()
                        ->booleanNode('show_quotes')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('css')
                    ->children()
                        ->scalarNode('path')->defaultValue('/Asset/tree.min.css')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
