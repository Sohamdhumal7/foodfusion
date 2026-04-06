<?php // includes/footer.php
$base = '/foodfusion';
?>
<!-- ══ FOOTER ════════════════════════════════════════════== -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-col">
      <h3><span class="logo-icon">🍽</span> Food<strong>Fusion</strong></h3>
      <p>Bringing food lovers together through the joy of cooking, sharing, and exploring flavours from around the world.</p>
      <div class="social-links">
        <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        <a href="#" class="social-link" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
      </div>
    </div>
    <div class="footer-col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="<?= $base ?>/index.php">Home</a></li>
        <li><a href="<?= $base ?>/pages/about.php">About Us</a></li>
        <li><a href="<?= $base ?>/pages/recipes.php">Recipes</a></li>
        <li><a href="<?= $base ?>/pages/community.php">Community Cookbook</a></li>
        <li><a href="<?= $base ?>/pages/contact.php">Contact Us</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Resources</h4>
      <ul>
        <li><a href="<?= $base ?>/pages/resources.php">Culinary Resources</a></li>
        <li><a href="<?= $base ?>/pages/educational.php">Educational Resources</a></li>
        <li><a href="<?= $base ?>/pages/privacy.php">Privacy Policy</a></li>
        <li><a href="<?= $base ?>/pages/cookies.php">Cookie Policy</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Contact</h4>
      <p><i class="fas fa-envelope"></i> hello@foodfusion.com</p>
      <p><i class="fas fa-phone"></i> +44 20 1234 5678</p>
      <p><i class="fas fa-map-marker-alt"></i> London, United Kingdom</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© <?= date('Y') ?> FoodFusion. All rights reserved. |
      <a href="<?= $base ?>/pages/privacy.php">Privacy Policy</a> |
      <a href="<?= $base ?>/pages/cookies.php">Cookie Policy</a>
    </p>
  </div>
</footer>

<!-- ══ JOIN US MODAL ═════════════════════════════════════== -->
<div class="modal-overlay" id="joinModal">
  <div class="modal">
    <button class="modal-close" id="closeJoinModal">&times;</button>
    <div class="modal-header">
      <span class="modal-emoji">🍳</span>
      <h2>Join FoodFusion</h2>
      <p>Create your free account and start sharing recipes!</p>
    </div>
    <form action="<?= $base ?>/pages/register.php" method="POST" class="modal-form">
      <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>"/>
      <div class="form-row">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" placeholder="Jane" required/>
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" placeholder="Smith" required/>
        </div>
      </div>
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="jane@example.com" required/>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Min. 8 characters" minlength="8" required/>
      </div>
      <button type="submit" class="btn btn-primary btn-full">Create Account</button>
      <p class="modal-footer-text">Already have an account? <a href="<?= $base ?>/pages/login.php">Sign in</a></p>
    </form>
  </div>
</div>

<!-- ══ COOKIE BANNER ═════════════════════════════════════== -->
<div class="cookie-banner" id="cookieBanner">
  <div class="cookie-content">
    <span>🍪 We use cookies to enhance your experience. By continuing, you agree to our
      <a href="<?= $base ?>/pages/cookies.php">Cookie Policy</a>.
    </span>
    <div class="cookie-actions">
      <button class="btn btn-outline btn-sm" id="declineCookies">Decline</button>
      <button class="btn btn-primary btn-sm" id="acceptCookies">Accept All</button>
    </div>
  </div>
</div>

<script src="<?= $base ?>/js/main.js"></script>
</body>
</html>
