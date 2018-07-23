<? include('includes/dashboard-header.php'); ?>

<section id="dashboard">
<? include('includes/dashboard-side.php'); ?>
  <section>
    <h2>Your photos</h2>
    <div id="dashboard-photos">
      <? foreach ($photos as $photo) { ?>
        <div>
          <img src="/images/resized/<?= $photo->filename ?>" alt="<?= $photo->title ?>">
          <p><?= $photo->title ?></p>
        </div>
      <? } ?>
    </div>
  </section>
</section>
