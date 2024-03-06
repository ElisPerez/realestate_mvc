<?php

require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;

// Enviroment variable
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
// Or:
// $dotenv->safeload(); // para evitar el error si no existe archivo .env

// Connect to DB
$db_connect = connectDB(); // Creamos una sola conexion y la pasamos a ActiveRecord

ActiveRecord::setDB($db_connect);
