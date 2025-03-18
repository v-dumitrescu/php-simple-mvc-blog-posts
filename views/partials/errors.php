<?php if (isset($errors)): ?>
  <?php foreach ($errors as $error): ?>
    <div class="alert alert-danger"><?= $error; ?></div>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($imageError)): ?>
  <div class="alert alert-danger"><?= $imageError; ?></div>
<?php endif; ?>