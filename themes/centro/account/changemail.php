<?php if (!defined('FLUX_ROOT')) exit; ?>
<div class="changemail">
  <?php if (!empty($errorMessage)): ?>
    <div class="changemail__error">
      <?php echo htmlspecialchars($errorMessage) ?>
    </div>
  <?php endif ?>
  <form action="<?php echo $this->urlWithQs ?>" method="post">
    <div class="changemail__email">
      <label for="changemail_email">
        <?php echo htmlspecialchars(Flux::message('EmailChangeLabel')) ?>
      </label>
      <input
        type="email"
        name="email"
        id="email"
      />
      <small><?php echo htmlspecialchars(Flux::message('EmailChangeInputNote')) ?></small>
    </div>
    <input
      type="submit"
      value="<?php echo htmlspecialchars(Flux::message('EmailChangeButton')) ?>"
      class="changemail__submit"
    />
  </form>
</div>
