<?php
require __DIR__ . '/includes/db_connect.inc';
include __DIR__ . '/includes/header.inc';
?>
<div class="container py-3">
  <h1 class="mb-4">All Skills</h1>
  <div class="row g-4 align-items-start">
    <div class="col-12 col-lg-4">
      <img src="assets/images/banner.jpg" alt="Skills banner" class="img-fluid rounded-4 shadow-sm">
    </div>
    <div class="col-12 col-lg-8">
      <div class="table-responsive">
        <table class="table table-striped align-middle table-brand">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Level</th>
              <th scope="col">Rate ($/hr)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT id, title, category, level, rate_per_hour FROM skills ORDER BY title ASC";
            if ($stmt = mysqli_prepare($conn, $sql)) {
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              while ($row = mysqli_fetch_assoc($result)) {
                $id = (int)$row['id'];
                $t = htmlspecialchars($row['title']);
                $c = htmlspecialchars($row['category']);
                $l = htmlspecialchars($row['level']);
                $r = number_format((float)$row['rate_per_hour'], 2);
                echo '<tr>';
                echo '  <td><a class="link-brand" href="details.php?id='.$id.'">'.$t.'</a></td>';
                echo '  <td>'.$c.'</td>';
                echo '  <td>'.$l.'</td>';
                echo '  <td class="text-nowrap">$'.$r.'</td>';
                echo '</tr>';
              }
              mysqli_stmt_close($stmt);
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.inc'; ?>
