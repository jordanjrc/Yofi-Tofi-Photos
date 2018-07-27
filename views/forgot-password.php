<section class="color-block-blue"></section>

<? if ($sentEmail) { ?>

  <section id="login-form-message">
    <div>
      We have sent you an email with instructions to reset your password.
    </div>
  </section>

<? } else { ?>

  <section class="standard-form" id="login-form">
    <form action="<?= $requestedPage ?>" method="post">
      <h2>Reset your password</h2>
      <div>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" autofocus required>
        <span id="error-message"><?= $emailErrorMessage ?></span>
      </div>
      <div id="submit-button">
        <button type="submit">Send me instructions!</button>
      </div>
    </form>
  </section>

<? } ?>