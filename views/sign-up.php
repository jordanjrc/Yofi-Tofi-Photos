<section id="sign-up-form">
  <h2>Sign up</h2>
  <form action="<?= $resquestedPage ?>" method="post">

    <div>
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ?>" autofocus required>
      <span id="error-message"><?= $emailErrorMessage ?></span>
    </div>

    <div id="first-last-name">
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" value="<?= (!empty($_POST['first_name'])) ? $_POST['first_name'] : '' ?>">
      <span id="error-message"><?= $firstNameErrorMessage ?></span>
    </div>

    <div id="first-last-name">
      <label for="first_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" value="<?= (!empty($_POST['last_name'])) ? $_POST['last_name'] : '' ?>">
      <span id="error-message"><?= $lastNameErrorMessage ?></span>
    </div>

    <div>
      <label for="username">Username (optional)</label>
      <input type="text" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : '' ?>">
      <span id="error-message"><?= $usernameErrorMessage ?></span>
    </div>

    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password">
      <span id="error-message"><?= $passwordErrorMessage ?></span>
    </div>

    <div id="button">
      <button type="submit">create account</button>
    </div>

  </form>
</section>

