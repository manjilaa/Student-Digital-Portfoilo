<?php /* Reflections view */ ?>
<h1 class="page-title">Reflections</h1>
<p class="muted">Write about what you did, what you learned, and what you will do next.</p>

<?php foreach ($errors['reflections'] as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>

<h2>New reflection</h2>
<form method="post" action="dashboard.php" class="form-box">
  <input type="hidden" name="action" value="add_reflection">
  <label>Title (e.g. "Group project in Semester 5")</label>
  <input type="text" name="title" required>
  <label>Your reflection</label>
  <textarea name="content" rows="6" required></textarea>
  <button type="submit">Save reflection</button>
</form>

<h2>Your reflections</h2>
<?php if (!$reflections): ?><p class="muted">No reflections yet.</p><?php endif; ?>
<?php foreach ($reflections as $r): ?>
  <div class="entry">
    <strong><?= e($r['title']) ?></strong>
    <small> - <?= e(date('d M Y', strtotime($r['created_at']))) ?></small>
    <p><?= nl2br(e($r['content'])) ?></p>
    <form method="post" action="dashboard.php" class="inline" onsubmit="return confirm('Delete this reflection?');">
      <input type="hidden" name="action" value="delete_reflection">
      <input type="hidden" name="reflection_id" value="<?= (int)$r['id'] ?>">
      <button type="submit" class="link-btn">Delete</button>
    </form>
  </div>
<?php endforeach; ?>
