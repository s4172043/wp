<?php
require __DIR__ . '/includes/db_connect.inc';
include __DIR__ . '/includes/header.inc';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$title = $category = $description = $level = '';
$rate = 0.00;
$image = 'assets/images/banner.jpg';

$sql = "SELECT title, category, description, level, rate_per_hour, image_filename FROM skills WHERE id = ? LIMIT 1";
if ($stmt = mysqli_prepare($conn, $sql)) {
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($result)) {
    $title = htmlspecialchars($row['title']);
    $category = htmlspecialchars($row['category']);
    $description = htmlspecialchars($row['description']);
    $level = htmlspecialchars($row['level']);
    $rate = number_format((float)$row['rate_per_hour'], 2);
    if (!empty($row['image_filename'])) {
      $image = 'assets/images/skills/' . htmlspecialchars($row['image_filename']);
    }
  }
  mysqli_stmt_close($stmt);
}
?>
<div class="container py-3">
  <h1 class="mb-4"><?php echo $title ?: 'Skill not found'; ?></h1>
  <div class="row g-4">
    <div class="col-12 col-md-4">
      <img id="detailThumb" src="<?php echo $image; ?>" data-full="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-fluid rounded-4 shadow-sm">
    </div>
    <div class="col-12 col-md-8">
      <p><?php echo $description; ?></p>
      <p><strong>Category:</strong> <?php echo $category; ?></p>
      <p><strong>Level:</strong> <?php echo $level; ?></p>
      <p><strong>Rate:</strong> $<?php echo $rate; ?>/hr</p>
    </div>
  </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="modalCaption" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded-4" alt="">
        <p id="modalCaption" class="mt-2 small text-muted"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-brand" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.inc'; ?>
