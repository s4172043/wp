<?php include __DIR__ . '/includes/header.inc'; ?>
<div class="container py-5">
  <h1 class="mb-4">Add New Skill</h1>
  <p class="text-muted">All fields are required.</p>
  <form id="add-skill-form" class="needs-validation" novalidate action="process_add.php" method="post" enctype="multipart/form-data">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
        <div class="invalid-feedback">Please provide a title.</div>
      </div>
      <div class="col-md-6">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" name="category" required>
        <div class="invalid-feedback">Please provide a category.</div>
      </div>
      <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        <div class="invalid-feedback">Please provide a description.</div>
      </div>
      <div class="col-md-4">
        <label for="rate" class="form-label">Rate per hour (AUD)</label>
        <input type="number" min="1" step="0.5" class="form-control" id="rate" name="rate" required>
        <div class="invalid-feedback">Please provide a valid hourly rate.</div>
      </div>
      <div class="col-md-4">
        <label for="level" class="form-label">Level</label>
        <select class="form-select" id="level" name="level" required>
          <option value="" selected>Please select</option>
          <option>Beginner</option>
          <option>Intermediate</option>
          <option>Advanced</option>
        </select>
        <div class="invalid-feedback">Please choose a level.</div>
      </div>
      <div class="col-md-8">
        <label for="image" class="form-label">Image (jpg, jpeg, png, gif, webp)</label>
        <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.webp" required>
        <div id="image-feedback" class="invalid-feedback">Please upload a valid image file.</div>
      </div>
      <div class="col-12 pt-3">
        <button class="btn btn-gradient px-4" type="submit">Submit</button>
        <button class="btn btn-outline-brand ms-2" type="reset">Reset</button>
      </div>
    </div>
  </form>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
