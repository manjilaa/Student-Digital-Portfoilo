<?php /* Feedback view (written by mentors; students only read it) */ ?>
<h1 class="page-title">Feedback</h1>
<p class="muted">Comments from your mentor about your portfolio.</p>

<?php if (!$feedback_list): ?>
  <p class="muted">No feedback yet.
    <?php if (!$me['mentor_id']): ?>Choose a mentor in <a href="#profile">My Profile</a> to receive feedback.<?php endif; ?>
  </p>
<?php endif; ?>
<?php foreach ($feedback_list as $f): ?>
  <div class="entry">
    <strong><?= e($f['mentor_name']) ?></strong>
    <small> - <?= e(date('d M Y', strtotime($f['created_at']))) ?></small>
    <p><?= nl2br(e($f['comment'])) ?></p>
  </div>
<?php endforeach; ?>
