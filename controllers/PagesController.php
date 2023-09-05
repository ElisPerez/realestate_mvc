<?php

namespace Controllers;

use Model\Property;
use MVC\Router;

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
    $router->render('pages/contact');
  }
}
