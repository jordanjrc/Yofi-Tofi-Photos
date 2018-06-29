<? include('includes/dashboard-header.php'); ?>

<section id="dashboard">
<? include('includes/dashboard-side.php'); ?>
  <section class="standard-form" id="login-form">
    <form action="/<?= $resquestedPage ?>" method="post" enctype="multipart/form-data">
      <h2>Upload a Photo</h2>
      <span id="error-message"><?= $errorMessage ?></span>
      <div>
        <label for="photo-upload-file">Photo</label>
        <input type="file" id="photo-upload-file" name="photo-upload-file" required>
      </div>
      <div>
        <label for="photo-upload-title">Title</label>
        <input type="text" id="photo-upload-title" name="photo-upload-title" required>
      </div>
      <div id="submit-button">
        <button type="submit" name="submit">Upload</button>
      </div>
    </form>
  </section>
</section>
