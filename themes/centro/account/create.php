<?php if (!defined('FLUX_ROOT')) exit; ?>
<div class="register">
  <div class="register__form">
    <?php if (isset($errorMessage)): ?>
      <div class="register__form__error">
        <?= htmlspecialchars($errorMessage) ?>
      </div>
    <?php endif; ?>
    <form
      action="<?= $this->url ?>"
      method="post"
    >
      <?php if (count($serverNames) === 1): ?>
        <input type="hidden" name="server" value="<?= htmlspecialchars($session->loginAthenaGroup->serverName) ?>">
      <?php endif ?>
      <div class="register__form__field">
        <label for="register_username">Username</label>
        <input
          type="text"
          name="username"
          id="register_username"
          autocomplete="new-username"
          value="<?= htmlspecialchars($params->get('username')) ?>"
        />
      </div>
      <div class="register__form__field">
        <label for="register_password">Password</label>
        <input
          type="password"
          name="password"
          id="register_password"
          autocomplete="new-password"
        />
      </div>
      <div class="register__form__field">
        <label for="register_confirm_password">Confirm Password</label>
        <input
          type="password"
          name="confirm_password"
          id="register_confirm_password"
          autocomplete="new-password"
        />
      </div>
      <div class="register__form__field">
        <label for="register_email_address">E-mail Address</label>
        <input
          type="text"
          name="email_address"
          id="register_email_address"
          value="<?= htmlspecialchars($params->get('email_address')) ?>"
        />
      </div>
      <div class="register__form__field">
        <label for="register_email_address">Confirm E-mail Address</label>
        <input
          type="text"
          name="email_address2"
          id="register_email_address2"
          value="<?= htmlspecialchars($params->get('email_address2')) ?>"
        />
      </div>
      <div class="register__form__field register__form__field--gender">
        <label>Gender</label>
        <div class="options">
          <label for="register_gender_m">
            <input
              type="radio"
              name="gender"
              id="register_gender_m"
              value="M"
              <?php if ($params->get('gender') === 'M') echo ' checked="checked"' ?>
            />
            <span>Male</span>
          </label>
          <label for="register_gender_f">
            <input
              type="radio"
              name="gender"
              id="register_gender_f"
              value="F"
              <?php if ($params->get('gender') === 'F') echo ' checked="checked"' ?>
            />
            <span>Female</span>
          </label>
        </div>
      </div>
      <div class="register__form__field register__form__field--birthdate">
        <label>Birthdate</label>
        <?= $this->dateField('birthdate',null,0) ?>
      </div>
      <div class="register__form__field">
      <?php if (Flux::config('UseCaptcha')): ?>
        <?php if (Flux::config('EnableReCaptcha')): ?>
          <label for="register_security_code">
            <?= htmlspecialchars(Flux::message('AccountSecurityLabel')) ?>
          </label>
          <div class="g-recaptcha" data-theme = "<?= $theme;?>" data-sitekey="<?= $recaptcha ?>"></div>
        <?php else: ?>
          <label for="register_security_code">
            <?= htmlspecialchars(Flux::message('AccountSecurityLabel')) ?>
          </label>
          <div class="security-code">
            <img src="<?php echo $this->url('captcha') ?>" />
          </div>
          <input type="text" name="security_code" id="register_security_code" />
          <div style="font-size: smaller;" class="action">
            <strong><a href="javascript:refreshSecurityCode('.security-code img')"><?php echo htmlspecialchars(Flux::message('RefreshSecurityCode')) ?></a></strong>
          </div>
        <?php endif ?>
			<?php endif ?>
      </div>
      <button type="submit" class="register__form__submit">
        <?php echo htmlspecialchars(Flux::message('AccountCreateButton')) ?>
      </button>
    </form>
  </div>
  <div class="register__guidelines">
    <h3>Registration Guidelines</h3>
    <ul class="ul">
      <li>All fields are required.</li>
      <?php if (Flux::config('RequireEmailConfirm')): ?>
        <li>A working e-mail address must be provided to confirm your account before you can log-in.</li>
      <?php endif ?>
      <li><?= sprintf(
        "Password must be between %d and %d characters.",
        Flux::config('MinPasswordLength'),
        Flux::config('MaxPasswordLength')
      ) ?></li>
      <?php if (Flux::config('PasswordMinUpper') > 0): ?>
        <li><?= sprintf(
          Flux::message('PasswordNeedUpper'),
          Flux::config('PasswordMinUpper'))
        ?></li>
      <?php endif ?>
      <?php if (Flux::config('PasswordMinLower') > 0): ?>
        <li><?= sprintf(
          Flux::message('PasswordNeedLower'),
          Flux::config('PasswordMinLower'))
        ?></li>
      <?php endif ?>
      <?php if (Flux::config('PasswordMinNumber') > 0): ?>
        <li><?= sprintf(
          Flux::message('PasswordNeedNumber'),
          Flux::config('PasswordMinNumber'))
        ?></li>
      <?php endif ?>
      <?php if (Flux::config('PasswordMinSymbol') > 0): ?>
        <li><?= sprintf(
          Flux::message('PasswordNeedSymbol'),
          Flux::config('PasswordMinSymbol'))
        ?></li>
      <?php endif ?>
      <?php if (!Flux::config('AllowUserInPassword')): ?>
        <li><?= Flux::message('PasswordContainsUser') ?></li>
      <?php endif ?>
    </ul>
  </div>
</div>
