<?php

namespace app;

use app\helpers\Url;

use app\helpers\Errors;

class Router
{
  private array $routes = [];
  private string $requestMethod;
  private string $requestUri;

  public function __construct() {
    $this->setRequestMethod($_SERVER['REQUEST_METHOD']);
    $this->setRequestUri($_SERVER['REQUEST_URI']);
  }

  public function get($uri, $fn)
  {
    $this->setRoute($uri, 'GET', $fn);
  }

  public function post($uri, $fn)
  {
    $this->setRoute($uri, 'POST', $fn);
  }

  public function setRequestMethod($value) {
    $this->requestMethod = $value;
  }

  public function setRequestUri($value) {
    $this->requestUri = $value;
  }

  public function getRequestMethod() {
    return $this->requestMethod;
  }

  public function getRequestUri() {
    return $this->requestUri;
  }

  private function setRoute($uri, $method, $fn)
  {
    array_push(
      $this->routes,
      [
        'uri' => $uri,
        'controller' => $fn[0],
        'method' => $fn[1],
        'httpMethod' => $method
      ]
    );
  }

  public function view($view, $data = [])
  {
    extract($data);
    ob_start();
    require_once Url::rootDir('views/' . $view . '.php');
    $content = ob_get_clean();
    require_once Url::rootDir('views/partials/layout.php');
  }

  public function route()
  {

    foreach ($this->routes as $arr) {
      if ($arr['uri'] === $this->requestUri && $this->requestMethod === $arr['httpMethod']) {
        $controller = '\\' . $arr['controller'];
        $method = $arr['method'];
      }
    }
    if (isset($controller)) {
      new $controller()->$method($this);
    } else {
      Errors::notFound();
    }
  }
}
