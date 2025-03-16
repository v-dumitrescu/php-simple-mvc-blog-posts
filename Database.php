<?php

namespace app;

use \PDO;

class Database
{

  private $dbh;
  private $stmt;

  public function __construct()
  {
    $host = DB_HOST;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $db_name = DB_NAME;
    $this->dbh = new PDO("mysql:host=$host;dbname=$db_name;", $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false
    ]);
  }

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
    return $this;
  }

  public function bind($data = [])
  {
    foreach ($data as $key => $value) {
      $this->stmt->bindValue(':' . $key, $value);
    }
  }

  public function exec()
  {
    $this->stmt->execute();
    return $this->stmt;
  }
}
