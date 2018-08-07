<section class="color-block-purple"></section>

<section class="standard-form" id="contact-form">
  <? if (isset($_GET['success'])) { ?>
    <div id="contact-form-message">
      <p>Your email has been sent!</p>
      <img src="images/happygoat.gif">
    </div>
  <? } else { ?>
    <form action="<?= $requestedPage ?>" method="post">
      <h2>Contact Us</h2>
      <div>
        <p id="error-message"><?= ($errorMessage) ? $errorMessage : '' ?></p>
      </div>
      <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= (!empty($_POST['name'])) ? $_POST['name'] : '' ?>" autofocus>
      </div>
      <div>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ?>" required>
      </div>
      <div>
        <label for="message">Message</label>
        <textarea id="message" name="message" value='hi' placeholder="Comments / Questions"><?= (!empty($_POST['message'])) ? $_POST['message'] : '' ?></textarea>
      </div>
      <div id="submit-button">
        <button type="submit">Send</button>
      </div>
    </form>
  <? } ?>
</section>