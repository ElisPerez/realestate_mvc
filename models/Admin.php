<?php

namespace Model;

class Admin extends ActiveRecord
{
  // Base de datos
  protected static $table = 'users';
  protected static $columnsDB = ['id', 'email', 'password'];

  public $id;
  public $email;
  public $password;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
  }

  public function validate()
  {
    if (!$this->email) {
      self::$errors[] = 'El email es obligatorio';
    }
    if (!$this->password) {
      self::$errors[] = 'El password es obligatorio';
    }

    return self::$errors;
  }

  public function userExist()
  {
    // Revisar si usuario existe
    $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
    $result = self::$db->query($query);

    if (!$result->num_rows) {
      self::$errors[] = 'El usuario no existe';
      return;
    }

    return $result;
  }

  public function checkPassword($result)
  {
    $user = $result->fetch_object();

    $isPasswordOk = password_verify($this->password, $user->password);

    if (!$isPasswordOk) {
      self::$errors[] = 'El password es incorrecto';
    }

    return $isPasswordOk;
  }

  public function authenticate()
  {
    session_start();

    // Llenar el array de session
    $_SESSION['user'] = $this->email;
    $_SESSION['login'] = true;

    header('location: /admin');

  }
}
