<?php include __DIR__ . '/includes/header.inc'; ?>
<div class="container py-5">
  <h1 class="mb-4">All Skills</h1>
  <div class="row g-4 align-items-start">
    <div class="col-md-5">
      <img src="assets/images/banner.jpg" alt="SkillSwap banner" class="img-fluid rounded-4 shadow-sm">
    </div>
    <div class="col-md-7">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-brand text-white">
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Level</th>
              <th scope="col">Rate/hr</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require __DIR__ . '/includes/db_connect.inc';
              $sql = "SELECT id, title, category, level, rate FROM skills ORDER BY title ASC";
              try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($row = $res->fetch_assoc()):
            ?>
              <tr>
                <th scope="row">
                  <a class="link-brand" href="details.php?id=<?php echo (int)$row['id']; ?>">
                    <?php echo htmlspecialchars($row['title']); ?>
                  </a>
                </th>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['level']); ?></td>
                <td>$<?php echo number_format((float)$row['rate'], 2); ?></td>
              </tr>
            <?php
                endwhile;
              } catch (Exception $e) {
                echo '<tr><td colspan="4" class="text-danger">DB not connected yet or schema mismatch.</td></tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
