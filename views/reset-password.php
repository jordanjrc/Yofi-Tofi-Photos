<section class="color-block-blue"></section>

<? if ($tokenNotFound) { ?>

  <section id="login-form-message">
    <div>
      <p>That reset link does not seem to be working. Please try to reset your <a href='forgot-password'>password</a> again.</p>
    </div>
  </section>

<? } else { ?>

  <section class="standard-form" id="login-form">
    <form action="<?= $resquestedPage ?>" method="post">
      <h2>Reset your password</h2>
      <div>
        <label for="password">New Password</label>
        <input type="password" id="password" name="password" required autofocus>
        <input name="token" type="hidden" value="<?= $_GET['token'] ?>">
      </div>
      <div id="submit-button">
        <button type="submit">Reset Password</button>
      </div>
    </form>
  </section>

<? } ?>