<?php

require_once 'config/database.php';
require_once 'config/paths.php';

function __autoload($name)
{
    require "libs/$name.php";
}

Session::init();
$app = new Bootstrap();

