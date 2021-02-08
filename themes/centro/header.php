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
  <div id="root">
    <header id="header">
      <div class="header__content">
        <div class="header__logo">
          <a href="#"></a>
        </div>
        <nav class="nav">
          <ul>
            <li><a href="#">News</a></li>
            <li><a href="#">Server Info</a></li>
            <li><a href="#">Donation</a></li>
            <li><a href="#">Download</a></li>
            <li><a href="#">Register</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <main id="main">
      <div class="main__content">
        <h1 class="main__title"><?php echo isset($title) ? $title : 'News'; ?></h1>