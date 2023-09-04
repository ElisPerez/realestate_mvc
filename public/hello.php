<?php
define('ROOT_PATH', __DIR__); // Ruta base del archivo index.php
require_once ROOT_PATH . '/../includes/app.php'; // Usa la ruta base para incluir app.php

echo "from hello.php";

debugging($_SERVER);
?>