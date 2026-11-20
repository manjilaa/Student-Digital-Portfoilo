<?php /* My Scores view */ ?>
<h1 class="page-title">My Scores</h1>
<p class="muted">Your portfolio-readiness score, out of 50.</p>

<div class="progress-card">
  <div class="percent"><?= (int)$score['total'] ?> <span class="of">/ 50</span></div>
  <div class="meter"><div class="meter-fill" style="width: <?= (int)$score['percent'] ?>%"></div></div>
</div>

<h2>How your score is made</h2>
<div class="table-wrap">
<table>
  <tr><th>Component</th><th>Your points</th><th>Maximum</th><th>Rule</th></tr>
  <tr><td>Skills with evidence</td><td><?= $score['skills'] ?></td><td>10</td><td>Share of your skills that have at least one evidence item</td></tr>
  <tr><td>Mentor-verified items</td><td><?= $score['verified'] ?></td><td>20</td><td>Share of your skills and certificates verified by your mentor</td></tr>
  <tr><td>Mentor feedback</td><td><?= $score['feedback'] ?></td><td>10</td><td>At least one feedback comment from your mentor</td></tr>
  <tr><td>Recent activity</td><td><?= $score['activity'] ?></td><td>10</td><td>2 points for each timeline activity in the last 30 days (up to 10)</td></tr>
  <tr><th>Total</th><th><?= $score['total'] ?></th><th>50</th><th></th></tr>
</table>
</div>

<h2>How to improve</h2>
<?php if (!$score['tips']): ?>
  <p class="muted">Great work! Nothing to improve right now.</p>
<?php else: ?>
  <ul class="tips">
    <?php foreach ($score['tips'] as $t): ?><li><?= e($t) ?></li><?php endforeach; ?>
  </ul>
<?php endif; ?>

<h2>Score history</h2>
<?php if (!$score_history): ?>
  <p class="muted">No history yet.</p>
<?php else: ?>
  <div class="table-wrap">
  <table>
    <tr><th>Date</th><th>Score</th></tr>
    <?php foreach ($score_history as $h): ?>
      <tr><td><?= e(date('d M Y, H:i', strtotime($h['calculated_at']))) ?></td><td><?= (int)$h['total'] ?> / 50</td></tr>
    <?php endforeach; ?>
  </table>
  </div>
<?php endif; ?>
