<?php use app\helpers\Url; ?>
<?php use app\helpers\Security; ?>

<h1>Update Post</h1>

<form method="POST" action="/posts/update" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= Security::cleanHtml($post->title); ?>">
  </div>

  <div class="mb-3">
    <label for="author" class="form-label">Author</label>
    <input type="text" class="form-control" id="author" name="author" value="<?= Security::cleanHtml($post->author); ?>">
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image">
  </div>

  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea type="text" class="form-control" id="content" name="content" rows="5"><?= Security::cleanHtml($post->body); ?></textarea>
  </div>

  <input type="hidden" name="id" value="<?= Security::cleanHtml($post->id); ?>">
  <button type="submit" class="btn btn-primary">Update</button>
</form>