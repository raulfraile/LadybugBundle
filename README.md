LadybugBundle
=============

This bundle provides an easy and extensible var_dump/print_r replacement for
Symfony2 projects, both in controllers or Twig templates. For example, with this
bundle, the following is possible:

``` php
<?php
    class UserController extends Controller
    {
        public function userAction($username) {
            ladybug_dump($username);
        }
    }

``` jinja
{{ user.username|ladybug_dump }}
```

Getting as a result:

<pre><strong><em>string(10)</em></strong> <span style="color:#080">"raulfraile"</span></pre>

## Installation

To install this bundle, you'll need both the [Ladybug library](/raulfraile/Ladybug)
and this bundle. Installation depends on how your project is setup:

### Step 1: Installation using the `bin/vendors.php` method

If you're using the `bin/vendors.php` method to manage your vendor libraries,
add the following entries to the `deps` in the root of your project file:

```
[Ladybug]
    git=http://github.com/raulfraile/Ladybug.git
    target=ladybug

[RaulFraileLadybugBundle]
    git=http://github.com/raulfraile/RaulFraileLadybugBundle.git
    target=bundles/RaulFraile/Bundle/LadybugBundle
```

Next, update your vendors by running:

``` bash
$ ./bin/vendors
```

Skip down to *Step 2*.

### Step 1 (alternative): Installation with submodules

If you're managing your vendor libraries with submodules, first create the
`vendor/bundles/RaulFraile/Bundle` directory and next add the two submodules:

``` bash
$ git submodule add git://github.com/raulfraile/Ladybug.git vendor/ladybug
$ git submodule add git://github.com/raulfraile/LadybugBundle.git vendor/bundles/RaulFraile/Bundle/LadybugBundle
```
### Step2: Configure the autoloader

Add the following entries to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...

    'Ladybug'           => __DIR__.'/../vendor/ladybug/lib',
    'RaulFraile'        => __DIR__.'/../vendor/bundles',
));
```

### Step3: Enable the bundle

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

<pre><strong><em>array</em></strong> [
    [0] => <strong><em>int</em></strong> <span style="color:#800">1</span>
    [1] => <strong><em>int</em></strong> <span style="color:#800">2</span>
    [2] => <strong><em>int</em></strong> <span style="color:#800">3</span>
]</pre>

### Dumping a GD image

``` php
<?php
    $img = imagecreatefrompng(__DIR__ . '/images/ladybug.png');
    ladybug_dump($img);
```
    
<pre><strong><em>resource(gd)</em></strong> [
    [gd] => [
        [version] => 2.0
        [support] => FreeType[with freetype], T1Lib, GIF, JPEG, PNG, WBMP
    ]
    [width] => 32px
    [height] => 32px
    [colors_palette] => 0
    [true_color] => TRUE
    [image] =>
        <img style="border:1px solid #ccc; padding:1px" src="https://github.com/raulfraile/Ladybug/raw/master/examples/images/ladybug.png" />
]</pre>

The same can be accomplished using the Twig filter `ladybug_dump`.

## Helpers

The are 3 helpers that can be used in any controller:

`ladybug_dump($var1[, $var2[, ...]])`: Dumps one or more variables

`ladybug_dump_die($var1[, $var2[, ...]])`: Dumps one or more variables and 
terminates the current script

`ladybug_dump_return($var1[, $var2[, ...]])`: Dumps one or more variables and
returns the string

Just `ladybug_dump` can be used inside Twig templates.