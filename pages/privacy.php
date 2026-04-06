<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
$pageTitle = 'Privacy Policy – FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Legal</span>
    <h1>Privacy Policy</h1>
    <p>Last updated: 1 January 2025</p>
  </div>
</div>

<div class="policy-content">
  <h2>1. Introduction</h2>
  <p>FoodFusion ("we", "us", or "our") is committed to protecting your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your data when you use our website.</p>

  <h2>2. Information We Collect</h2>
  <p>We may collect the following types of personal data:</p>
  <ul>
    <li><strong>Account data:</strong> first name, last name, email address, and password (stored as a hashed value).</li>
    <li><strong>Usage data:</strong> pages visited, recipes viewed, and interactions with the platform.</li>
    <li><strong>Submitted content:</strong> recipes, messages, and feedback you provide voluntarily.</li>
    <li><strong>Technical data:</strong> IP address, browser type, device identifiers, and cookie data.</li>
  </ul>

  <h2>3. How We Use Your Data</h2>
  <ul>
    <li>To provide and maintain your account and access to our services.</li>
    <li>To respond to your enquiries and contact form submissions.</li>
    <li>To improve our platform based on usage analytics.</li>
    <li>To send transactional communications (e.g. account confirmation).</li>
    <li>To ensure the security and integrity of our systems.</li>
  </ul>

  <h2>4. Data Security</h2>
  <p>We implement industry-standard security measures including:</p>
  <ul>
    <li>Password hashing using bcrypt (PHP <code>password_hash</code>).</li>
    <li>Prepared statements to prevent SQL injection.</li>
    <li>CSRF token validation on all forms.</li>
    <li>Account lockout after three failed login attempts.</li>
  </ul>

  <h2>5. Cookies</h2>
  <p>We use essential cookies to maintain your session and optional analytics cookies. You may accept or decline optional cookies via the cookie banner. For full details see our <a href="/foodfusion/pages/cookies.php" style="color:var(--primary)">Cookie Policy</a>.</p>

  <h2>6. Data Retention</h2>
  <p>We retain your personal data for as long as your account is active or as required to provide services. You may request deletion at any time by contacting us.</p>

  <h2>7. Your Rights</h2>
  <p>Under the UK GDPR and Data Protection Act 2018, you have the right to access, rectify, erase, restrict, and port your data. Contact us at <a href="mailto:privacy@foodfusion.com" style="color:var(--primary)">privacy@foodfusion.com</a> to exercise any right.</p>

  <h2>8. Contact</h2>
  <p>For privacy enquiries: <a href="mailto:privacy@foodfusion.com" style="color:var(--primary)">privacy@foodfusion.com</a></p>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
