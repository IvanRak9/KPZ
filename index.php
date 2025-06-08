<?php
// hotel-booking/index.php

define('ROOT', __DIR__);
require ROOT . '/public/index.php';

require_once ROOT . '/app/config.php';

session_start();

require_once ROOT . '/app/core/Database.php';
require_once ROOT . '/app/core/Controller.php';
require_once ROOT . '/app/core/Router.php';

$router = new Router();
