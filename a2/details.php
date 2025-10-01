<?php include __DIR__ . '/includes/header.inc'; ?>
<div class="container py-5">
  <?php
    require __DIR__ . '/includes/db_connect.inc';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $sql = "SELECT id, title, category, level, rate, description, image_filename
            FROM skills WHERE id = ?";
    try {
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $row = $stmt->get_result()->fetch_assoc();
      if (!$row) { echo '<p class="text-danger">Skill not found.</p>'; }
    } catch (Exception $e) {
      $row = null;
      echo '<p class="text-danger">DB not connected yet or schema mismatch.</p>';
    }
  ?>
  <?php if ($row): ?>
    <h1 class="mb-4"><?php echo htmlspecialchars($row['title']); ?></h1>
    <div class="row g-4">
      <div class="col-sm-4">
        <img id="detailThumb" src="<?php echo 'assets/images/skills/' . htmlspecialchars($row['image_filename']); ?>"
             alt="<?php echo htmlspecialchars($row['title']); ?>"
             class="img-fluid rounded-3 shadow-sm gallery-thumb" role="button" data-bs-toggle="modal" data-bs-target="#imageModal">
      </div>
      <div class="col-sm-8">
        <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        <p class="mb-1"><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
        <p class="mb-1"><strong>Level:</strong> <?php echo htmlspecialchars($row['level']); ?></p>
        <p class="mb-1"><strong>Rate:</strong> $<?php echo number_format((float)$row['rate'], 2); ?>/hr</p>
      </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true" aria-labelledby="imageModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4">
          <div class="modal-header">
            <h2 id="imageModalLabel" class="modal-title h5"><?php echo htmlspecialchars($row['title']); ?></h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img id="modalImage" class="img-fluid rounded-3" src="<?php echo 'assets/images/skills/' . htmlspecialchars($row['image_filename']); ?>" alt="Selected skill image">
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
