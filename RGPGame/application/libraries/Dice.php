<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Dice {

    static function nextStatic($range) {
        return $range[ rand(min($range)-1, max($range)-1) ];
    }

    public final function next($range) {
        return static::nextStatic($range);
    }

}