<section class="color-block-green"></section>

<? if (!isset($_GET['user_id'])) { ?>
  <section id="photos-header-photo"></section>
  <div id="photos-header">
    <nav>
      <h2>The Photo Gallery</h2>
      <ul>
        <li><a href="/photos" id="<?= ($_SERVER['REQUEST_URI'] === "/photos" ? "current-link" : " ") ?>">all photos</a></li>
        <li><a href="/photos?users" id="<?= ($_SERVER['REQUEST_URI'] === "/photos?users" ? "current-link" : " ") ?>">all users</a></li>
      </ul>
    </nav>
  </div>
<? } ?>

<? if (isset($_GET['users'])) { ?>
    <div id="photo-gallery-users">
      <? foreach ($users as $user) { ?>
      <a href="photos?user_id=<?= $user->id ?>">
        <div>
          <img src="/images/<?= (!empty($user->filename) ? 'resized/' . $user->filename : 'happy-coffee.jpg' ) ?>" alt="<?= $user->title ?>">
          <p><?= $user->first_name . ' ' . $user->last_name ?></p>
          <p id="user-handle"><?= (!empty($user->username) ? '@' . $user->username : '') ?></p>
        </div>
      </a>
    <? } ?>
    </div>
    <div id="paginator">
    <? if ($page > 1) { ?>
        <a href="photos?users&page=<?= $page - 1 ?>"><i class="fas fa-angle-left"></i> previous page</a>
    <? } ?>
    <? if ($page < $lastPage) { ?>
        <a href="photos?users&page=<?= $page + 1 ?>">next page <i class="fas fa-angle-right"></i></a>
    <? } ?>
    </div>
<? } else { ?>
<? if (isset($_GET['user_id'])) { ?>
  <div id="user-header">
    <h2><?= $userInfo->first_name . ' ' . $userInfo->last_name ?></h2>
    <p id="user-handle"><?= (!empty($userInfo->username) ? '@' . $userInfo->username : '') ?></p>
    <? if (empty($photos)) { ?>
      <p>No photos upload yet!</p>
    <? } ?>
    <p><a href="photos">back to gallery</a></p>
  </div>
<? } ?>

  <div id="photo-gallery">
  <? foreach ($photos as $photo) { ?>
    <div id="image-card">
      <div>
        <img id="photo-gallery-image<?= $photo->id ?>" src="/images/resized/<?= $photo->filename ?>" alt="<?= $photo->title ?>">
        <p><?= $photo->title ?></p>
        <p><a href="photos?user_id=<?= $photo->user_id?>"><?= (!empty($photo->username) ? '@' . $photo->username : $photo->first_name . ' ' . $photo->last_name) ?></a></p>
      </div>
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
      var filename = this.src.replace(/^.*[\\\/]/, '');
      modal.style.display = "block";
      modalImage.src = '/images/original/' + filename;
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

  <div id="paginator">
  <? if ($page > 1) { ?>
      <a href="photos?<?= (isset($_GET['user_id']) ? 'user_id=' . $userId . '&' : '') ?>page=<?= $page - 1 ?>"><i class="fas fa-angle-left"></i> previous page</a>
  <? } ?>
  <? if ($page < $lastPage) { ?>
      <a href="photos?<?= (isset($_GET['user_id']) ? 'user_id=' . $userId . '&' : '') ?>page=<?= $page + 1 ?>">next page <i class="fas fa-angle-right"></i></a>
  <? } ?>
  </div>
<? } ?>
