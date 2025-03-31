<?php
require_once 'config/database.php';
require_once 'config/Router.php';

$router = new Router();
$router->handleRequest();