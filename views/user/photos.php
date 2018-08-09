<? include('includes/dashboard-header.php'); ?>

<section id="dashboard">
<? include('includes/dashboard-side.php'); ?>
  <section>
    <h2>Your photos</h2>
    <div id="dashboard-photos">
      <? foreach ($photos as $photo) { ?>
        <div>
          <img src="/images/resized/<?= $photo->filename ?>" alt="<?= $photo->title ?>">
          <div class="image">
            <p id="<?= $photo->id ?>"><?= $photo->title ?></p>
            <button id="edit-button"><i class="far fa-edit"></i></button>
            <button id="trash-button"><i class="far fa-trash-alt"></i></button>
          </div>
        </div>
      <? } ?>
    </div>
  </section>
</section>


<script>
  var images = document.getElementsByClassName('image');

  for (i = 0; i < images.length; i++) {
    (function () {
      var image = images[i];
      var title = image.querySelector('p');
      var editButton = image.querySelectorAll('button')[0];
      var trashButton = image.querySelectorAll('button')[1];

      editButton.addEventListener('click', function () {
        var saveButton = document.createElement('button');
        saveButton.className = 'fas fa-check';
        image.appendChild(saveButton);

        var cancelButton = document.createElement('button');
        cancelButton.className = 'fas fa-times';
        image.appendChild(cancelButton);

        var newTitle = document.createElement('input');
        newTitle.value = title.textContent;
        image.replaceChild(newTitle, title);

        image.removeChild(editButton);
        image.removeChild(trashButton);

        cancelButton.addEventListener('click', function () {
          image.replaceChild(title, newTitle);
          image.appendChild(editButton);
          image.appendChild(trashButton);
          image.removeChild(saveButton);
          image.removeChild(cancelButton);
        });

        saveButton.addEventListener('click', function () {
          var http = new XMLHttpRequest();
          var url = '/<?= $requestedPage ?>';
          var params = 'photo-id=' + title.id + '&title=' + newTitle.value;

          http.open('POST', url, true);
          http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          http.send(params);

          title.textContent = newTitle.value.toLowerCase();

          image.replaceChild(title, newTitle);
          image.appendChild(editButton);
          image.appendChild(trashButton);
          image.removeChild(saveButton);
          image.removeChild(cancelButton);
        });
      });

      trashButton.addEventListener('click', function (event) {
        var confirmDelete = confirm('are you sure you want to delete this photo?');

        if (confirmDelete == true) {
          var http = new XMLHttpRequest();
          var url = '/<?= $requestedPage ?>';
          var params = 'photo-id=' + title.id + '&delete-photo';

          http.open('POST', url, true);
          http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          http.send(params);

          window.location.reload()
        }
      });
    }());
  }
</script>
