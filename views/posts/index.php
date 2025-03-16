<?php

use app\helpers\Security;

foreach ($posts as $post): ?>

  <div class="card mb-2">
    <div class="card-body">
      <h5 class="card-title"><?= Security::cleanHtml($post->title); ?></h5>
      <small class="card-subtitle mb-2 text-body-secondary">At <?= Security::cleanHtml(date('d/M/Y H:i:s', strtotime($post->created_at))); ?></small>
      <h6 class="card-subtitle mb-2 text-body-secondary">Written by <?= Security::cleanHtml($post->author); ?></h6>
      <p class="card-text"><?= Security::cleanHtml($post->body); ?></p>
      <a class="btn btn-info text-white" href="/posts/edit">Edit</a>
      <form style="display:inline-block;" action="/posts/delete" method="POST">
        <button class="btn btn-danger">Delete</button>
        <input type="hidden" name="id" value="<?= Security::cleanHtml($post->id); ?>">
      </form>
    </div>
  </div>
<?php endforeach; ?>