<?php
require 'config.php';

$errors = [];
$name = $email = '';
$role = 'student';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    $role  = $_POST['role'] ?? 'student';

    // Admin accounts are never created from this form.
    if (!in_array($role, ['student', 'mentor', 'employer'])) {
        $role = 'student';
    }

    if ($name === '')                              $errors[] = 'Please enter your full name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email.';
    if (strlen($pass) < 8)                         $errors[] = 'Password must be at least 8 characters.';

    if (!$errors) {
        // Is this email already used?
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'That email is already registered.';
        }
    }

    if (!$errors) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);   // secure password storage
        $stmt = $pdo->prepare('INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $email, $hash, $role]);
        header('Location: login.php?registered=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Digital Student Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h1>Create account</h1>

    <?php foreach ($errors as $err): ?>
      <p class="error"><?= e($err) ?></p>
    <?php endforeach; ?>

    <form method="post">
      <label>Full name</label>
      <input type="text" name="full_name" value="<?= e($name) ?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?= e($email) ?>" required>

      <label>Password (min 8 characters)</label>
      <input type="password" name="password" required>

      <label>I am a</label>
      <select name="role">
        <option value="student"  <?= $role === 'student'  ? 'selected' : '' ?>>Student</option>
        <option value="mentor"   <?= $role === 'mentor'   ? 'selected' : '' ?>>Mentor</option>
        <option value="employer" <?= $role === 'employer' ? 'selected' : '' ?>>Employer</option>
      </select>

      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Log in</a></p>
  </div>
</body>
</html>
