<?php

namespace RaulFraile\Bundle\LadybugBundle\Tests\DependencyInjection;

use RaulFraile\Bundle\LadybugBundle\DependencyInjection\RaulFraileLadybugExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;

class RaulFraileLadybugExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RaulFraile\Bundle\LadybugBundle\DependencyInjection\RaulFraileLadybugExtension
     */
    private $extension;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->extension = new RaulFraileLadybugExtension();
        $this->container = new ContainerBuilder();
    }

    protected function tearDown()
    {
        $this->extension = null;
        $this->container = null;
    }

    public function testEmptyConfigUsesDefaultValuesAndServicesAreCreated()
    {
        $this->extension->load(array(), $this->container);

        $this->assertTrue($this->container->has('data_collector.ladybug_data_collector'));
        $this->assertTrue($this->container->has('ladybug.twig.extension'));
        $this->assertTrue($this->container->has('ladybug.dumper'));
        $this->assertTrue($this->container->has('ladybug.event_listener.ladybug_config_listener'));

        $bundleOptions = $this->container->getParameterBag('raul_fraile_ladybug')->get('ladybug.options');
        $this->assertEquals('modern', $bundleOptions['theme']);
        $this->assertFalse($bundleOptions['expanded']);
        $this->assertFalse($bundleOptions['silenced']);
        $this->assertEquals(9, $bundleOptions['array_max_nesting_level']);
        $this->assertEquals(3, $bundleOptions['object_max_nesting_level']);
    }
}