<?php
require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;

// Connect to DB
$db_connect = connectDB(); // Creamos una sola conexion y la pasamos a ActiveRecord

ActiveRecord::setDB($db_connect);
