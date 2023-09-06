<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController {
  public static function login(Router $router)
  {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Crear nueva instancia con lo que envió el usuario en el formulario
      $auth = new Admin($_POST);

      $errors = $auth->validate();

      if (empty($errors)) {
        // Verificar si el usuario existe en la base de datos
        $result = $auth->userExist();

        if (!$result) {
          // Mostrar errores si no existe email en db
          $errors = Admin::getErrors();
        } else {
          // Verificar el password
          $isPasswordOk = $auth->checkPassword($result);

          if ($isPasswordOk) {
            // Autenticar el usuario
            $auth->authenticate();
          } else {
            // Password incorrecto (mustra mensaje de error)
            $errors = Admin::getErrors();
          }
        }


      }

    }

    $router->render('auth/login', [
      'errors' => $errors
    ]);
  }

  public static function logout()
  {
    session_start();
    $_SESSION = [];

    header('Location: /');
  }
}