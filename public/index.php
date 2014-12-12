<?php
chdir(dirname(__DIR__));

require 'vendor/autoload.php';
require 'developer/autoload.php';

define('APP_ROOT', __DIR__);
Zend\Mvc\Application::init(require 'config/application.config.php')->run();