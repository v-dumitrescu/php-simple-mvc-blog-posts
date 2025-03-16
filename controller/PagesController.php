<?php

namespace app\controller;

use app\Router;

class PagesController
{

  public function index(Router $router)
  {
    $router->view('pages/index');
  }

  public function about(Router $router)
  {
    $router->view('pages/about');
  }
}
