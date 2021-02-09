<?php if (!defined('FLUX_ROOT')) exit; ?>
<div class="changepass">
  <?php if (!empty($errorMessage)): ?>
    <div class="changepass__error">
      <?php echo htmlspecialchars($errorMessage) ?>
    </div>
  <?php endif ?>
  <form action="<?php echo $this->urlWithQs ?>" method="post">
    <div class="changepass__currentpass">
      <label for="changepass_currentpass">
        <?php echo htmlspecialchars(Flux::message('CurrentPasswordLabel')) ?>
      </label>
      <input
        type="password"
        name="currentpass"
        id="currentpass"
        autocomplete="current-password"
      />
    </div>
    <div class="changepass__newpass">
      <label for="changepass_newpass">
        <?php echo htmlspecialchars(Flux::message('NewPasswordLabel')) ?>
      </label>
      <input
        type="password"
        name="newpass"
        id="newpass"
        autocomplete="new-password"
      />
    </div>
    <div class="changepass__confirmnewpass">
      <label for="changepass_confirmnewpass">
        <?php echo htmlspecialchars(Flux::message('NewPasswordConfirmLabel')) ?>
      </label>
      <input
        type="password"
        name="confirmnewpass"
        id="confirmnewpass"
        autocomplete="new-password"
      />
      <small><?php echo htmlspecialchars(Flux::message('PasswordChangeNote2')) ?></small>
    </div>
    <input
      type="submit"
      value="<?php echo htmlspecialchars(Flux::message('PasswordChangeButton')) ?>"
      class="changepass__submit"
    />
  </form>
</div>
