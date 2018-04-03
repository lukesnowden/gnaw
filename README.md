
# Front End Scaffold Generator

## Installation

You can install the package via Composer:

```
composer require ensphere/gnaw
````

Next, you must install the service provider to `config/app.php`:

```php
'providers' => [
    // ...
    Ensphere\Gnaw\Providers\AppServiceProvider::class,
];
```

### Post CSS Disk

And finally you should add a disk named `post-css` to `app/config/filesystems.php` on which the `.pcss` will be saved. 
This would be a typical configuration:

```php
// ...
'disks' => [
    // ...
    'post-css' => [
        'driver' => 'local',
        'root'   => resource_path( 'assets/src/css' ),
    ],
// ...    
```

Optionally, you may publish the configuration file with (it is advised to publish and store your variables in the application config file and not the Post CSS config files):

```
php artisan vendor:publish --provider="Ensphere\Gnaw\AppServiceProvider" --tag="config"
```

## Usage

### Utilities

#### Columns

Current max columns is 16;

* `col:1-of-2`
* `col:5-of-16`
* `col:4-of-12`

#### Colours

* `background-color:blue`
* `color:red`

#### Spacing

* `padding:large`
* `padding-left:large`
* `padding-top:small`
* `padding-right:medium`
* `padding-bottom:extra-large`
* `padding-y-axis:very-small`
* `padding-x-axis:large`


* `margin:large`
* `margin-left:large`
* `margin-top:small`
* `margin-right:medium`
* `margin-bottom:extra-large`
* `margin-y-axis:very-small`
* `margin-x-axis:large`

#### Helpers

* `full-width`
* `not-a-list`
* `float:left` | `float:right`
* `children:same-height`
* `child:vertically-aligned`

example;

```html
<ul class="not-a-list children:same-height">
    <li class="child:vertically-aligned"><img src="http://placehold.it/40x40" alt=""></li>
    <li class="child:vertically-aligned"><img src="http://placehold.it/40x60" alt=""></li>
    <li class="child:vertically-aligned"><img src="http://placehold.it/40x80" alt=""></li>
</ul>
```

#### Media Query Variants

This is a mobile first utility framework so no prefix is mobile use. Prefixes available ar `tablet--`, `desktop--`, `wide--` and `huge--`.

* `tablet--padding-x-axis:large`
* `dektop--col:2-of-12`
* `wide--margin-left:small`
* `huge--color:blue`

