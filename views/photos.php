<section class="color-block-green"></section>

<div id="photos-header">
  <nav>
    <h2>The Photo Gallery</h2>
    <ul>
      <li><a href="/photos" id="<?= ($_SERVER['REQUEST_URI'] === "/photos" ? "current-link" : " ") ?>">all photos</a></li>
      <li><a href="/photos?users" id="<?= ($_SERVER['REQUEST_URI'] === "/photos?users" ? "current-link" : " ") ?>">all users</a></li>
    </ul>
  </nav>
</div>

<? if (isset($_GET['users'])) { ?>
    <div id="photo-gallery-users">
      <? foreach ($users as $user) { ?>
      <a href="profile?user_id=<?= $user->id ?>">
        <div>
          <img src="/images/<?= (!empty($user->filename) ? 'original/' . $user->filename : 'happy-coffee.jpg' ) ?>" alt="<?= $user->title ?>">
          <p><?= $user->first_name . ' ' . $user->last_name ?></p>
          <p id="user-handle"><?= (!empty($user->username) ? '@' . $user->username : '') ?></p>
        </div>
      </a>
    <? } ?>
    </div>
<? } else { ?>
    <div id="photo-gallery">
    <? foreach ($photos as $photo) { ?>
      <div id="image-card">
        <img id="photo-gallery-image<?= $photo->id ?>" src="/images/original/<?= $photo->filename ?>" alt="<?= $photo->title ?>">
        <p><?= $photo->title ?></p>
        <p><a href="profile?user_id=<?= $photo->user_id?>">@<?= $photo->username ?></a></p>
      </div>

      <div id="imageModal" class="modal">
        <!-- The Close Button -->
        <span id="close">&times;</span>
        <!-- Modal Content (The Image) -->
        <img id="modal-image">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
      </div>

      <script>
      var modal = document.getElementById('imageModal');
      var image = document.getElementById('photo-gallery-image<?= $photo->id ?>');
      var modalImage = document.getElementById('modal-image');
      var captionText = document.getElementById('caption');

      image.onclick = function() {
        modal.style.display = "block";
        modalImage.src = this.src;
        captionText.innerHTML = this.alt;
      }

      var closeSpan = document.getElementById('close');

      closeSpan.onclick = function() {
        modal.style.display = "none";
      }
      </script>

    <? } ?>
    <div id="image-card" class="hidden"></div>
    <div id="image-card" class="hidden"></div>
    <div id="image-card" class="hidden"></div>
    <div id="image-card" class="hidden"></div>
    </div>
<? } ?>

