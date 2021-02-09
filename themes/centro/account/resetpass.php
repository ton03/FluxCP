<?php if (!defined('FLUX_ROOT')) exit; ?>
<div class="resetpass">
  <?php if (!empty($errorMessage)): ?>
    <div class="resetpass__error">
      <?php echo htmlspecialchars($errorMessage) ?>
    </div>
  <?php endif ?>
  <form
    action="<?php echo $this->urlWithQs ?>"
    method="post"
  >
    <div class="resetpass__userid">
      <label for="resetpass_userid">Username</label>
      <input
        type="text"
        name="userid"
        id="userid"
        autocomplete="username"
      />
      <small><?php echo htmlspecialchars(Flux::message('ResetPassAccountInfo')) ?></small>
    </div>
    <div class="resetpass__email">
      <label for="resetpass_email">E-mail Address</label>
      <input
        type="email"
        name="email"
        id="email"
        autocomplete="email"
      />
      <small><?php echo htmlspecialchars(Flux::message('ResetPassEmailInfo')) ?></small>
    </div>
    <input
      type="submit"
      value="<?php echo htmlspecialchars(Flux::message('ResetPassButton')) ?>"
      class="resetpass__submit"
    />
  </form>
</div>
