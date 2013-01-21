<?php

namespace RaulFraile\Bundle\LadybugBundle\Tests;

use RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle;

/**
 * Unit tests for the RaulFraileLadybugBundle.
 */
class RaulFraileLadybugBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Unit test.
     */
    public function testIsEnabled()
    {
        $bundle = new RaulFraileLadybugBundle();
        $this->assertTrue(function_exists('ladybug_dump'));
    }
}