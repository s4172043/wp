<?php
require __DIR__ . '/includes/db_connect.inc';
if (session_status()===PHP_SESSION_NONE) { session_start(); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: add.php'); exit; }

function clean($s){ return trim($s ?? ''); }
$title = clean($_POST['title'] ?? '');
$description = clean($_POST['description'] ?? '');
$category = clean($_POST['category'] ?? '');
$rate = isset($_POST['rate']) ? floatval($_POST['rate']) : 0.0;
$level = clean($_POST['level'] ?? '');

$errors = [];
if ($title === '') $errors[] = 'Title is required';
if ($description === '') $errors[] = 'Description is required';
if ($category === '') $errors[] = 'Category is required';
if ($rate <= 0) $errors[] = 'Rate must be a positive number';
$allowedLevels = ['Beginner','Intermediate','Expert'];
if (!in_array($level, $allowedLevels, true)) $errors[] = 'Invalid level';

$uploadDir = __DIR__ . '/assets/images/skills/';
if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0777, true); }

$imageFilename = '';
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
  $errors[] = 'Image is required';
} else {
  $fileInfo = $_FILES['image'];
  $originalName = $fileInfo['name'];
  $tmp = $fileInfo['tmp_name'];
  $size = (int)$fileInfo['size'];

  $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
  $allowedExt = ['jpg','jpeg','png','gif','webp'];
  if (!in_array($ext, $allowedExt, true)) { $errors[] = 'Invalid image type.'; }

  $finfo = @finfo_open(FILEINFO_MIME_TYPE);
  $mime = $finfo ? finfo_file($finfo, $tmp) : '';
  if ($finfo) finfo_close($finfo);
  $allowedMime = ['image/jpeg','image/png','image/gif','image/webp'];
  if (!in_array($mime, $allowedMime, true)) { $errors[] = 'Invalid image content'; }

  if ($size > 5 * 1024 * 1024) { $errors[] = 'Image too large'; }

  if (!$errors) {
    $random = bin2hex(random_bytes(8));
    $safeTitle = preg_replace('/[^a-z0-9]+/i','-', strtolower($title));
    $imageFilename = $safeTitle . '-' . $random . '.' . $ext;
    $dest = $uploadDir . $imageFilename;
    if (!move_uploaded_file($tmp, $dest)) { $errors[] = 'Failed to move uploaded file'; }
    else { @chmod($dest, 0666); }
  }
}

if ($errors) {
  $_SESSION['flash'] = implode('. ', $errors);
  header('Location: add.php'); exit;
}

$sql = "INSERT INTO skills (title, description, category, level, rate_per_hour, image_filename, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";
if ($stmt = mysqli_prepare($conn, $sql)) {
  mysqli_stmt_bind_param($stmt, "ssssds", $title, $description, $category, $level, $rate, $imageFilename);
  if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash'] = 'Skill added successfully!';
    header('Location: index.php'); exit;
  } else {
    $_SESSION['flash'] = 'Database error: could not insert record';
  }
  mysqli_stmt_close($stmt);
} else {
  $_SESSION['flash'] = 'Database error: could not prepare statement';
}
header('Location: add.php'); exit;
