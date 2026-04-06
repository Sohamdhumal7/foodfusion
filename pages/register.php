<?php
// pages/register.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    header('Location: /foodfusion/index.php');
    exit;
}

$errors  = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Invalid request. Please try again.';
    } else {
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName  = trim($_POST['last_name']  ?? '');
        $email     = trim($_POST['email']      ?? '');
        $password  = $_POST['password']        ?? '';

        // Validate
        if (strlen($firstName) < 2) $errors[] = 'First name must be at least 2 characters.';
        if (strlen($lastName)  < 2) $errors[] = 'Last name must be at least 2 characters.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
        if (strlen($password) < 8)  $errors[] = 'Password must be at least 8 characters.';

        if (empty($errors)) {
            // Check duplicate email
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = 'An account with this email already exists.';
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $stmt = $pdo->prepare(
                    'INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?,?,?,?)'
                );
                $stmt->execute([$firstName, $lastName, $email, $hash]);
                $success = 'Account created! You can now log in.';
            }
        }
    }
}

$pageTitle = 'Create Account – FoodFusion';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?= $pageTitle ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;600&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="stylesheet" href="/foodfusion/css/main.css"/>
</head>
<body>

<main class="auth-page">
  <div class="auth-card">
    <div class="auth-logo">
      <a href="/foodfusion/index.php">🍽 Food<strong>Fusion</strong></a>
    </div>
    <h2>Create Account</h2>
    <p>Join the FoodFusion community today.</p>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
      <a href="/foodfusion/pages/login.php" class="btn btn-primary btn-full">Go to Login</a>
    <?php else: ?>
      <?php foreach ($errors as $e): ?>
        <div class="alert alert-error"><?= htmlspecialchars($e) ?></div>
      <?php endforeach; ?>

      <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>"/>
        <div class="form-row">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" placeholder="Jane" required/>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" placeholder="Smith" required/>
          </div>
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="jane@example.com" required/>
        </div>
        <div class="form-group">
          <label>Password <small style="color:var(--text-muted)">(min. 8 characters)</small></label>
          <input type="password" name="password" placeholder="••••••••" minlength="8" required/>
        </div>
        <button type="submit" class="btn btn-primary btn-full">Create Account</button>
      </form>
    <?php endif; ?>

    <div class="auth-footer">
      Already have an account? <a href="/foodfusion/pages/login.php">Sign in</a>
    </div>
  </div>
</main>

<script src="/foodfusion/js/main.js"></script>
</body>
</html>
