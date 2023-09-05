<?php

function connectDB(): mysqli
{
  $host = $_ENV['DB_HOST']; // Como estamos trabajando con Docker NO debe ser 'localhost' en cambio debe ser el nombre del servicio dado en docker-compose.yml
  $user = $_ENV['DB_USER'];
  $password = $_ENV['DB_PASSWORD'];
  $dbname = $_ENV['DB_NAME'];

  $db = new mysqli($host, $user, $password, $dbname);

  if (!$db) {
    echo "ERROR: No se pudo conectar a la base de datos";
    exit;
  }

  return $db; // Retornar una instancia de la base de datos
}
