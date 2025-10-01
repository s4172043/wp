<?php include __DIR__ . '/includes/header.inc'; ?>
<div class="container py-4">
  <div id="heroCarousel" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel" aria-label="Homepage highlights">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner rounded-4 shadow-sm">
      <?php
        $carousel = [
          ['file' => 'carousel1.jpg', 'alt' => 'Guitar lessons'],
          ['file' => 'carousel2.jpg', 'alt' => 'Baking bread'],
          ['file' => 'carousel3.jpg', 'alt' => 'Painting workshop'],
          ['file' => 'carousel4.jpg', 'alt' => 'Yoga practice'],
        ];
        foreach ($carousel as $i => $c): ?>
          <div class="carousel-item <?php echo $i===0 ? 'active' : ''; ?>" data-bs-interval="5000">
            <img src="assets/images/<?php echo $c['file']; ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($c['alt']); ?>">
            <div class="carousel-caption d-none d-md-block">
              <h2 class="h4">SkillSwap</h2>
              <p>Learn • Teach • Share</p>
            </div>
          </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
  </div>

  <h2 class="mb-4">Latest skills</h2>
  <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-4">
    <?php
      require __DIR__ . '/includes/db_connect.inc';
      $sql = "SELECT id, title, category, level, rate, image_filename
              FROM skills
              ORDER BY created_at DESC
              LIMIT 4";
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()):
          $img = 'assets/images/skills/' . htmlspecialchars($row['image_filename']);
    ?>
      <div class="col">
        <article class="card h-100 shadow-sm">
          <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>">
          <div class="card-body">
            <h3 class="card-title h6 mb-1">
              <a class="stretched-link" href="details.php?id=<?php echo (int)$row['id']; ?>">
                <?php echo htmlspecialchars($row['title']); ?>
              </a>
            </h3>
            <p class="mb-1 text-muted small"><?php echo htmlspecialchars($row['category']); ?> • <?php echo htmlspecialchars($row['level']); ?></p>
            <p class="mb-0"><span class="badge text-bg-brand">$<?php echo number_format((float)$row['rate'], 2); ?>/hr</span></p>
          </div>
        </article>
      </div>
    <?php
        endwhile;
      } catch (Exception $e) {
        echo '<p class="text-danger">DB not connected yet or schema mismatch. Complete DB setup.</p>';
      }
    ?>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
