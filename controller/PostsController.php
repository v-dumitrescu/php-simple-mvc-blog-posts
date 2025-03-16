<?php

namespace app\controller;

use app\Router;
use app\model\Post;
use app\helpers\Security;
use app\helpers\Url;
use app\helpers\Errors;

class PostsController
{

  private $postModel;

  public function __construct()
  {
    $this->postModel = new Post();
  }

  public function index(Router $router)
  {
    $posts = $this->postModel->getAllPosts();
    $router->view('posts/index', [
      'posts' => $posts
    ]);
  }

  public function add(Router $router)
  {
    $req = $router->getRequestMethod();

    if ($req === 'GET') {
      return $router->view('posts/add');
    }

    $image = empty($_FILES['image']['tmp_name']) ?
      null : Security::cleanImage(IMAGES_UPLOAD_DIRECTORY_PATH);

    $author = !empty($_POST['author']) ?
      $_POST['author'] : 'Valentin Dumitrescu';

    $required = [
      'title' => $_POST['title'],
      'body' => $_POST['content']
    ];

    $post = [
      'title' => $_POST['title'],
      'author' => $author,
      'image' => $image,
      'body' => $_POST['content']
    ];

    $errors = Errors::emptyFields($required);

    if (empty($errors)) {
      $this->postModel->addPost($post);
      Url::redirect('/posts');
    } else {
      $router->view('posts/add', [
        'errors' => $errors
      ]);
    }
  }

  public function update() {}

  public function delete() {}
}
