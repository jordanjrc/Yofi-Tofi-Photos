<? include('includes/dashboard-header.php'); ?>

<section id="dashboard">
  <? include('includes/dashboard-side.php'); ?>
  <section>
    <? if (isset($_GET['photo-uploaded'])) { ?>
      <p id="success-message"><i class="fas fa-check"></i> Your photo was successfully uploaded</p>
    <? } ?>
    <h2>Welcome, <?= ucfirst($user->first_name) ?>!</h2>
    <p>this is your page!! yipppeeee!</p>
  </section>
</section>

