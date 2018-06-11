<section id="sign-up-form">
  <h2>Log in to your account</h2>
  <form action="<?= $resquestedPage ?>" method="post">

    <div>
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" autofocus required>
      <span id="error-message"><?= $emailErrorMessage ?></span>
    </div>

    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <span id="error-message"><?= $passwordErrorMessage ?></span>
    </div>

    <div id="button">
      <button type="submit">Login</button>
    </div>

    <div>
      <a href="/forgot-password" id="forgot-password">forgot your password?</a>
    <div>

  </form>
</section>
