<?php /* My Profile view */ ?>
<h1 class="page-title">My Profile</h1>

<?php if ($flash && $flash_view === 'profile'): ?><p class="success"><?= e($flash) ?></p><?php endif; ?>
<?php foreach ($errors['profile'] as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>

<form method="post" action="dashboard.php" class="form-box">
  <input type="hidden" name="action" value="update_profile">
  <label>Full name</label>
  <input type="text" name="full_name" value="<?= e($me['full_name']) ?>" required>

  <label>Email (cannot be changed)</label>
  <input type="text" value="<?= e($me['email']) ?>" disabled>

  <label>My mentor</label>
  <select name="mentor_id">
    <option value="0">- No mentor chosen -</option>
    <?php foreach ($mentors as $m): ?>
      <option value="<?= (int)$m['id'] ?>" <?= (int)$me['mentor_id'] === (int)$m['id'] ? 'selected' : '' ?>><?= e($m['full_name']) ?></option>
    <?php endforeach; ?>
  </select>
  <?php if (!$mentors): ?>
    <p class="muted">No mentors have registered yet. A mentor must create an account first.</p>
  <?php endif; ?>

  <button type="submit">Save profile</button>
</form>
