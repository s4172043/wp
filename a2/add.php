<?php
require __DIR__ . '/includes/db_connect.inc';
include __DIR__ . '/includes/header.inc';
?>
<div class="container py-3">
  <h1 class="mb-4">Add New Skill</h1>
  <form class="needs-validation" novalidate method="post" action="process_add.php" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" id="title" name="title" class="form-control" placeholder="Enter skill title" required>
      <div class="invalid-feedback">Please enter a title.</div>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter description" required></textarea>
      <div class="invalid-feedback">Please enter a description.</div>
    </div>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="category" class="form-label">Category</label>
        <input type="text" id="category" name="category" class="form-control" placeholder="Enter skill category" required>
        <div class="invalid-feedback">Please enter a category.</div>
      </div>
      <div class="col-md-4">
        <label for="rate" class="form-label">Rate per hour ($)</label>
        <input type="number" step="0.01" min="0" id="rate" name="rate" class="form-control" placeholder="Enter rate" required>
        <div class="invalid-feedback">Please enter a valid rate.</div>
      </div>
      <div class="col-md-4">
        <label for="level" class="form-label">Level</label>
        <select id="level" name="level" class="form-select" required>
          <option value="">Please select</option>
          <option>Beginner</option>
          <option>Intermediate</option>
          <option>Expert</option>
        </select>
        <div class="invalid-feedback">Please select a level.</div>
      </div>
    </div>
    <div class="mt-3">
      <label for="image" class="form-label">Skill image</label>
      <input class="form-control" type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.webp" required>
      <div id="image-feedback" class="invalid-feedback">Please choose a valid image (jpg, jpeg, png, gif, webp).</div>
    </div>
    <div class="mt-4">
      <button class="btn btn-gradient" type="submit">Submit</button>
    </div>
  </form>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
