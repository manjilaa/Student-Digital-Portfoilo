<?php
require 'config.php';
require_login();   // anyone not logged in is sent to login.php

$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Digital Student Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h1>Welcome, <?= e($_SESSION['name']) ?></h1>
    <p>You are logged in as: <strong><?= e($role) ?></strong></p>

    <?php if ($role === 'student'): ?>
      <p>Student dashboard: skills, certificates and timeline will appear here.</p>
    <?php elseif ($role === 'mentor'): ?>
      <p>Mentor dashboard: your assigned students will appear here.</p>
    <?php elseif ($role === 'admin'): ?>
      <p>Admin dashboard: all portfolios will appear here.</p>
    <?php else: ?>
      <p>Employer: you will view shared portfolios here.</p>
    <?php endif; ?>

    <p><a href="logout.php">Log out</a></p>
  </div>
</body>
</html>
