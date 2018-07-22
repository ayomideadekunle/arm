<?php

class View {

    function __construct() {

    }

    public function render($name, $noInclude = FALSE) {
        require 'views/' . $name . '.php';
    }

}
