<?php

require_once './config.php';
require_once 'core/Router.php';
require_once './models/Inventory.php';

$router = new Router();
$router->route();
