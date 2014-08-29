<?php

namespace RaulFraile\Bundle\LadybugBundle\Tests\DataCollector;

use Ladybug\Dumper;
use Mockery as m;
use RaulFraile\Bundle\LadybugBundle\DataCollector\LadybugDataCollector;

class LadybugDataCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ladybug\Dumper
     */
    private $dumper;

    protected function setUp()
    {
        $this->dumper = m::mock('Ladybug\Dumper');
        $this->dumper->shouldReceive('setFormat')->withArgs(array('html'));
    }

    protected function tearDown()
    {
        $this->dumper = null;
    }

    public function testLogDataWorksAsExpected()
    {
        $this->dumper->shouldReceive('dump')->once()->withArgs(array('#foo#', '#bar#'))->andReturn('#html#');
        $this->dumper->shouldReceive('dump')->once()->withArgs(array('#foo2#', '#bar2#'))->andReturn('#html2#');

        $ladybugDataCollector = new LadybugDataCollector($this->dumper);
        $ladybugDataCollector->log('#foo#', '#bar#');
        $ladybugDataCollector->log('#foo2#', '#bar2#');
        $collectedVars = $ladybugDataCollector->getVars();

        $this->assertCount(2, $collectedVars);

        foreach ($collectedVars as $collected) {
            $this->assertArrayHasKey('file', $collected);
            $this->assertArrayHasKey('line', $collected);
            $this->assertArrayHasKey('content', $collected);
        }

        $this->assertEquals('#html#', $collectedVars[0]['content']);
        $this->assertEquals('#html2#', $collectedVars[1]['content']);
    }
}