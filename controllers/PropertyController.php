<?php

namespace Controllers;

use MVC\Router;
use Model\Property;
use Model\Seller;
use Intervention\Image\ImageManagerStatic as InterImage;

class PropertyController
{
  public static function index(Router $router)
  {
    $properties = Property::all();
    $sellers = Seller::all();
    // Muestra mensaje condicional
    $result = $_GET["result"] ?? null;

    $router->render('properties/admin', [
      'properties' => $properties,
      'result' => $result,
      'sellers' => $sellers
    ]);
  }

  public static function create(Router $router)
  {
    $property = new Property();
    $sellers = Seller::all();
    // Array con mensajes de errores
    $errors = Property::getErrors(); // Accede a un metodo static de la clase Property que al ser static no hay necesidad de instanciar la clase.

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Create new instance
      $property = new Property($_POST['property']);
      $imageArray = $_FILES['property'];



      if ($imageArray['tmp_name']['image']) {
        // Obtener la extension
        $extension = pathinfo($imageArray['name']['image'])['extension'];
        // Generar un nombre único
        $imageName = md5(uniqid(rand(), true)) . '.' . $extension;
        // Resize a la imagen con InterventionImage to: Width 800px and Height 600
        $img = InterImage::make($imageArray['tmp_name']['image']);
        $img->fit(800, 600);

        // Setear el nombre único de la imagen al atributo $image de la instancia en memoria.
        $property->setImage($imageName);
      }
      /** VALIDATE */
      $errors = $property->validate();

      // Revisar que el array de errors esté vacío
      if (empty($errors)) {
        /** SUBIDA DE ARCHIVOS */
        // Verificar si ya existe la carpeta 'images' y sinó crearla
        if (!is_dir(IMAGES_FOLDER)) {
          mkdir(IMAGES_FOLDER);
        }
        // Save image to server
        $img->save(IMAGES_FOLDER . $imageName);

        // Save to DB
        $property->save();
      }
    }

    $router->render('properties/create', [
      'property' => $property,
      'sellers' => $sellers,
      'errors' => $errors
    ]);
  }

  public static function update(Router $router)
  {
    $id = validateOrRedirect('/admin');
    $property = Property::find($id);
    $sellers = Seller::all();
    // Array con mensajes de errores
    $errors = Property::getErrors();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Asignar los atributos
      $args = $_POST['property'];
      $imageArray = $_FILES['property'];

      $property->synchronize($args);

      // Validación
      $errors = $property->validate();

      // Revisar que el array de errors esté vacío y si lo está proceder a guardar en DB
      if (empty($errors)) {
        // Subida de archivos al servidor (Si hay cambio de imagen)
        if ($imageArray['tmp_name']['image']) {
          // Obtener la extension
          $extension = pathinfo($imageArray['name']['image'])['extension'];
          // Generar un nombre único
          $imageName = md5(uniqid(rand(), true)) . '.' . $extension;
          // Resize a la imagen con InterventionImage to: Width 800px and Height 600
          $img = InterImage::make($imageArray['tmp_name']['image']);
          $img->fit(800, 600);
          // Setear el nombre único de la imagen al atributo $image de la instancia.
          $property->setImage($imageName);
          // Almacenar la imagen
          $img->save(IMAGES_FOLDER . $imageName);
        }

        // Actualizar en la base de datos
        $property->save();
      }
    }

    $router->render('/properties/update', [
      'property' => $property,
      'errors' => $errors,
      'sellers' => $sellers
    ]);
  }

  public static function delete()
  {
    // Eliminar una property
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      // Validar ID
      $id = $_POST["id"];
      $id = filter_var($id,  FILTER_VALIDATE_INT);

      if ($id) {
        $type = $_POST['type'];
        if (validateTypeContent($type)) {
          $property = Property::find($id);
          $property->delete();
        }
      }
    }
  }
}
