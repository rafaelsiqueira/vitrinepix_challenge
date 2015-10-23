<?php
namespace util;

final class Dice {

    static function next($range) {
        return $range[ rand(min($range)-1, max($range)-1) ];
    }

}