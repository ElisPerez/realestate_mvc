<?php

define('ROOT_PATH', __DIR__); // Ruta base del archivo index.php
require_once ROOT_PATH . '/../includes/app.php'; // Usa la ruta base para incluir app.php

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropertyController;
use Controllers\SellerController;
use Controllers\PagesController;

$router = new Router();

/** Routes */
/** --------- PRIVATE ZONE ----------- */
/** Properties */
$router->get('/admin', [PropertyController::class, 'index']);
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

/** ---------- PUBLIC ZONE ---------- */
/** Pages */
$router->get('/', [PagesController::class, 'home']);
$router->get('/about-us', [PagesController::class, 'aboutUs']);
$router->get('/properties', [PagesController::class, 'properties']);
$router->get('/property', [PagesController::class, 'property']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/article', [PagesController::class, 'article']);
// contacto get and post
$router->get('/contact', [PagesController::class, 'contact']);
$router->post('/contact', [PagesController::class, 'contact']);

/** ---------- Authorization -------- */
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


$router->checkRoutes();
