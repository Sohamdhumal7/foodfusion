<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
$pageTitle = 'Cookie Policy – FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Legal</span>
    <h1>Cookie Policy</h1>
    <p>Last updated: 1 January 2025</p>
  </div>
</div>

<div class="policy-content">
  <h2>1. What Are Cookies?</h2>
  <p>Cookies are small text files placed on your device when you visit a website. They help the site remember your preferences and improve your experience.</p>

  <h2>2. Types of Cookies We Use</h2>

  <h3>Essential Cookies</h3>
  <p>These cookies are strictly necessary for the website to function and cannot be disabled.</p>
  <ul>
    <li><strong>PHPSESSID</strong> – Maintains your login session while you browse the site. Expires when you close your browser.</li>
    <li><strong>ff-cookies</strong> – Stores your cookie consent preference (localStorage). Persists for 1 year.</li>
    <li><strong>ff-theme</strong> – Stores your light/dark mode preference (localStorage). Persists indefinitely until cleared.</li>
  </ul>

  <h3>Analytics Cookies (Optional)</h3>
  <p>If you accept optional cookies, we may use analytics tools to understand how visitors interact with our platform. This helps us improve content and usability. No personally identifiable information is collected through analytics.</p>

  <h2>3. Managing Cookies</h2>
  <p>You can control cookies through:</p>
  <ul>
    <li><strong>Cookie Banner:</strong> Use the Accept / Decline buttons on our cookie consent banner when you first visit.</li>
    <li><strong>Browser Settings:</strong> Most browsers allow you to block or delete cookies via their settings menu.</li>
    <li><strong>Clearing localStorage:</strong> Open your browser's Developer Tools → Application → Local Storage → clear FoodFusion entries.</li>
  </ul>
  <p>Please note that disabling essential cookies will affect the functionality of the site, including the ability to stay logged in.</p>

  <h2>4. Third-Party Cookies</h2>
  <p>We embed content from Google Fonts and FontAwesome CDN which may set their own cookies. Please refer to their respective privacy policies for details.</p>

  <h2>5. Changes to This Policy</h2>
  <p>We may update this Cookie Policy from time to time. Changes will be posted on this page with a revised date.</p>

  <h2>6. Contact</h2>
  <p>For any questions about our use of cookies: <a href="mailto:privacy@foodfusion.com" style="color:var(--primary)">privacy@foodfusion.com</a></p>

  <div style="margin-top:2rem;padding:1.5rem;background:var(--primary-lt);border-radius:var(--radius);border:1px solid var(--border)">
    <h4 style="margin-bottom:.5rem">🍪 Your Current Preference</h4>
    <p id="cookieStatus" style="margin-bottom:.75rem;font-size:.9rem">Checking…</p>
    <button class="btn btn-sm btn-outline" onclick="resetCookiePreference()">Reset Cookie Preference</button>
  </div>
</div>

<script>
  const status = localStorage.getItem('ff-cookies');
  document.getElementById('cookieStatus').textContent =
    status === 'accepted' ? '✅ You have accepted optional cookies.' :
    status === 'declined' ? '❌ You have declined optional cookies.' :
    '⚠️ No cookie preference has been set yet.';

  function resetCookiePreference() {
    localStorage.removeItem('ff-cookies');
    document.getElementById('cookieStatus').textContent = '⚠️ Preference cleared. Reload the page to see the cookie banner again.';
  }
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
