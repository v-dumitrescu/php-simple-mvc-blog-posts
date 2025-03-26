<?php

namespace app\helpers;

use app\helpers\Security;

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

  public static function loadImage($path = '')
  {

    if ($path) {
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $path);
      finfo_close($finfo);

      $base64_image_content = base64_encode(file_get_contents($path));
      $image = "<img class='card-img-top' src='data:$mime;base64,$base64_image_content'>";
      return $image;
    }
    
    $source = Security::cleanHtml('https://picsum.photos/346/173');
    $image = "<img class='card-img-top' src='$source' alt='Blog Post Image'>";
    return $image;
  }
}
