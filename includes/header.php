<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/auth.php';
$user = currentUser();
$base = '/foodfusion';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?= htmlspecialchars($pageTitle ?? 'FoodFusion') ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="stylesheet" href="<?= $base ?>/css/main.css"/>
</head>
<body>

<!-- ══ NAVBAR ══════════════════════════════════════════════ -->
<nav class="navbar" id="navbar">
  <div class="nav-container">
    <a href="<?= $base ?>/index.php" class="nav-logo">
      <span class="logo-icon">🍽</span>
      <span>Food<strong>Fusion</strong></span>
    </a>

    <ul class="nav-links" id="navLinks">
      <li><a href="<?= $base ?>/index.php">Home</a></li>
      <li><a href="<?= $base ?>/pages/about.php">About</a></li>
      <li><a href="<?= $base ?>/pages/recipes.php">Recipes</a></li>
      <li><a href="<?= $base ?>/pages/community.php">Community</a></li>
      <li><a href="<?= $base ?>/pages/contact.php">Contact</a></li>
      <li><a href="<?= $base ?>/pages/resources.php">Resources</a></li>
      <li><a href="<?= $base ?>/pages/educational.php">Learn</a></li>
      <?php if (isLoggedIn()): ?>
        <li class="nav-mobile-only"><a href="<?= $base ?>/pages/community.php">Hi, <?= htmlspecialchars($user['first_name']) ?></a></li>
        <li class="nav-mobile-only"><a href="<?= $base ?>/includes/logout.php">Logout</a></li>
      <?php else: ?>
        <li class="nav-mobile-only"><a href="<?= $base ?>/pages/login.php">Login</a></li>
        <li class="nav-mobile-only">
          <button type="button" class="btn btn-primary btn-sm nav-mobile-cta js-open-join-modal">Join Us</button>
        </li>
      <?php endif; ?>
    </ul>

    <div class="nav-actions">
      <button class="theme-toggle" id="themeToggle" title="Toggle theme">
        <i class="fas fa-moon" id="themeIcon"></i>
      </button>
      <?php if (isLoggedIn()): ?>
        <span class="nav-greeting">Hi, <?= htmlspecialchars($user['first_name']) ?></span>
        <a href="<?= $base ?>/includes/logout.php" class="btn btn-outline btn-sm">Logout</a>
      <?php else: ?>
        <a href="<?= $base ?>/pages/login.php" class="btn btn-outline btn-sm">Login</a>
        <button type="button" class="btn btn-primary btn-sm js-open-join-modal">Join Us</button>
      <?php endif; ?>
      <button class="hamburger" id="hamburger" aria-label="Menu" aria-controls="navLinks" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>
<!-- ════════════════════════════════════════════════════════ -->
