<?php /* Timeline view */
$labels = [
    'skill' => 'Skill', 'evidence' => 'Evidence', 'certificate' => 'Certificate',
    'reflection' => 'Reflection', 'feedback' => 'Feedback', 'verification' => 'Verification',
];
?>
<h1 class="page-title">Timeline</h1>
<p class="muted">Everything you add to your portfolio appears here automatically.</p>

<?php if (!$events): ?>
  <p class="muted">Nothing here yet. Add a skill, certificate or reflection to start your timeline.</p>
<?php endif; ?>

<?php foreach ($by_month as $month => $list): ?>
  <h3 class="section-title"><?= e($month) ?> <small>(<?= count($list) ?> activities)</small></h3>
  <ul class="timeline">
    <?php foreach ($list as $ev): ?>
      <li>
        <span class="badge type-<?= e($ev['event_type']) ?>"><?= e($labels[$ev['event_type']] ?? $ev['event_type']) ?></span>
        <?= e($ev['description']) ?>
        <small>- <?= e(date('d M, H:i', strtotime($ev['created_at']))) ?></small>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endforeach; ?>
