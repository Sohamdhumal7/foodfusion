<?php
// pages/contact.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$message = '';
$msgType = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid request. Please refresh and try again.';
        $msgType = 'error';
    } else {
        $name    = trim($_POST['name']    ?? '');
        $email   = trim($_POST['email']   ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $msg     = trim($_POST['message'] ?? '');

        if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($subject) < 3 || strlen($msg) < 10) {
            $message = 'Please fill in all fields correctly.';
            $msgType = 'error';
        } else {
            $stmt = $pdo->prepare('INSERT INTO contact_messages (name,email,subject,message) VALUES (?,?,?,?)');
            $stmt->execute([$name, $email, $subject, $msg]);
            $message = 'Thank you! Your message has been sent. We will get back to you within 24 hours.';
        }
    }
}

$pageTitle = 'Contact Us – FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Get in Touch</span>
    <h1>Contact Us</h1>
    <p style="max-width:520px;margin:.75rem auto 0">Have a question, feedback, or a recipe request? We would love to hear from you.</p>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="contact-grid">

      <!-- CONTACT INFO -->
      <div>
        <div class="contact-info-card">
          <h3 style="margin-bottom:1.5rem">📬 Get In Touch</h3>
          <div class="contact-item">
            <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <h4>Email</h4>
              <p style="font-size:.875rem">hello@foodfusion.com</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
            <div>
              <h4>Phone</h4>
              <p style="font-size:.875rem">+44 20 1234 5678</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <h4>Address</h4>
              <p style="font-size:.875rem">123 Culinary Lane<br>London, EC1A 1BB<br>United Kingdom</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon"><i class="fas fa-clock"></i></div>
            <div>
              <h4>Hours</h4>
              <p style="font-size:.875rem">Mon–Fri: 9am – 6pm<br>Sat: 10am – 4pm</p>
            </div>
          </div>
        </div>

        <div class="contact-info-card" style="margin-top:1.5rem">
          <h4 style="margin-bottom:1rem">🌐 Follow Us</h4>
          <div style="display:flex;gap:.75rem;flex-wrap:wrap">
            <a href="#" class="btn btn-outline btn-sm"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#" class="btn btn-outline btn-sm"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#" class="btn btn-outline btn-sm"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#" class="btn btn-outline btn-sm"><i class="fab fa-youtube"></i> YouTube</a>
          </div>
        </div>
      </div>

      <!-- FORM -->
      <div class="form-card">
        <h3 style="margin-bottom:1.5rem">✉️ Send a Message</h3>
        <?php if ($message): ?>
          <div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST">
          <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>"/>
          <div class="form-row">
            <div class="form-group">
              <label>Your Name *</label>
              <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" placeholder="Jane Smith" required/>
            </div>
            <div class="form-group">
              <label>Email Address *</label>
              <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="jane@example.com" required/>
            </div>
          </div>
          <div class="form-group">
            <label>Subject *</label>
            <select name="subject">
              <option value="">Select a topic…</option>
              <option>General Enquiry</option>
              <option>Recipe Request</option>
              <option>Technical Support</option>
              <option>Partnership</option>
              <option>Feedback</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>Message *</label>
            <textarea name="message" rows="6" placeholder="Tell us what's on your mind…" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-full">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
