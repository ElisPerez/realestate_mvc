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


// Convert TIME format from "16:30" to "4:30pm"
function timeFormat(string $time)
{
  $timestamp = strtotime($time);
  $formatted_time = date("g:ia", $timestamp);

  return $formatted_time; // Output: 4:30pm
}

// Convert the date format "2023-09-06" to Wednesday, September 6, 2023
function dateFormat(string $date)
{
  // date() is used to format the Unix timestamp into the desired format, where:
  // "l" represents the full weekday name (e.g., "Wednesday").
  // "d" represents the day of the month (e.g., "06").
  // "F" represents the full month name (e.g., "September").
  // "Y" represents the four-digit year (e.g., "2023")
  $formatted_date = date("l d F Y", strtotime($date));

  return $formatted_date; // This will output: "Wednesday 06 September 2023"
}

// Convert the date format "2023-09-06" to "Wednesday, September 6, 2023" and "miércoles 06 septiembre 2023" (No funciona porque mi computador está en inglés o eso creo)
function dateFormatSpanishEnglish(string $inputDate)
{
  // Set the locale to English (United States)
  setlocale(LC_TIME, 'en_US');
  // setlocale(LC_TIME, 'en_US.UTF-8');

  // Parse the input date
  $date = new DateTime($inputDate);

  // Format the date in English
  $englishDate = strftime('%A %d %B %Y', $date->getTimestamp());

  // Set the locale to Spanish (Colombia)
  setlocale(LC_TIME, 'es_CO');
  // setlocale(LC_TIME, 'spanish');
  // setlocale(LC_TIME, 'es_CO.UTF-8');
  // setlocale(LC_TIME, 'Spanish_Colombia.1252');

  // Format the date in Spanish
  $spanishDate = strftime('%A %d %B %Y', $date->getTimestamp());

  $formatted_date['english'] = $englishDate;
  $formatted_date['spanish'] = $spanishDate;
  // Output the results
  return $formatted_date;
}
