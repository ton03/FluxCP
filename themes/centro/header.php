<?php
if (!defined('FLUX_ROOT')) exit;

// Modules
$mainContentClassnames = [];
$currentModule = $params->get('module');
$currentAction = $params->get('action');
$isHome = $currentModule === 'main' && $currentAction === 'index';
if ($currentModule) {
  array_push(
    $mainContentClassnames,
    'page--' . $currentModule . (
      $currentAction && $currentAction !== 'index'
        ? '--' . $currentAction
        : ''
    ),
  );
}

// Menu items
$menuItems = $this->getMenuItems();
$subMenuItems = $this->getSubMenuItems();

?><!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php if (isset($title)) { echo "$title | "; } echo Flux::config('SiteTitle'); ?></title>
  <?php if (isset($metaRefresh)):
  ?><meta http-equiv="refresh" content="<?php echo $metaRefresh['seconds'] ?>; URL=<?php echo $metaRefresh['location'] ?>" /><?php endif ?>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <!-- <link rel="manifest" href="site.webmanifest"> -->
  <!-- <link rel="apple-touch-icon" href="icon.png"> -->
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="<?php echo $this->themePath('styles.css') ?>">

  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <div id="root" class="<?= implode(' ', $mainContentClassnames) ?>">
    <header id="header">
      <div class="header__content">
        <div class="header__logo">
          <a href="<?= $this->url('main') ?>"></a>
        </div>
        <nav class="nav">
          <ul>
            <li><a href="<?= $this->url('main') ?>">News</a></li>
            <li>
              <a
                href="<?= $this->url('server', 'info') ?>"
                class="<?= $currentModule === 'server' && $currentAction === 'info' ? 'active' : '' ?>"
              >
                Server Info
              </a>
            </li>
            <li><a href="#">Download</a></li>
            <?php if (!$session->isLoggedIn()): ?>
              <li>
                <a
                  href="<?= $this->url('account', 'login') ?>"
                  class="header__register-button"
                >
                  Login
                </a>
              </li>
              <li>
                <a
                  href="<?= $this->url('account', 'create') ?>"
                  class="header__register-button"
                >
                  Register
                </a>
              </li>
            <?php else: ?>
              <li>
                <a
                  href="<?= $this->url('account', 'view') ?>"
                  class="<?= $currentModule === 'account' && $currentAction === 'view' ? 'active' : '' ?>"
                >
                  My Account
                </a>
              </li>
              <li>
                <a href="<?= $this->url('account', 'logout') ?>">
                  Logout
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </header>
    <main id="main">
      <div class="main__content">
        <h1 class="main__title"><?php echo isset($title) ? $title : 'News'; ?></h1>