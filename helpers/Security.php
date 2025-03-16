<?php

namespace app\helpers;

class Security
{
  public static function cleanHtml($output)
  {
    return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
  }

  public static function cleanImage($path)
  {

    define('DS', DIRECTORY_SEPARATOR);

    $upload_dir = $path;

    if (!is_dir($upload_dir)) {
      mkdir($upload_dir);
    }

    $system_temp_dir = ((ini_get('upload_tmp_dir') === '') ? (sys_get_temp_dir()) : (ini_get('upload_tmp_dir')));

    $allowed_size = 2000000;

    $success = null;
    $file_name = $_FILES['image']['name'];
    $file_tmp_name = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_ext = strtolower($file_ext);

    $random_name = random_int(1, 9999999999) . '.' . $file_ext;
    $target_path = $system_temp_dir . DS . $random_name;

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp_name);
    finfo_close($finfo);

    if ($file_ext === 'jpg' || $file_ext === 'jpeg' || $file_ext === 'png' || $file_ext === '') {
      if ($file_size < $allowed_size) {
        if (($mime === 'image/jpeg' || $mime === 'image/png') && getimagesize($file_tmp_name)) {
          if ($mime === 'image/jpeg') {
            $image = imagecreatefromjpeg($file_tmp_name);
            imagejpeg($image, $target_path, 100);
          } else {
            $image = imagecreatefrompng($file_tmp_name);
            imagepng($image, $target_path, 9);
          }
          imagedestroy($image);
          if (rename($target_path, $upload_dir . $random_name)) {
            $success = true;
            echo 'File uploaded';
          } else {
            echo 'Error in file uploading.';
          }
          if (file_exists($target_path)) {
            unlink($target_path);
          }
        } else {
          echo 'File type not supported.';
        }
      } else {
        echo 'File must be less than 2MB.';
      }
    } else {
      echo 'Invalid file.';
    }
    if ($success) {
      return $upload_dir . $random_name;
    }
  }
}
