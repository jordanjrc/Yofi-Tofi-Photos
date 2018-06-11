<? if ($sentEmail) { ?>

  <section id="sign-up-form">
    <div>
      We have sent you an email with instructions to reset your password.
    </div>
  </section>

<? } else { ?>

  <section id="sign-up-form">
    <h2>Reset your password</h2>
    <form action="<?= $resquestedPage ?>" method="post">

      <div>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" autofocus required>
        <span id="error-message"><?= $emailErrorMessage ?></span>
      </div>

      <div id="button">
        <button type="submit">Send me instructions!</button>
      </div>
      
    </form>
  </section>

<? } ?>