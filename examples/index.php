<?php

require "vendor/autoload.php";
use henrik\container\Container;

$container = new Container();

$container->set('x',new stdClass());

var_dump($container->get('x'));