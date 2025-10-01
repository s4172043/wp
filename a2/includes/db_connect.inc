<?php
/* mysqli connection for localhost (XAMPP) and Jacob5 (RMIT) */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$is_local = in_array($_SERVER['SERVER_NAME'] ?? 'localhost', ['localhost','127.0.0.1']) || php_sapi_name()==='cli';

if ($is_local) {
  $db_host = 'localhost';
  $db_user = 'root';
  $db_pass = '';
  $db_name = 'skillswap'; // change if your local DB name differs
} else {
  $db_host = 'talsprddb02.int.its.rmit.edu.au';
  $db_user = 's4172043';
  $db_pass = 'Luffy3D2Y!';
  $db_name = 's4172043';
}

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
$conn->set_charset('utf8mb4');
?>