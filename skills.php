<?php /* My Skills view */ ?>
<h1 class="page-title">My Skills</h1>

<?php foreach ($errors['skills'] as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>

<?php if ($edit_skill): ?>
  <h2>Edit skill</h2>
  <form method="post" action="dashboard.php" class="form-box">
    <input type="hidden" name="action" value="edit_skill">
    <input type="hidden" name="skill_id" value="<?= (int)$edit_skill['id'] ?>">
    <label>Skill name</label>
    <input type="text" name="name" value="<?= e($edit_skill['name']) ?>" required>
    <label>Level</label>
    <select name="level">
      <?php foreach ($levels as $lv): ?>
        <option value="<?= $lv ?>" <?= $edit_skill['level'] === $lv ? 'selected' : '' ?>><?= ucfirst($lv) ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Save changes</button>
    <a class="cancel" href="dashboard.php#skills">Cancel</a>
  </form>
<?php else: ?>
  <h2>Add a skill</h2>
  <form method="post" action="dashboard.php" class="form-box">
    <input type="hidden" name="action" value="add_skill">
    <label>Skill name (e.g. PHP, Teamwork, Public Speaking)</label>
    <input type="text" name="name" required>
    <label>Level</label>
    <select name="level">
      <option value="beginner">Beginner</option>
      <option value="intermediate">Intermediate</option>
      <option value="advanced">Advanced</option>
    </select>
    <button type="submit">Add skill</button>
  </form>
<?php endif; ?>

<h2>Your skills</h2>
<?php if (!$skills): ?>
  <p class="muted">You have not added any skills yet.</p>
<?php else: ?>
  <div class="table-wrap">
  <table>
    <tr><th>Skill</th><th>Level</th><th>Evidence</th><th>Status</th><th>Actions</th></tr>
    <?php foreach ($skills as $s): ?>
    <tr>
      <td><?= e($s['name']) ?></td>
      <td><?= e(ucfirst($s['level'])) ?></td>
      <td><?= (int)$s['evidence_count'] ?> item(s)</td>
      <td><?= $s['verified'] ? '<span class="badge ok">Verified</span>' : '<span class="badge">Not verified</span>' ?></td>
      <td>
        <a href="dashboard.php?edit=<?= (int)$s['id'] ?>#skills">Edit</a> |
        <form method="post" action="dashboard.php" class="inline" onsubmit="return confirm('Delete this skill and its evidence?');">
          <input type="hidden" name="action" value="delete_skill">
          <input type="hidden" name="skill_id" value="<?= (int)$s['id'] ?>">
          <button type="submit" class="link-btn">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  </div>
<?php endif; ?>
