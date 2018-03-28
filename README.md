
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
    Ensphere\Gnaw\AppServiceProvider::class,
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
