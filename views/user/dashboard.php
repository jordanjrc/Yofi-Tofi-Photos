<section id="dashboard-header-photo"></section>

<section class="color-block-yellow"></section>

<section id="dashboard">
  <div id="dashboard-tabs">
    <ul>
      <li>
        <a href="">your photos</a>
      </li>
      <li>
        <a href="/user/upload-photo">upload a photo</a>
      </li>
      <li>
        <a href="">account settings</a>
      </li>
    </ul>
  </div>
  <div id="dashboard-body">
    <? if (isset($_GET['photo-uploaded'])) { ?>
      <p id="success-message"><i class="fas fa-check"></i> Your photo was successfully uploaded</p>
    <? } ?>
    <h2>Welcome, <?= ucfirst($user->first_name) ?>!</h2>
    <p>this is your page!! yipppeeee!</p>

  </div>
</section>

