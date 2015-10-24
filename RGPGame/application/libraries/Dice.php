<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Dice {

    public final function next($range) {
        return $range[ rand(min($range)-1, max($range)-1) ];
    }

}