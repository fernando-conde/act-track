<?php
use ActTrack\Container;

$loader = require_once 'vendor'.DIRECTORY_SEPARATOR.'/autoload.php';
$loader->addPsr4('ActTrack\\', __DIR__.'/ActTrack/');

$container = new Container();

$action = $container->getBuilderAction()->get('123');

dump($action);

echo $container->getSerializer()->serialize($action, 'json');

dump($container->getStopwatch()->stop('start'));
