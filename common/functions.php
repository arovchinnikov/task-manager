<?php

function dd(mixed $var): void
{
    echo "<pre>";
    print_r($var);
    exit;
}