<?php include __DIR__ . '/includes/header.inc'; ?>
<div class="container py-5">
  <h1 class="mb-4">Skill Gallery</h1>
  <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-4">
    <?php
      require __DIR__ . '/includes/db_connect.inc';
      $sql = "SELECT id, title, image_filename FROM skills ORDER BY created_at DESC";
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()):
    ?>
    <div class="col">
      <a href="details.php?id=<?php echo (int)$row['id']; ?>" class="d-block text-decoration-none text-center">
        <img src="<?php echo 'assets/images/skills/' . htmlspecialchars($row['image_filename']); ?>"
             data-full="<?php echo 'assets/images/skills/' . htmlspecialchars($row['image_filename']); ?>"
             class="img-fluid rounded-3 shadow-sm gallery-img" alt="<?php echo htmlspecialchars($row['title']); ?>">
        <div class="small mt-1 text-muted"><?php echo htmlspecialchars($row['title']); ?></div>
      </a>
    </div>
    <?php
        endwhile;
      } catch (Exception $e) {
        echo '<p class="text-danger">DB not connected yet or schema mismatch.</p>';
      }
    ?>
  </div>

  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true" aria-labelledby="imageModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4">
        <div class="modal-header">
          <h2 id="imageModalLabel" class="modal-title h5">Image preview</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="modalImage" class="img-fluid rounded-3" src="" alt="Selected skill image">
          <p id="modalCaption" class="mt-2 text-muted small"></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
