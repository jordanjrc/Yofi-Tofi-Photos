<section class="color-block-green"></section>

<? if ($error) { ?>
  <div id="profile-header">
    <h2>User not found.</h2>
    <p>return to the <a href="photos">Gallery</a>.</p>
  </div>
<? } else { ?>

<div id="profile-header">
  <h2><?= $userFullName ?></h2>
  <p id="user-handle"><?= (!empty($user->username) ? '@' . $user->username : '') ?></p>
  <? if (empty($photos)) { ?>
    <p>No photos upload yet!</p>
    <p>Return to the <a href="photos?users">user gallery</a>.</p>
  <? } ?>
</div>

<div id="profile-photos">
<? foreach ($photos as $photo) { ?>
  <div>
    <img src="/images/original/<?= $photo->filename ?>" alt="<?= $photo->title ?>">
    <p><?= $photo->title ?></p>
  </div>
<? } ?>
</div>
<? } ?>
