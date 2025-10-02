<?php
require __DIR__ . '/includes/db_connect.inc';
include __DIR__ . '/includes/header.inc';
?>
<div class="container py-3">

  <div id="heroCarousel" class="carousel slide hero-carousel mb-4" data-bs-ride="carousel" aria-label="Featured skills">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner rounded-4 overflow-hidden shadow-sm">
      <div class="carousel-item active">
        <img src="assets/images/carousel1.jpg" class="d-block w-100" alt="Guitar lessons banner">
      </div>
      <div class="carousel-item">
        <img src="assets/images/carousel2.jpg" class="d-block w-100" alt="Playing guitar close-up">
      </div>
      <div class="carousel-item">
        <img src="assets/images/carousel3.jpg" class="d-block w-100" alt="Fresh bread illustration">
      </div>
      <div class="carousel-item">
        <img src="assets/images/carousel4.jpg" class="d-block w-100" alt="Cupcake piping illustration">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous slide">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next slide">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
  </div>

  <h2 class="mb-3">Latest skills</h2>
  <div class="row g-3">
    <?php
    $sql = "SELECT id, title, category, rate_per_hour, image_filename FROM skills ORDER BY created_at DESC LIMIT 4";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = (int)$row['id'];
        $title = htmlspecialchars($row['title']);
        $cat = htmlspecialchars($row['category']);
        $rate = number_format((float)$row['rate_per_hour'], 2);
        $img = !empty($row['image_filename']) ? 'assets/images/skills/' . htmlspecialchars($row['image_filename']) : 'assets/images/banner.jpg';
        echo '<div class="col-12 col-md-6 col-lg-3">';
        echo '  <div class="card h-100 shadow-sm">';
        echo '    <img src="'.$img.'" class="card-img-top gallery-img" data-full="'.$img.'" alt="'.$title.'">';
        echo '    <div class="card-body">';
        echo '      <h5 class="card-title">'.$title.'</h5>';
        echo '      <p class="card-text small text-muted">'.$cat.'</p>';
        echo '      <p class="mb-2"><span class="badge text-bg-brand">$'.$rate.'/hr</span></p>';
        echo '      <a class="btn btn-outline-brand btn-sm" href="details.php?id='.$id.'">View details</a>';
        echo '    </div>';
        echo '  </div>';
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
