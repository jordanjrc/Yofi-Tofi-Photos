<section class="color-block-purple"></section>

<section class="standard-form" id="contact-form">
  <form action="<?= $resquestedPage ?>" method="post">
    <h2>Contact Us</h2>
    <div>
      <label for="name">Name</label>
      <input type="text" id="name" name="name" autofocus required>
    </div>
    <div>
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div>
      <label for="message">Message</label>
      <textarea id="message" name="message" placeholder="Comments / Questions"></textarea>
    </div>
    <div id="submit-button">
      <button type="submit">Send</button>
    </div>
  </form>
</section>