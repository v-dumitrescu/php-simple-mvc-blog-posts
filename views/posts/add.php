<h1>Create Post</h1>

<form method="POST" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>

  <div class="mb-3">
    <label for="author" class="form-label">Author</label>
    <input type="text" class="form-control" id="author" name="author">
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image">
  </div>

  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea type="text" class="form-control" id="content" name="content" rows="5"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>