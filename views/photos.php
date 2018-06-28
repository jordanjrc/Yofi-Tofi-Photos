<section id="photos-header-photo"></section>

<section class="color-block-green"></section>

<div id="photos-header">
  <h2>The Photo Gallery</h2>
</div>

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

