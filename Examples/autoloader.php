<?php

spl_autoload_register(function ($class) {
    if($class != 'PHPUnit_Extensions_Story_TestCase') {
        $path = './../' . str_replace('\\', '/', $class) . '.php';
        include $path;
    }
});

