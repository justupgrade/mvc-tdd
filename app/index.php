<?php

function __autoload($name)
{
    require "libs/$name.php";
}

require_once 'config/database.php';
require_once 'config/paths.php';

Session::init();
$app = new Bootstrap();

