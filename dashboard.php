<?php /* Dashboard (home) view */ ?>
<h1 class="page-title">Welcome, <?= e($_SESSION['name']) ?>!</h1>
<p class="muted">Your learning journey in one place.</p>

<div class="stats">
  <a class="stat" href="#skills"><span><?= count($skills) ?></span>Skills</a>
  <a class="stat" href="#certificates"><span><?= count($certs) ?></span>Certificates</a>
  <a class="stat" href="#evidence"><span><?= count($all_evidence) ?></span>Evidence</a>
  <a class="stat" href="#reflections"><span><?= count($reflections) ?></span>Reflections</a>
</div>

<div class="progress-card">
  <h2>Portfolio Progress</h2>
  <div class="percent"><?= (int)$score['percent'] ?>%</div>
  <div class="meter"><div class="meter-fill" style="width: <?= (int)$score['percent'] ?>%"></div></div>
  <p class="muted">
    <?php if ($score['percent'] >= 100): ?>
      Excellent! Your portfolio is fully ready.
    <?php else: ?>
      Complete your profile to improve your portfolio. <a href="#scores">See how</a>
    <?php endif; ?>
  </p>
</div>

<h3 class="section-title">Recent Activities</h3>
<?php if (!$events): ?>
  <p class="muted">Nothing yet. Add your first skill to get started.</p>
<?php else: ?>
  <ul class="recent">
    <?php foreach (array_slice($events, 0, 5) as $ev): ?>
      <li><?= e($ev['description']) ?> <small><?= e(date('d M', strtotime($ev['created_at']))) ?></small></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<a class="btn-primary" href="portfolio.php">View My Portfolio</a>
