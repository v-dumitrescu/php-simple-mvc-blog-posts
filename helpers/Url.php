<?php

namespace app\helpers;

class Url
{

  public static function rootDir($path = '')
  {
    return dirname(__DIR__) . '/' . $path;
  }

  public static function redirect($url)
  {
    header("Location: $url");
    die;
  }
}
