<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php if (!empty($errorMessage)): ?>
  <p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<div class="details">
  <?php if ($account): ?>
    <table class="table">
      <tr>
        <th><?php echo htmlspecialchars(Flux::message('UsernameLabel')) ?></th>
        <td><?php echo htmlspecialchars($account->userid) ?></td>
        <th><?php echo htmlspecialchars(Flux::message('LoginCountLabel')) ?></th>
        <td><?php echo number_format((int)$account->logincount) ?></td>
      </tr>
      <tr>
        <th><?php echo htmlspecialchars(Flux::message('EmailAddressLabel')) ?></th>
        <td>
          <?php if ($account->email): ?>
            <?php echo htmlspecialchars($account->email) ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
          <?php endif ?>
        </td>
        <th><?php echo htmlspecialchars(Flux::message('LastLoginDateLabel')) ?></th>
        <td colspan="3">
          <?php if (!$account->lastlogin || $account->lastlogin <= '1000-01-01 00:00:00'): ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NeverLabel')) ?></span>
          <?php else: ?>
            <?php echo $this->formatDateTime($account->lastlogin) ?>
          <?php endif ?>
        </td>
      </tr>
      <tr>
        <th><?php echo htmlspecialchars(Flux::message('GenderLabel')) ?></th>
        <td>
          <?php if ($gender = $this->genderText($account->sex)): ?>
            <?php echo $gender ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>
          <?php endif ?>
        </td>
        <th><?php echo htmlspecialchars(Flux::message('LastUsedIpLabel')) ?></th>
        <td colspan="3">
          <?php if ($account->last_ip): ?>
            <?php echo htmlspecialchars($account->last_ip) ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
          <?php endif ?>
        </td>
      </tr>
      <tr>
        <th><?php echo htmlspecialchars(Flux::message('AccountBirthdateLabel')) ?></th>
        <td><?php echo $account->birthdate ?></td>
        <th><?php echo htmlspecialchars(Flux::message('VIPStateLabel')) ?></th>
        <td><?php echo $vipexpires ?></td>
      </tr>
    </table>
  <?php endif ?>
  <div class="actions">
    <a
      href="<?= $this->url('account', 'changepass') ?>"
      class="change-password-button"
    >
      Change Password
    </a>
    <a
      href="<?= $this->url('account', 'changemail') ?>"
      class="change-email-button"
    >
      Change E-mail Address
    </a>
    <a
      href="http://m.me/arsenalragnarok"
      alt="Facebook Messenger"
      target="_blank"
      rel="noopener noreferrer"
      class="report-an-issue-button"
    >
      <img
        src="<?= $this->themePath('static/messenger.svg') ?>"
        alt="Facebook Messenger"
        width="18"
        height="18"
      />
      Report an Issue
    </a>
  </div>
