<?php

namespace RaulFraile\Bundle\LadybugBundle\Tests\Twig\Extension;

use Ladybug\Dumper;
use Mockery as m;
use RaulFraile\Bundle\LadybugBundle\Twig\Extension\LadybugExtension;

class LadybugExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ladybug\Dumper
     */
    private $dumper;

    protected function setUp()
    {
        $this->dumper = m::mock('Ladybug\Dumper');
    }

    protected function tearDown()
    {
        $this->dumper = null;
    }

    public function testLadybugDumpWorksAsExpectedInsideTwigExtension()
    {
        $this->dumper->shouldReceive('dump')->once()->withArgs(array('#foo#', '#bar#'))->andReturn('#html#');
        $ladybugExtension = new LadybugExtension($this->dumper);

        $this->assertEquals('#html#', $ladybugExtension->ladybug_dump('#foo#', '#bar#'));
    }
}