<?php
session_start();
require __DIR__ . '/includes/db_connect.inc';

function bad($msg) {
  $_SESSION['flash'] = $msg;
  header('Location: add.php');
  exit;
}

$title = trim($_POST['title'] ?? '');
$category = trim($_POST['category'] ?? '');
$description = trim($_POST['description'] ?? '');
$rate = trim($_POST['rate'] ?? '');
$level = trim($_POST['level'] ?? '');

if ($title === '' || $category === '' || $description === '' || $rate === '' || $level === '') {
  bad('All fields are required.');
}
if (!is_numeric($rate) || $rate <= 0) {
  bad('Rate must be a positive number.');
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
  bad('Image upload failed.');
}

$allowed_ext = ['jpg','jpeg','png','gif','webp'];
$orig_name = $_FILES['image']['name'];
$tmp_path = $_FILES['image']['tmp_name'];
$size = (int)$_FILES['image']['size'];
$maxSize = 5 * 1024 * 1024;

$ext = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));
if (!in_array($ext, $allowed_ext, true)) {
  bad('Invalid image type. Allowed: jpg, jpeg, png, gif, webp.');
}
if ($size <= 0 || $size > $maxSize) {
  bad('Image too large. Max 5MB.');
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $tmp_path);
finfo_close($finfo);
$allowed_mimes = ['image/jpeg','image/png','image/gif','image/webp'];
if (!in_array($mime, $allowed_mimes, true)) {
  bad('Invalid image mime type.');
}

$safe_base = preg_replace('/[^a-z0-9]+/i', '-', strtolower(pathinfo($orig_name, PATHINFO_FILENAME)));
$unique = $safe_base . '-' . bin2hex(random_bytes(6)) . '.' . $ext;
$dest_dir = __DIR__ . '/assets/images/skills/';
if (!is_dir($dest_dir)) { mkdir($dest_dir, 0777, true); }
$dest_path = $dest_dir . $unique;

if (!move_uploaded_file($tmp_path, $dest_path)) {
  bad('Unable to save the uploaded file.');
}
@chmod($dest_path, 0666);

$sql = "INSERT INTO skills (title, category, level, rate, description, image_filename, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssiss', $title, $category, $level, $rate, $description, $unique);
$stmt->execute();

$_SESSION['flash'] = 'Skill added successfully.';
header('Location: details.php?id=' . $conn->insert_id);
exit;
