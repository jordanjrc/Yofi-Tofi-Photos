<? if ($tokenNotFound) { ?>

  <section>
    <div id="reset-password-error-message">
      <p>That reset link does not seem to be working. Please try to reset your <a href='forgot-password'>password</a> again.</p>
    </div>
  </section>

<? } else { ?>

  <section id="sign-up-form">
    <h2>Reset your password</h2>
    <form action="<?= $resquestedPage ?>" method="post">

      <div>
        <label for="password">New Password</label>
        <input type="password" id="password" name="password" required>
        <input name="token" type="hidden" value="<?= $_GET['token'] ?>">
      </div>

      <div id="button">
        <button type="submit">Reset Password</button>
      </div>

    </form>
  </section>
  
<? } ?>