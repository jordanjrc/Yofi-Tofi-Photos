<? include('includes/dashboard-header.php'); ?>

<section id="dashboard">
<? include('includes/dashboard-side.php'); ?>
  <section>
    <h2>Your photos</h2>
    <div id="dashboard-photos">
      <? foreach ($photos as $photo) { ?>
        <div>
          <img src="/images/resized/<?= $photo->filename ?>" alt="<?= $photo->title ?>">
          <div id="image-<?= $photo->id ?>">
            <p><?= $photo->title ?></p>
            <button id="edit-button-<?= $photo->id ?>"><i class="far fa-edit"></i></button>
            <button id="trash-button-<?= $photo->id ?>"><i class="far fa-trash-alt"></i></button>
          </div>
        </div>

        <script>
          var editButton = document.getElementById('edit-button-<?= $photo->id ?>');
          var trashButton = document.getElementById('trash-button-<?= $photo->id ?>');

          editButton.addEventListener('click', function (event) {
            var div = document.getElementById('image-<?= $photo->id ?>')
            var title = div.querySelector('p');
            var editButton = document.getElementById('edit-button-<?= $photo->id ?>');
            var trashButton = document.getElementById('trash-button-<?= $photo->id ?>');

            var newTitle = document.createElement('input');
            newTitle.value = title.textContent;
            div.replaceChild(newTitle, title);

            var saveButton = document.createElement('button');
            saveButton.className = 'fas fa-check';
            div.replaceChild(saveButton, editButton);

            var cancelButton = document.createElement('button');
            cancelButton.className = 'fas fa-times';
            div.replaceChild(cancelButton, trashButton);

            cancelButton.addEventListener('click', function (event) {
              resetButtons();
            });

            saveButton.addEventListener('click', function () {
              var http = new XMLHttpRequest();
              var url = '/<?= $requestedPage ?>';
              var params = 'photo-id=<?= $photo->id ?>&title=' + newTitle.value;

              http.open('POST', url, true);
              http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              http.send(params);

              title.textContent = newTitle.value.toLowerCase();

              resetButtons();
            });

            resetButtons = function () {
              div.replaceChild(title, newTitle);
              div.replaceChild(editButton, saveButton);
              div.replaceChild(trashButton, cancelButton);
            };
          });

          trashButton.addEventListener('click', function (event) {
            var confirmDelete = confirm('are you sure you want to delete this photo?');

            if (confirmDelete == true) {
              var http = new XMLHttpRequest();
              var url = '/<?= $requestedPage ?>';
              var params = 'photo-id=<?= $photo->id ?>&delete-photo';

              http.open('POST', url, true);
              http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              http.send(params);

              window.location.reload()
            }
          });
        </script>
      <? } ?>
    </div>
  </section>
</section>
