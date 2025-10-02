<?php
require __DIR__ . '/includes/db_connect.inc';
include __DIR__ . '/includes/header.inc';
?>
<div class="container py-3">
  <h1 class="mb-4">Skill Gallery</h1>
  <div class="row g-3">
    <?php
    $sql = "SELECT id, title, image_filename FROM skills ORDER BY title ASC";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = (int)$row['id'];
        $title = htmlspecialchars($row['title']);
        $img = !empty($row['image_filename']) ? 'assets/images/skills/' . htmlspecialchars($row['image_filename']) : 'assets/images/banner.jpg';
        echo '<div class="col-6 col-md-4 col-lg-3">';
        echo '  <a href="details.php?id='.$id.'" class="text-decoration-none d-block">';
        echo '    <img src="'.$img.'" data-full="'.$img.'" class="img-fluid rounded-4 shadow-sm gallery-img" alt="'.$title.'">';
        echo '    <small class="d-block mt-1 text-muted">'.$title.'</small>';
        echo '  </a>';
        echo '</div>';
      }
      mysqli_stmt_close($stmt);
    }
    ?>
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
