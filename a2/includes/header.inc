<?php if (session_status()===PHP_SESSION_NONE) { session_start(); } ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkillSwap</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ysabeau+SC:wght@400;600&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <link rel="icon" href="assets/images/favicon.ico">
</head>
<body class="d-flex flex-column min-vh-100">
<header>
  <?php include __DIR__ . '/nav.inc'; ?>
</header>
<main id="top" class="flex-grow-1">
  <div class="container pt-3">
    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
  </div>
