<?php /* Share Portfolio view */ ?>
<h1 class="page-title">Share Portfolio</h1>
<p class="muted">Create a link that an employer can open to see your skills, evidence, certificates and score. The link is view-only and needs no login. Your reflections are never shown.</p>

<?php if ($flash && $flash_view === 'share'): ?><p class="success"><?= e($flash) ?></p><?php endif; ?>

<?php if ($share): ?>
  <h2>Your share link</h2>
  <input type="text" id="share-url" value="<?= e(share_url($share['token'])) ?>" readonly onclick="this.select()">
  <p>
    <button type="button" class="btn-small" onclick="var i=document.getElementById('share-url');i.select();document.execCommand('copy');this.textContent='Copied!';">Copy link</button>
    <a href="<?= e(share_url($share['token'])) ?>" target="_blank" class="btn-small-link">Open</a>
  </p>
  <div class="inline-forms">
    <form method="post" action="dashboard.php" class="inline" onsubmit="return confirm('Make a new link? The old link will stop working.');">
      <input type="hidden" name="action" value="create_share">
      <button type="submit" class="btn-outline">Make a new link</button>
    </form>
    <form method="post" action="dashboard.php" class="inline" onsubmit="return confirm('Disable the link? Nobody will be able to open it.');">
      <input type="hidden" name="action" value="disable_share">
      <button type="submit" class="btn-outline danger">Disable link</button>
    </form>
  </div>
<?php else: ?>
  <p>You do not have an active share link.</p>
  <form method="post" action="dashboard.php">
    <input type="hidden" name="action" value="create_share">
    <button type="submit" class="btn-small">Create share link</button>
  </form>
<?php endif; ?>

<p><a href="portfolio.php">Preview what employers will see</a></p>
