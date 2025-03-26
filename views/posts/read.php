<?php

use app\helpers\Security;
use app\helpers\Url;

?>

<div class="mb-2 w-50 mx-auto">
  <?= Url::loadImage($post->image); ?>
  <div>
    <h5 class="mt-3 text-center"><?= Security::cleanHtml($post->title); ?></h5>
    <small class="mb-2 text-body-secondary">At <?= Security::cleanHtml(date('d/M/Y H:i:s', strtotime($post->created_at))); ?></small>
    <h6 class="mb-2 text-body-secondary">Written by <?= Security::cleanHtml($post->author); ?></h6>
    <p><?= Security::cleanHtml($post->body); ?></p>
    <a class="btn btn-info text-white" href="/posts/update?id=<?= Security::cleanHtml($post->id); ?>">Edit</a>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= Security::cleanHtml($post->id); ?>">
      Delete
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal-<?= Security::cleanHtml($post->id); ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            Are you sure you want to delete this post?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="/posts/delete" method="POST">
              <button type="submit" class="btn btn-danger">Delete Post</button>
              <input type="hidden" name="id" value="<?= Security::cleanHtml($post->id); ?>">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>