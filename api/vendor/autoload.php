<?php

spl_autoload_register(function($class_name){

    $DS = DIRECTORY_SEPARATOR;

    $class = __DIR__.$DS.'..'.$DS.str_replace(['\\','/'], [$DS,$DS], $class_name).'.class.php';

    if(!is_file($class)){
        $class = __DIR__.$DS.'..'.$DS.str_replace(['\\','/'], [$DS,$DS], $class_name).'.php';
    }

    if(!is_file($class)){
        throw new Exception("Class {$class} not found!");				
    }
    else {
        require_once($class);	
    }		
});