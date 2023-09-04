<?php

define('ROOT_PATH', __DIR__); // Ruta base del archivo index.php
require_once ROOT_PATH . '/../includes/app.php'; // Usa la ruta base para incluir app.php

use MVC\Router;
use Controllers\PropertyController;
use Controllers\SellerController;

$router = new Router();

/** Routes */
$router->get('/', function () {
  echo "From Home";
});
$router->get('/admin', [PropertyController::class, 'index']);

/** Properties */
// Create
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/create', [PropertyController::class, 'create']);
// UPDATE
$router->get('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/update', [PropertyController::class, 'update']);
// DELETE
$router->post('/properties/delete', [PropertyController::class, 'delete']);

/** SELLERS */
// Create
$router->get('/sellers/create', [SellerController::class, 'create']);
$router->post('/sellers/create', [SellerController::class, 'create']);
// UPDATE
$router->get('/sellers/update', [SellerController::class, 'update']);
$router->post('/sellers/update', [SellerController::class, 'update']);
// DELETE
$router->post('/sellers/delete', [SellerController::class, 'delete']);


$router->checkRoutes();
