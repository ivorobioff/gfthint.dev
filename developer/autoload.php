<?php
require_once __DIR__.'/lib/debug.php';
require_once __DIR__.'/lib/ApplicationResolver.php';
require_once __DIR__.'/lib/BitMask.php';
require_once __DIR__.'/lib/Enum.php';
require_once __DIR__.'/lib/StdHelper.php';

use Zend\Loader\StandardAutoloader;
$loader = new StandardAutoloader();
$loader->registerNamespace('Developer\Filter', __DIR__.'/lib/Filter');
$loader->registerNamespace('Developer\Validator', __DIR__.'/lib/Validator');
$loader->registerNamespace('Developer\Cast', __DIR__.'/lib/Cast');
$loader->registerNamespace('Developer\Query', __DIR__.'/lib/Query');
$loader->registerNamespace('Developer\Hydrator', __DIR__.'/lib/Hydrator');

$loader->register();