<div id="dashboard-navbar">
  <nav>
    <ul>
      <li>
        <a href="/user/dashboard" id="<?= ($requestedPage === "user/dashboard" ? "current-link" : " ") ?>">dashboard</a>
      </li>
      <li>
        <a href="/user/photos" id="<?= ($requestedPage === "user/photos" ? "current-link" : " ") ?>">your photos</a>
      </li>
      <li>
        <a href="/user/upload-photo" id="<?= ($requestedPage === "user/upload-photo" ? "current-link" : " ") ?>">upload a photo</a>
      </li>
      <li>
        <a href="">account settings</a>
      </li>
    </ul>
  </nav>
</div>
