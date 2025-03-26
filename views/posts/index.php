<?php

use app\helpers\Security;
use app\helpers\Url;

if (!empty($posts)):
  foreach ($posts as $post): ?>

    <div class="card mb-2 w-50 mx-auto">
      <a href="/post/read?id=<?= Security::cleanHtml($post->id); ?>">
        <?= Url::loadImage($post->image); ?>
      </a>
      <div class="card-body">
        <h5 class="card-title text-center">
          <a class="link-underline link-underline-opacity-0" href="/post/read?id=<?= Security::cleanHtml($post->id); ?>"><?= Security::cleanHtml($post->title); ?></a>
        </h5>
        <small class="card-subtitle mb-2 text-body-secondary">At <?= Security::cleanHtml(date('d/M/Y H:i:s', strtotime($post->created_at))); ?></small>
        <h6 class="card-subtitle mb-2 text-body-secondary">Written by <?= Security::cleanHtml($post->author); ?></h6>
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <h1>No Posts</h1>
<?php endif; ?>