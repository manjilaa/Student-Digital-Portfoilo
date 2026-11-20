<?php /* Certificates view */ ?>
<h1 class="page-title">Certificates</h1>

<?php foreach ($errors['certificates'] as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>

<h2>Add a certificate</h2>
<form method="post" action="dashboard.php" enctype="multipart/form-data" class="form-box">
  <input type="hidden" name="action" value="add_certificate">
  <label>Certificate title</label>
  <input type="text" name="title" required>
  <label>Issued by (organization)</label>
  <input type="text" name="issuer">
  <label>Date issued</label>
  <input type="date" name="issue_date">
  <label>Certificate file (pdf, jpg, png - max 5 MB)</label>
  <input type="file" name="file" required>
  <button type="submit">Add certificate</button>
</form>

<h2>Your certificates</h2>
<?php if (!$certs): ?>
  <p class="muted">You have not added any certificates yet.</p>
<?php else: ?>
  <div class="table-wrap">
  <table>
    <tr><th>Title</th><th>Issuer</th><th>Date</th><th>File</th><th>Status</th><th></th></tr>
    <?php foreach ($certs as $c): ?>
    <tr>
      <td><?= e($c['title']) ?></td>
      <td><?= e($c['issuer']) ?></td>
      <td><?= $c['issue_date'] ? e(date('d M Y', strtotime($c['issue_date']))) : '-' ?></td>
      <td><a href="uploads/<?= e($c['file_path']) ?>" target="_blank">View</a></td>
      <td><?= $c['verified'] ? '<span class="badge ok">Verified</span>' : '<span class="badge">Not verified</span>' ?></td>
      <td>
        <form method="post" action="dashboard.php" class="inline" onsubmit="return confirm('Delete this certificate?');">
          <input type="hidden" name="action" value="delete_certificate">
          <input type="hidden" name="certificate_id" value="<?= (int)$c['id'] ?>">
          <button type="submit" class="link-btn">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  </div>
<?php endif; ?>
