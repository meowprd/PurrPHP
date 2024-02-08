<?php
// required in public/index.php

// main settings
define("DEBUG", TRUE); // required filp/whoops package

// base dirs
define("APP_PATH", dirname(__DIR__));
define("CONFIG_PATH", APP_PATH . '/config');
define("VIEWS_PATH", APP_PATH . '/app/Views');

// files paths
define("ROUTES_PATH", CONFIG_PATH . '/routes.php');

// CLI commands namespace
define("COMMANDS_NAMESPACE", 'PurrPHP\\Console\\Commands\\'); // system commands