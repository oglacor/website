<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="blog-post wrap">
  <a href="<?= esc($backUrl) ?>" class="form-note" style="display:inline-block; margin-bottom:20px;">&larr; Back to docs</a>
  <div class="meta"><?= esc(ucfirst($doc['section'])) ?> Docs</div>
  <h1><?= esc($doc['title']) ?></h1>
  <div class="content">
    <?= $doc['body'] /* trusted admin-authored HTML, same pattern as blog posts */ ?>
  </div>
</div>

<dialog class="shot-viewer" id="shot-viewer" aria-label="Screenshot, full size">
  <img src="" alt="">
  <p></p>
</dialog>
<script>
(function () {
  var viewer = document.getElementById('shot-viewer');
  if (!viewer || !viewer.showModal) return;
  var big = viewer.querySelector('img'), note = viewer.querySelector('p');
  document.querySelectorAll('.blog-post .content .doc-shot img').forEach(function (img) {
    img.addEventListener('click', function () {
      var cap = img.closest('figure').querySelector('figcaption');
      big.src = img.currentSrc || img.src;
      big.alt = img.alt;
      note.textContent = cap ? cap.textContent : '';
      viewer.showModal();
    });
  });
  viewer.addEventListener('click', function () { viewer.close(); });
})();
</script>

<?= $this->endSection() ?>
