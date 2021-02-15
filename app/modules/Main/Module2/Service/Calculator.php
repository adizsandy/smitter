<?php

namespace App\Module\Main\Module2\Service;

class Calculator {
    function get_square($n) {
        return $n*$n;
    }

    function get_cube($n) {
        return $n * $n * $n;
    }
}