</div>
<div class="characters">
  <?php foreach ($characters as $serverName => $chars): $zeny = 0; ?>
    <h3><?php echo htmlspecialchars(sprintf(Flux::message('AccountViewCharSubHead'), $serverName)) ?></h3>
    <?php if ($chars): ?>
    <table class="vertical-table">
      <tr>
        <th>Name</th>
        <th>Job</th>
        <th><?php echo htmlspecialchars(Flux::message('AccountViewLvlLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('AccountViewJlvlLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('AccountViewZenyLabel')) ?></th>
        <th colspan="2"><?php echo htmlspecialchars(Flux::message('AccountViewGuildLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('AccountViewStatusLabel')) ?></th>
      </tr>
      <?php foreach ($chars as $char): $zeny += $char->zeny; ?>
      <tr>
        <td>
          <?php echo htmlspecialchars($char->name) ?>
        </td>
        <td><?php echo htmlspecialchars($this->jobClassText($char->class)) ?></td>
        <td><?php echo (int)$char->base_level ?></td>
        <td><?php echo (int)$char->job_level ?></td>
        <td><?php echo number_format((int)$char->zeny) ?></td>
        <?php if ($char->guild_name): ?>
          <?php if ($char->guild_emblem_len): ?>
          <td><img src="<?php echo $this->emblem($char->guild_id) ?>" /></td>
          <?php endif ?>
          <td<?php if (!$char->guild_emblem_len) echo ' colspan="2"' ?>>
            <?php if ($auth->actionAllowed('guild', 'view')): ?>
              <?php echo $this->linkToGuild($char->guild_id, $char->guild_name) ?>
            <?php else: ?>
              <?php echo htmlspecialchars($char->guild_name) ?>
            <?php endif ?>
          </td>
        <?php else: ?>	
          <td colspan="2" align="center"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span></td>
        <?php endif ?>
        <td>
          <?php if ($char->online): ?>
            <span class="online"><?php echo htmlspecialchars(Flux::message('OnlineLabel')) ?></span>
          <?php else: ?>
            <span class="offline"><?php echo htmlspecialchars(Flux::message('OfflineLabel')) ?></span>
          <?php endif ?>
        </td>
        <?php if (($isMine || $auth->allowedToModifyCharPrefs) && $auth->actionAllowed('character', 'prefs')): ?>
        <?php endif ?>
      </tr>
      <?php endforeach ?>
      </table>
      <p>Total Zeny: <strong><?php echo number_format($zeny) ?></strong></p>
    <?php else: ?>
    <p><?php echo htmlspecialchars(sprintf(Flux::message('AccountViewNoChars'), $serverName)) ?></p>
    <?php endif ?>
  <?php endforeach ?>
</div>
<div class="storage hidden">
  <h3>Storage</h3>
  <?php if ($items): ?>
    <table class="vertical-table">
      <tr>
        <th colspan="2"><?php echo htmlspecialchars(Flux::message('ItemNameLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemAmountLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemIdentifyLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemBrokenLabel')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemCard0Label')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemCard1Label')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemCard2Label')) ?></th>
        <th><?php echo htmlspecialchars(Flux::message('ItemCard3Label')) ?></th>
        <th>Extra</th>
        </th>
      </tr>
      <?php foreach ($items AS $item): ?>
      <?php $icon = $this->iconImage($item->nameid) ?>
      <tr>
        <?php if ($icon): ?>
        <td><img src="<?php echo htmlspecialchars($icon) ?>" /></td>
        <?php endif ?>
        <td<?php if (!$icon) echo ' colspan="2"' ?><?php if ($item->cardsOver) echo ' class="overslotted' . $item->cardsOver . '"'; else echo ' class="normalslotted"' ?>>
          <?php if ($item->refine > 0): ?>
            +<?php echo htmlspecialchars($item->refine) ?>
          <?php endif ?>
                  <?php if ($item->card0 == 255 && intval($item->card1/1280) > 0): ?>
                      <?php $itemcard1 = intval($item->card1/1280); ?>
            <?php for ($i = 0; $i < $itemcard1; $i++): ?>
              Very
            <?php endfor ?>
            Strong
          <?php endif ?>
          <?php if ($item->card0 == 254 || $item->card0 == 255): ?>
            <?php if ($item->char_name): ?>
              <?php if ($auth->actionAllowed('character', 'view') && ($isMine || (!$isMine && $auth->allowedToViewCharacter))): ?>
                <?php echo $this->linkToCharacter($item->char_id, $item->char_name, $session->serverName) . "'s" ?>
              <?php else: ?>
                <?php echo htmlspecialchars($item->char_name . "'s") ?>
              <?php endif ?>
            <?php else: ?>
              <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>'s
            <?php endif ?>
          <?php endif ?>
          <?php if ($item->card0 == 255 && array_key_exists($item->card1%1280, $itemAttributes)): ?>
            <?php echo htmlspecialchars($itemAttributes[$item->card1%1280]) ?>
          <?php endif ?>
          <?php if ($item->name_english): ?>
            <span class="item_name"><?php echo htmlspecialchars($item->name_english) ?></span>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>
          <?php endif ?>
          <?php if ($item->slots): ?>
            <?php echo htmlspecialchars(' [' . $item->slots . ']') ?>
          <?php endif ?>
        </td>
        <td><?php echo number_format($item->amount) ?></td>
        <td>
          <?php if ($item->identify): ?>
            <span class="identified yes"><?php echo htmlspecialchars(Flux::message('YesLabel')) ?></span>
          <?php else: ?>
            <span class="identified no"><?php echo htmlspecialchars(Flux::message('NoLabel')) ?></span>
          <?php endif ?>
        </td>
        <td>
          <?php if ($item->attribute): ?>
            <span class="broken yes"><?php echo htmlspecialchars(Flux::message('YesLabel')) ?></span>
          <?php else: ?>
            <span class="broken no"><?php echo htmlspecialchars(Flux::message('NoLabel')) ?></span>
          <?php endif ?>
        </td>
        <td>
          <?php if($item->card0 && ($item->type == 4 || $item->type == 5) && $item->card0 != 254 && $item->card0 != 255 && $item->card0 != -256): ?>
            <?php if (!empty($cards[$item->card0])): ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card0, $cards[$item->card0]) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($cards[$item->card0]) ?>
              <?php endif ?>
            <?php else: ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card0, $item->card0) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($item->card0) ?>
              <?php endif ?>
            <?php endif ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
          <?php endif ?>
        </td>
        <td>
          <?php if($item->card1 && ($item->type == 4 || $item->type == 5) && $item->card0 != 255 && $item->card0 != -256): ?>
            <?php if (!empty($cards[$item->card1])): ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card1, $cards[$item->card1]) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($cards[$item->card1]) ?>
              <?php endif ?>
            <?php else: ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card1, $item->card1) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($item->card1) ?>
              <?php endif ?>
            <?php endif ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
          <?php endif ?>
        </td>
        <td>
          <?php if($item->card2 && ($item->type == 4 || $item->type == 5) && $item->card0 != 254 && $item->card0 != 255 && $item->card0 != -256): ?>
            <?php if (!empty($cards[$item->card2])): ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card2, $cards[$item->card2]) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($cards[$item->card2]) ?>
              <?php endif ?>
            <?php else: ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card2, $item->card2) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($item->card2) ?>
              <?php endif ?>
            <?php endif ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
          <?php endif ?>
        </td>
        <td>
          <?php if($item->card3 && ($item->type == 4 || $item->type == 5) && $item->card0 != 254 && $item->card0 != 255 && $item->card0 != -256): ?>
            <?php if (!empty($cards[$item->card3])): ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card3, $cards[$item->card3]) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($cards[$item->card3]) ?>
              <?php endif ?>
            <?php else: ?>
              <?php if ($auth->actionAllowed('item', 'view')): ?>
                <?php echo $this->linkToItem($item->card3, $item->card3) ?>
              <?php else: ?>
                <?php echo htmlspecialchars($item->card3) ?>
              <?php endif ?>
            <?php endif ?>
          <?php else: ?>
            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
          <?php endif ?>
        </td>
        <td>
        <?php if($item->bound == 1):?>
          Account Bound
        <?php elseif($item->bound == 2):?>
          Guild Bound
        <?php elseif($item->bound == 3):?>
          Party Bound
        <?php elseif($item->bound == 4):?>
          Character Bound
        <?php else:?>
            <span class="not-applicable">None</span>
        <?php endif ?>
        </td>
      </tr>
      <?php endforeach ?>
    </table>
  <?php else: ?>
    <p><?php echo htmlspecialchars(Flux::message('AccountViewNoStorage')) ?></p>
  <?php endif ?>
</div>
