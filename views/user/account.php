<? include('includes/dashboard-header.php'); ?>

<section id="dashboard">
  <? include('includes/dashboard-side.php'); ?>
  <section id="account-settings">
    <h2>Account Settings</h2>
    <div id="error-message"></div>
    <div id="account-content">
      <div id="name"><span><?= ucfirst($userInfo->first_name) ?></span> <span><?= ucfirst($userInfo->last_name) ?></span></div>
      <p id="username"><?= $userInfo->username ?></p>
      <p id="email"><?= $userInfo->email ?></p>
    </div>
    <div id="buttons">
      <button id="edit-button">edit account</button>
      <button id="reset-password-button">reset password</button>
    </div>
  </section>
</section>

<script>
  var errorMessage = document.getElementById('error-message');
  var error = document.createElement('p');
  var accountContent = document.getElementById('account-content');
  var buttons = document.getElementById('buttons');
  var editButton = document.getElementById('edit-button');
  var resetPasswordButton = document.getElementById('reset-password-button');

  var saveButton = document.createElement('button');
  saveButton.className = 'fas fa-check';

  var cancelButton = document.createElement('button');
  cancelButton.className = 'fas fa-times';

  cancelButton.addEventListener('click', function (event) {
    window.location.reload();
  });

  editButton.addEventListener('click', function (event) {
    var fullName = accountContent.querySelectorAll('span');
    var firstName = fullName[0];
    var lastName = fullName[1];
    var username = document.getElementById('username');
    var email = document.getElementById('email');

    while (accountContent.hasChildNodes()) {
      accountContent.removeChild(accountContent.lastChild);
    }

    var nameDiv = document.createElement('div');
    accountContent.appendChild(nameDiv);

    var firstNameLabel = document.createElement('label');
    firstNameLabel.setAttribute('for', 'first-name');
    firstNameLabel.innerHTML = 'first name';
    nameDiv.appendChild(firstNameLabel);

    var firstNameInput = document.createElement('input');
    firstNameInput.id = 'first-name';
    firstNameInput.value = firstName.textContent;
    nameDiv.appendChild(firstNameInput);

    var lastNameLabel = document.createElement('label');
    lastNameLabel.setAttribute('for', 'last-name');
    lastNameLabel.innerHTML = 'last name';
    nameDiv.appendChild(lastNameLabel);

    var lastNameInput = document.createElement('input');
    lastNameInput.id = 'last-name';
    lastNameInput.value = lastName.textContent;
    nameDiv.appendChild(lastNameInput);

    var usernameDiv = document.createElement('div');
    accountContent.appendChild(usernameDiv);

    var usernameLabel = document.createElement('label');
    usernameLabel.setAttribute('for', 'username');
    usernameLabel.innerHTML = 'username';
    usernameDiv.appendChild(usernameLabel);

    var usernameInput = document.createElement('input');
    usernameInput.id = 'username';
    usernameInput.value = username.textContent;
    usernameDiv.appendChild(usernameInput);

    var emailDiv = document.createElement('div');
    accountContent.appendChild(emailDiv);

    var emailLabel = document.createElement('label');
    emailLabel.setAttribute('for', 'email');
    emailLabel.innerHTML = 'email';
    emailDiv.appendChild(emailLabel);

    var emailInput = document.createElement('input');
    emailInput.id = 'email';
    emailInput.value = email.textContent;
    emailInput.setAttribute('type', 'email');
    emailDiv.appendChild(emailInput);

    buttons.replaceChild(saveButton, editButton);
    buttons.replaceChild(cancelButton, resetPasswordButton);

    accountContent.className = 'account-content-edit';

    saveButton.addEventListener('click', function (event) {
      var http = new XMLHttpRequest();
      var url = '/<?= $requestedPage ?>';
      var params = 'first-name=' + firstNameInput.value + '&last-name=' + lastNameInput.value + '&username=' + usernameInput.value + '&email=' + emailInput.value;

      http.open('POST', url, true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          console.log(http.responseText);
          console.log(http);
          if (http.response === 'blank-field') {
            error.textContent = 'Please fill in the blank fields.';
            errorMessage.appendChild(error);
          } else if (http.response === 'email-taken') {
            error.textContent = 'Sorry, that email is already associated with an account.';
            errorMessage.appendChild(error);
          } else if (http.response === 'email-invalid') {
            error.textContent = 'Please provide a valid email address.';
            errorMessage.appendChild(error);
          } else if (http.response === 'username-taken') {
            error.textContent = 'Sorry, that username is already in use.';
            errorMessage.appendChild(error);
          } else {
            window.location.reload();
          }
        }
      }
      http.send(params);
    });
  });

  resetPasswordButton.addEventListener('click', function (event) {
    while (accountContent.hasChildNodes()) {
      accountContent.removeChild(accountContent.lastChild);
    }

    var oldPasswordDiv = document.createElement('div');
    accountContent.appendChild(oldPasswordDiv);
    var newPasswordDiv = document.createElement('div');
    accountContent.appendChild(newPasswordDiv);

    var oldPasswordLabel = document.createElement('label');
    oldPasswordLabel.setAttribute('for', 'old-password');
    oldPasswordLabel.innerHTML = 'old password';
    oldPasswordDiv.appendChild(oldPasswordLabel);

    var oldPassword = document.createElement('input');
    oldPassword.id = 'old-password';
    oldPassword.setAttribute('type', 'password');
    oldPasswordDiv.appendChild(oldPassword);

    var newPasswordLabel = document.createElement('label');
    newPasswordLabel.setAttribute('for', 'new-password');
    newPasswordLabel.innerHTML = 'new password';
    newPasswordDiv.appendChild(newPasswordLabel);

    var newPassword = document.createElement('input');
    newPassword.id = 'new-password';
    newPassword.setAttribute('type', 'password');
    newPasswordDiv.appendChild(newPassword);

    buttons.replaceChild(saveButton, editButton);
    buttons.replaceChild(cancelButton, resetPasswordButton);

    accountContent.className = 'account-content-edit';

    saveButton.addEventListener('click', function (event) {
      var http = new XMLHttpRequest();
      var url = '/<?= $requestedPage ?>';
      var params = 'old-password=' + oldPassword.value + '&new-password=' + newPassword.value;

      http.open('POST', url, true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      http.onreadystatechange = function () {
        if (http.readyState == XMLHttpRequest.DONE) {
          if (http.response === 'blank-field') {
            error.textContent = 'Please fill in the blank fields.';
            errorMessage.appendChild(error);
          } else if (http.response === 'no-match') {
            error.textContent = 'The old password you provided is incorrect.';
            errorMessage.appendChild(error);
          } else {
            window.location.reload();
          }
        }
      }
      http.send(params);
    });
  });
</script>
