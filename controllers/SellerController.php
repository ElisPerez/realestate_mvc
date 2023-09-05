<?php

namespace Controllers;

use MVC\Router;
use Model\Seller;

class SellerController
{
  public static function create(Router $router)
  {
    $seller = new Seller;
    $errors = Seller::getErrors();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Crear instancia
      $seller = new Seller($_POST['seller']);

      // Validar que no haya campos vacíos
      $errors = $seller->validate();

      // Si no hay errores
      if (empty($errors)) {
        $seller->save();
      }
    }

    $router->render('sellers/create', [
      'seller' => $seller,
      'errors' => $errors
    ]);
  }

  public static function update(Router $router)
  {
    // Validar ID
    $id = validateOrRedirect('/admin');

    // Obtener vendedor desde DB
    $seller = Seller::find($id);

    // Array con mensajes de errores
    $errors = Seller::getErrors();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Asignar los valores
      $args = $_POST['seller'];
      // Sincronizar objeto en memoria con los datos que escribio el usuario
      $seller->synchronize($args);
      // Validación
      $errors = $seller->validate();

      if (empty($errors)) {
        // Guardar en DB
        $seller->save();
      }
    }

    $router->render('sellers/update', [
      'seller' => $seller,
      'errors' => $errors
    ]);
  }

  public static function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Validar ID
      $id = $_POST['id'];
      $id = filter_var($id,  FILTER_VALIDATE_INT);

      if ($id) {
        $type = $_POST['type'];

        if (validateTypeContent($type)) {
          $seller = Seller::find($id);
          $seller->delete();
        }
      }
    }
  }
}
