<?php

namespace MVC;

class Router
{
  public $routesGET = [];
  public $routesPOST = [];

  public function get($url, $fn)
  {
    $this->routesGET[$url] = $fn;
    // array(1) {["/properties/create"] => array(2) {[0] => string(30) "Controllers\PropertyController"[1] => string(6) "create"}}
  }

  public function post($url, $fn)
  {
    $this->routesPOST[$url] = $fn;
  }

  public function checkRoutes()
  {
    session_start();
    $auth = $_SESSION['login'] ?? null;
    // Array de rutas protegidas
    $protected_routes = ['/admin', '/properties/create', '/properties/update', '/properties/delete', '/sellers/create', '/sellers/update', '/sellers/delete'];

    // $current_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Ignora los parámetros de consulta, PATH_INFO está deprecated.
    $current_url = $_SERVER['REDIRECT_URL'] ?? '/'; // Otra opción más fácil
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
      $fn = $this->routesGET[$current_url] ?? null;
    } else {
      $fn = $this->routesPOST[$current_url] ?? null;
    }

    // Proteger las rutas
    if (in_array($current_url, $protected_routes) && !$auth) {
      header('Location: /login');
    }

    // Si está autenticado no le permitirá ingresar a "/login"
    if ($current_url === '/login' && $auth) {
      header('location: /admin');
    }

    if ($fn) {
      call_user_func($fn, $this);
    } else {
      echo "<h1>Página no encontrada</h1>";
      // debugging($_SERVER['REDIRECT_URL']); // Verificar que la url no tenga el "/" al final. Ej: "/admin/"
    }
  }

  // Muestra la vista
  public function render($view, $data = [])
  {
    foreach ($data as $key => $value) {
      $$key = $value; // doble $$ variable de variable
    }

    ob_start(); // Iniciar el almacenamiento en memoria

    include __DIR__ . "/../views/$view.php";

    $contenido = ob_get_clean(); // Limpiar almacenamiento en memoria

    include __DIR__ . "/../views/layout.php";
  }
}
