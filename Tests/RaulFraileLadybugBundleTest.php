<?php
namespace RaulFraile\Bundle\LadybugBundle\Tests;

use RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle;

class RaulFraileLadybugBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEnabled()
    {
        $bundle = new RaulFraileLadybugBundle();
        $this->assertTrue(function_exists('ladybug_dump'));
    }
}