<?php

use app\Router;

$router = new Router();

use app\controller\PostsController;
use app\controller\PagesController;

// Pages routes
$router->get('/', [PagesController::class, 'index']);
$router->get('/about', [PagesController::class, 'about']);

// Posts routes
$router->get('/posts', [PostsController::class, 'index']);
$router->get('/post/read', [PostsController::class, 'read']);
$router->get('/posts/add', [PostsController::class, 'add']);
$router->post('/posts/add', [PostsController::class, 'add']);
$router->get('/posts/update', [PostsController::class, 'update']);
$router->post('/posts/update', [PostsController::class, 'update']);
$router->post('/posts/delete', [PostsController::class, 'delete']);

$router->route();
