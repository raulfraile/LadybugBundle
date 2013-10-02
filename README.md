LadybugBundle
=============

[![Build Status](https://secure.travis-ci.org/raulfraile/LadybugBundle.png)](http://travis-ci.org/raulfraile/LadybugBundle)
[![Latest Stable Version](https://poser.pugx.org/raulfraile/ladybug-bundle/v/stable.png)](https://packagist.org/packages/raulfraile/ladybug-bundle)
[![Total Downloads](https://poser.pugx.org/raulfraile/ladybug-bundle/downloads.png)](https://packagist.org/packages/raulfraile/ladybug-bundle)
[![Latest Unstable Version](https://poser.pugx.org/raulfraile/ladybug-bundle/v/unstable.png)](https://packagist.org/packages/raulfraile/ladybug-bundle)

This bundle provides an easy and extensible var_dump/print_r replacement for
Symfony2 projects, both in controllers or Twig templates. For example, with this
bundle, the following is possible:

``` php
<?php
    class UserController extends Controller
    {
        public function userAction($username) {
            ladybug_dump($username); // or just ld($username)
        }
    }
```

``` jinja
{{ user.username|ladybug_dump }}
```

Getting as a result:

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/LadybugBundle/raw/master/Resources/doc/images/string_example.png" />

## Installation

### Step 1: Composer

Add the following line to the `composer.json` file:

``` json
{
    "require": {
        "raulfraile/ladybug-bundle": "~1.0"
    }
}
```
To actually install Ladybug in your project, download the composer binary and run it:

``` bash
wget http://getcomposer.org/composer.phar
# or
curl -O http://getcomposer.org/composer.phar

php composer.phar install
```

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
    );
}
```

## Examples

It is possible to dump any variable, including arrays, objects and resources:

### Dumping an array

``` php
<?php
    $var = array(1, 2, 3);
    ladybug_dump($var)
```

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/LadybugBundle/raw/master/Resources/doc/images/array_example.png" />

### Dumping an object

``` php
<?php
    ladybug_dump($this->getRequest())
```

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/LadybugBundle/raw/master/Resources/doc/images/request_example.png" />

The same can be accomplished using the Twig filter `ladybug_dump`.

## Helpers

The are 5 helpers that can be used in any controller:

`ladybug_dump($var1[, $var2[, ...]])`: Dumps one or more variables

`ladybug_dump_die($var1[, $var2[, ...]])`: Dumps one or more variables and
terminates the current script

`ladybug_dump_return($format, $var1[, $var2[, ...]])`: Dumps one or more variables and
returns the dump in any of the following formats:

* yml: Returns the dump in YAML
* json: Returns the dump in JSON
* xml: Returns the dump in XML
* php: Returns the dump in PHP arrays

`ladybug_dump_ini([$extension])`: Dumps all configuration options

`ladybug_dump_ext()`: Dumps loaded extensions

There are also some shortcuts in case you are not using this function names:

`ld($var1[, $var2[, ...]])`: shortcut for ladybug_dump

`ldd($var1[, $var2[, ...]])`: shortcut for ladybug_dump_die

`ldr($format, $var1[, $var2[, ...]])`: shortcut for ladybug_return

Only `ladybug_dump` can be used inside Twig templates.

## Symfony profiler integration

Instead of printing out the dump tree inside the HTML document, you can use the Ladybug logger and
see the results in a tab of the Symfony profiler:

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/LadybugBundle/raw/master/Resources/doc/images/profiler.png" />

To make use of the Ladybug logger, grab the `ladybug` service from the DIC, and call the `log`
method:

``` php
<?php
class TestController
{
    public function testAction()
    {
        $var = 1;
        $this->get('ladybug')->log($var);
    }
```

## API reference

Ladybug automatically detects Symfony, Doctrine, Twig, Silex and other classes, and link them to the
official documentation.

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/LadybugBundle/raw/master/Resources/doc/images/doc_example.png" />

## Configuration

You can configure ladybug library directly in your `config.yml` file. Here are the defaults:

``` yaml
raul_fraile_ladybug:
    theme: modern # select the theme: base, modern or custom themes
    expanded: false # true to expand all the variables tree by default
    silenced: false # true to ignore all ladybug calls
```

## Credits

* Raul Fraile ([@raulfraile](https://twitter.com/raulfraile))
* [All contributors](https://github.com/raulfraile/LadybugBundle/contributors)

## License

LadybugBundle is released under the MIT License. See the bundled LICENSE file for details.