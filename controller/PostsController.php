<?php

namespace app\controller;

use app\Router;
use app\model\Post;
use app\helpers\Security;
use app\helpers\Url;
use app\helpers\Errors;

class PostsController
{

  private object $postModel;

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

    $requiredFields = [
      'title' => $_POST['title'],
      'body' => $_POST['content']
    ];

    $post = [
      'title' => $_POST['title'],
      'author' => $author,
      'image' => $image,
      'body' => $_POST['content']
    ];

    $errors = Errors::emptyFields($requiredFields);

    if (empty($errors)) {

      if (is_array($image)) {
        list($imageError) = $image;
        return $router->view('posts/add', [
          'imageError' => $imageError
        ]);
      }

      $this->postModel->addPost($post);
      Url::redirect('/posts');
    } else {
      $router->view('posts/add', [
        'errors' => $errors
      ]);
    }
  }

  public function update(Router $router)
  {
    $req = $router->getRequestMethod();
    if ($req === 'GET') {
      $qs = $_SERVER['QUERY_STRING'] ?? null;
      if (!$qs) {
        return Url::redirect('/posts');
      }
      $id = explode('=', $qs)[1];
      $post = $this->postModel->getPostById($id);
      return $router->view('posts/update', [
        'post' => $post
      ]);
    }
    $post = $this->postModel->getPostById($_POST['id']);

    $image = empty($_FILES['image']['tmp_name']) ?
      $post->image : Security::cleanImage(IMAGES_UPLOAD_DIRECTORY_PATH);

    $author = !empty($_POST['author']) ?
      $_POST['author'] : 'Valentin Dumitrescu';

    $requiredFields = [
      'title' => $_POST['title'],
      'body' => $_POST['content']
    ];

    $newPost = [
      'id' => $_POST['id'],
      'title' => $_POST['title'],
      'author' => $author,
      'image' => $image,
      'body' => $_POST['content']
    ];

    $errors = Errors::emptyFields($requiredFields);

    if (empty($errors)) {

      if (is_array($image)) {
        list($imageError) = $image;
        return $router->view('posts/update', [
          'post' => $post,
          'imageError' => $imageError
        ]);
      }

      $this->postModel->updatePost($newPost);
      Url::redirect('/posts');
    } else {
      $router->view('posts/update', [
        'post' => $post,
        'errors' => $errors
      ]);
    }
  }

  public function delete()
  {
    $id = $_POST['id'];
    $this->postModel->deletePost($id);
    Url::redirect('/posts');
  }
}
