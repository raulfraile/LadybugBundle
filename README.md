LadybugBundle
=============

[![Build Status](https://secure.travis-ci.org/raulfraile/LadybugBundle.png)](http://travis-ci.org/raulfraile/LadybugBundle)

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

<pre><strong><em>string(10)</em></strong> <span style="color:#080">"raulfraile"</span></pre>

## Installation with composer

[Composer](http://packagist.org/about-composer) is a project dependency manager for PHP. You have to list
your dependencies in a `composer.json` file:

``` json
{
    "require": {
        "raulfraile/ladybug-bundle": "dev-master"
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

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/Ladybug/raw/master/examples/images/array_example.png" />

### Dumping an object

``` php
<?php
    $var = new Foo();
    ladybug_dump($var)
```

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/Ladybug/raw/master/examples/images/object_example.png" />

### Dumping a GD image

``` php
<?php
    $img = imagecreatefrompng(__DIR__ . '/images/ladybug.png');
    ladybug_dump($img);
```

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/Ladybug/raw/master/examples/images/gd_example.png" />

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

## Symfony command

There are two Symfony commands to dump an instance of a given class or export it to
a file, in JSON, YAML or XML format.

``` bash
# php app/console ladybug:dump class_name [--all]
# php app/console ladybug:export class_name target [--format=yaml]

php app/console ladybug:dump "Symfony\Component\HttpFoundation\Request"
php app/console ladybug:export "Symfony\Component\HttpFoundation\Request" export.json --format=json
```

## Symfony profiler integration

Instead of printing out the dump tree inside the HTML document, you can use the Ladybug logger and
see the results in a tab of the Symfony profiler:

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/LadybugBundle/raw/master/Resources/doc/images/symfony_profiler.png" />

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

Ladybug automatically detects Symfony, Doctrine, Twig and Silex classes, and link them to the
official documentation.

<img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/Ladybug/raw/master/examples/images/apilinks_example.png" />

## Configuration

You can configure ladybug library directly in your `config.yml` file. Here are the defaults:

``` yaml
raul_fraile_ladybug:
    general:
        expanded:             false
    object:
        max_nesting_level:    3
        show_data:            true
        show_classinfo:       true
        show_constants:       true
        show_methods:         true
        show_properties:      true
    array:
        max_nesting_level:    8
    processor:
        active:               true
    bool:
        html_color:           #008
        cli_color:            blue
    float:
        html_color:           #800
        cli_color:            red
    int:
        html_color:           #800
        cli_color:            red
    string:
        html_color:           #080
        cli_color:            green
        show_quotes:          true
    css:
        path:                 /Asset/tree.min.css
```
