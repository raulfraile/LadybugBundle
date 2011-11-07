<?php

namespace RaulFraile\Bundle\LadybugBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RaulFraileLadybugBundle extends Bundle
{
    public function __construct()
    {
        // load the global helpers
        require_once(__DIR__.'/Helper/LadybugHelper.php');
    }
}