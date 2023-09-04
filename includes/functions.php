<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . '/functions.php');
define('IMAGES_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/images/');

function incluirTemplate(string $nombre, bool $isHome = false)
{
  include TEMPLATES_URL . "/${nombre}.php";
}

function isAuthenticated(): void
{
  // SESION DEL USER
  session_start();

  if ($_SESSION['login'] && basename($_SERVER['PHP_SELF']) === 'login.php') {
    header('location: /admin');
  }

  if (!$_SESSION['login'] && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header('location: /login.php');
  }
}

function debugging($variable)
{
  echo '<pre>';
  echo var_dump($variable);
  echo '</pre>';
  exit;
}

// Sanitizar/Escapar HTML
function s($html): string
{
  $s = htmlspecialchars($html);

  return $s;
}

// Validar tipo de contenido
function validateTypeContent($type)
{
  $types = ['seller', 'property'];

  // Buscar type en types
  return in_array($type, $types);
}

// Muestra los mensajes
function showNotification($code)
{
  $message = '';

  switch ($code) {
    case 1:
      $message = 'Creado Correctamente';
      break;
    case 2:
      $message = 'Actualizado Correctamente';
      break;
    case 3:
      $message = 'Eliminado Correctamente';
      break;

    default:
      $message = false;
      break;
  }

  return $message;
}


/**
 * The function validates a URL by checking if the "id" parameter is a valid integer, and if not, it
 * redirects to the specified URL.
 *
 * @param string url The "url" parameter is a string that represents the URL to redirect to if the
 * validation fails.
 *
 * @return the validated integer value of the "id" parameter from the URL.
 */
function validateOrRedirect(string $url)
{
  // Validar Url por Id válido
  $id = $_GET["id"];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if (!$id) {
    header("Location: ${url}");
  }

  return $id;
}
