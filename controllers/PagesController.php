<?php

namespace Controllers;

use Model\Property;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PagesController
{
  public static function home(Router $router)
  {
    $properties = Property::get(3);
    $isHome = true;
    $router->render('pages/home', [
      'properties' => $properties,
      'isHome' => $isHome
    ]);
  }

  public static function aboutUs(Router $router)
  {
    $router->render('pages/about-us');
  }

  public static function properties(Router $router)
  {
    $properties = Property::all();
    $router->render('pages/properties', [
      'properties' => $properties
    ]);
  }

  public static function property(Router $router)
  {
    $id = validateOrRedirect('/properties');

    $property = Property::find($id);

    if (!$property) {
      header('location: /properties');
    }

    $router->render('pages/property', [
      'property' => $property
    ]);
  }

  public static function blog(Router $router)
  {
    $router->render('pages/blog');
  }

  public static function article(Router $router)
  {
    $router->render('pages/article');
  }

  public static function contact(Router $router)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = $_POST['contact'];

      // Formatear hora a am/pm
      $formatted_time = timeFormat($data['time']);
      // Formatear fecha a "Wednesday, September 6, 2023" and "miércoles 06 septiembre 2023"
      $formatted_date = dateFormat($data['date']);

      /** Crear instancia de PHPMAILER y configurar SMTP */
      $phpmailer = new PHPMailer();
      // Configurar SMTP (Simple Mail Transfer Protocol)
      $phpmailer->isSMTP();
      $phpmailer->Host       = $_ENV['MAIL_HOST'];
      $phpmailer->Port       = $_ENV['MAIL_PORT'];
      $phpmailer->SMTPAuth   = $_ENV['MAIL_SMTPAUTH'];
      $phpmailer->Username   = $_ENV['MAIL_USERNAME'];
      $phpmailer->Password   = $_ENV['MAIL_PASSWORD'];
      $phpmailer->SMTPSecure = $_ENV['MAIL_ENCRYPTION']; // tls = Transport Layer Security

      /** Configurar el contenido del Email */
      $phpmailer->setFrom('admin@realestate.com');
      $phpmailer->addAddress('admin@realestate.com', 'RealEstate.com');
      $phpmailer->Subject = 'Tienes un nuevo mensaje';

      // Habilitar HTML
      $phpmailer->isHTML(true);
      $phpmailer->CharSet = 'UTF-8'; // UTF-8: Unicode Transformation Format - 8 bits.

      // Definir el contenido
      $body  = '<html>';
      $body .= '<p>Tienes un nuevo mensaje</p>';
      $body .= '<p>Nombre: ' . $data['name'] . '</p>';
      $body .= '<p>Email: ' . $data['email'] . '</p>';
      $body .= '<p>Teléfono: ' . $data['phone'] . '</p>';
      $body .= '<p>Mensaje: ' . $data['message'] . '</p>';
      $body .= '<p>Vende o Compra: ' . $data['type'] . '</p>';
      $body .= '<p>Precio o Presupuesto: $' . $data['price'] . '</p>';
      $body .= '<p>Contactar por: ' . $data['contact'] . '</p>';
      $body .= '<p>Fecha a contactar: ' . $formatted_date . '</p>';
      $body .= '<p>Hora a contactar: ' . $formatted_time . '</p>';
      $body .= '</html>';
      $phpmailer->Body = $body;
      $phpmailer->AltBody = 'Este es texto alternativo sin HTML';

      // Enviar el email
      $wasSend = $phpmailer->send();

      if ($wasSend) {
        echo 'Mensaje enviado correctamente';
      } else {
        echo 'El mensaje no se pudo enviar';
      }
    }

    $router->render('pages/contact');
  }
}
