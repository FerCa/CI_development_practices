<?php

function my_autoload ($pClassName) {
    include_once(__DIR__ . '/' . str_replace('\\', '/', $pClassName) . ".php");
}

spl_autoload_register("my_autoload");