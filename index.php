<?php

require 'config.php';

include './libs/Bootstrap.php';
include './libs/Controller.php';
include './libs/Database.php';
include './libs/Model.php';
include './libs/Session.php';
include './libs/View.php';

// Load the Bootstrap!
$bootstrap = new Bootstrap();

$bootstrap->init();
