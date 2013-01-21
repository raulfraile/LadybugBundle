<?php

namespace RaulFraile\Bundle\LadybugBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * The bundle main class.
 */
class RaulFraileLadybugBundle extends Bundle
{
    /**
     * Construcor, autoload helpers.
     */
    public function __construct()
    {
        // load the global helpers
        \Ladybug\Loader::loadHelpers();
    }
}
