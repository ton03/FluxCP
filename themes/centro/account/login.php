<?php if (!defined('FLUX_ROOT')) exit; ?>
<div class="login">
  <?php if (isset($errorMessage)): ?>
    <div class="login__error">
      <?= htmlspecialchars($errorMessage) ?>
    </div>
  <?php endif; ?>
  <form
    action="<?=
      $this->url(
        'account',
        'login',
        array('return_url' => $this->url('account', 'view'))
      )
    ?>"
    method="post"
    spellcheck="false"
  >
    <input
      type="hidden"
      name="server"
      value="CentRO"
    />
    <div class="login__username">
      <label for="login_username">Username</label>
      <input
        type="text"
        name="username"
        id="login_username"
        value="<?= htmlspecialchars($params->get('username')) ?>"
        autocomplete="username"
      />
    </div>
    <div class="login__password">
      <label for="login_password">Password</label>
      <input
        type="password"
        name="password"
        id="login_password"
        autocomplete="current-password"
      />
    </div>
    <?php if (Flux::config('UseLoginCaptcha')): ?>
      <div class="captcha">
        <label for="register_security_code">
          <?= htmlspecialchars(Flux::message('AccountSecurityLabel')) ?>
        </label>
        <?php if (Flux::config('EnableReCaptcha')): ?>
          <div
            class="g-recaptcha"
            data-theme="<?php echo $theme;?>"
            data-sitekey="<?php echo $recaptcha ?>"
          ></div>
        <?php else: ?>
          <div class="security-code">
            <img src="<?php echo $this->url('captcha') ?>" />
          </div>
          <input
            type="text"
            name="security_code"
            id="register_security_code"
          />
          <div class="action">
            <strong>
              <a href="javascript:refreshSecurityCode('.security-code img')">
                <?php echo htmlspecialchars(Flux::message('RefreshSecurityCode')) ?>
              </a>
            </strong>
          </div>
        <?php endif ?>
      </div>
    <?php endif ?>
    <input
      type="submit"
      value="Login"
      class="login__submit"
    />
  </form>
  <div class="login__links">
    <a href="<?= $this->url('account', 'resetpass') ?>">Reset Password</a>
  </div>
</div>
