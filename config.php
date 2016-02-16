<?php

require __DIR__.'/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Fluent;
use Illuminate\View\ViewServiceProvider;

$app = new Container();
$app['events'] = new Dispatcher();
$app['config'] = new Fluent();
$app['files'] = new Filesystem();

$app['config']['view.paths'] = [__DIR__.'/views/'];
$app['config']['view.compiled'] = __DIR__.'/compiled/';

$serviceProvider = new ViewServiceProvider($app);
$serviceProvider->register();
$serviceProvider->boot();
Facade::setFacadeApplication($app);

class_alias(View::class, 'View');
