<?php /* Evidence view */ ?>
<h1 class="page-title">Evidence</h1>
<p class="muted">Proof of your skills: a file or a link. Each skill needs at least one evidence item to count toward your score.</p>

<?php foreach ($errors['evidence'] as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>

<h2>Add evidence</h2>
<?php if (!$skills): ?>
  <p class="muted">Add a skill first in <a href="#skills">My Skills</a>, then come back to attach evidence.</p>
<?php else: ?>
  <form method="post" action="dashboard.php" enctype="multipart/form-data" class="form-box">
    <input type="hidden" name="action" value="add_evidence">
    <label>For which skill?</label>
    <select name="skill_id" required>
      <?php foreach ($skills as $s): ?>
        <option value="<?= (int)$s['id'] ?>"><?= e($s['name']) ?></option>
      <?php endforeach; ?>
    </select>
    <label>Title (e.g. "Final project website")</label>
    <input type="text" name="title" required>
    <label>Description (optional)</label>
    <input type="text" name="description">
    <label>Link (optional, e.g. GitHub or Google Drive)</label>
    <input type="text" name="link_url" placeholder="https://...">
    <label>Or upload a file (pdf, jpg, png, doc, docx - max 5 MB)</label>
    <input type="file" name="file">
    <button type="submit">Add evidence</button>
  </form>
<?php endif; ?>

<h2>Your evidence</h2>
<?php if (!$all_evidence): ?>
  <p class="muted">No evidence added yet.</p>
<?php else: ?>
  <div class="table-wrap">
  <table>
    <tr><th>Title</th><th>Skill</th><th>Proof</th><th>Added</th><th></th></tr>
    <?php foreach ($all_evidence as $it): ?>
    <tr>
      <td><?= e($it['title']) ?><br><small><?= e($it['description']) ?></small></td>
      <td><?= e($it['skill_name']) ?></td>
      <td>
        <?php if ($it['file_path']): ?><a href="uploads/<?= e($it['file_path']) ?>" target="_blank">View file</a><br><?php endif; ?>
        <?php if ($it['link_url']): ?><a href="<?= e($it['link_url']) ?>" target="_blank" rel="noopener">Open link</a><?php endif; ?>
      </td>
      <td><?= e(date('d M Y', strtotime($it['created_at']))) ?></td>
      <td>
        <form method="post" action="dashboard.php" class="inline" onsubmit="return confirm('Delete this evidence?');">
          <input type="hidden" name="action" value="delete_evidence">
          <input type="hidden" name="evidence_id" value="<?= (int)$it['id'] ?>">
          <button type="submit" class="link-btn">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  </div>
<?php endif; ?>
