<?php

namespace app\helpers;

use app\helpers\Url;

class Errors
{
  public static function notFound()
  {
    return require_once Url::rootDir('views/404.php');
  }

  public static function emptyFields($required = [])
  {
    $errors = [];

    foreach ($required as $key => $value) {
      if (!trim($value)) {
        array_push($errors, ucfirst($key) . ' is required!');
      }
    }
    return $errors;
  }
}
