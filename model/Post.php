<?php

namespace app\model;

use app\Database;

class Post
{

  private object $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllPosts()
  {
    $query = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
    $posts = $query->exec()->fetchAll();
    return $posts;
  }

  public function addPost($post)
  {
    $query = $this->db->query('INSERT INTO posts(title, body, image, author) VALUES(:title, :body, :image, :author)');
    $query->bind($post);
    $query->exec();
  }

  public function getPostById($id) {
    $query = $this->db->query('SELECT * FROM posts WHERE id = :id');
    $query->bind([
      'id' => $id
    ]);
    $post = $query->exec()->fetch();
    return $post;
  }

  public function updatePost($post) {
    $query = $this->db->query('UPDATE posts SET title = :title, author = :author, image = :image, body = :body WHERE id = :id');
    $query->bind($post);
    $query->exec();
  }

  public function deletePost($id)
  {
    $query = $this->db->query('DELETE FROM posts WHERE id = :id');
    $query->bind([
      'id' => $id
    ]);
    $query->exec();
  }
}
