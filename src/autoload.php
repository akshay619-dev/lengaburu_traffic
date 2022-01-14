<?php

spl_autoload_register(function ($name) {
    $filepath = explode('\\', $name);
    require_once('./src/' . implode('/', $filepath) . '.php');
});
