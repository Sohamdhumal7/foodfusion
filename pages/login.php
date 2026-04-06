<?php
// pages/login.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    header('Location: /foodfusion/index.php');
    exit;
}

$error   = '';
$warning = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid request. Please refresh and try again.';
    } else {
        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
            $error = 'Please enter a valid email and password.';
        } else {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user) {
                $error = 'Invalid email or password.';
            } else {
                // Check if account is locked
                if ($user['locked_until'] !== null) {
                    $lockTime = new DateTime($user['locked_until']);
                    $now      = new DateTime();
                    if ($now < $lockTime) {
                        $secsLeft = $lockTime->getTimestamp() - $now->getTimestamp();
                        $warning  = "Account locked due to too many failed attempts. Try again in {$secsLeft} second(s).";
                    } else {
                        // Lock expired — reset
                        $pdo->prepare('UPDATE users SET failed_attempts=0, locked_until=NULL WHERE id=?')
                            ->execute([$user['id']]);
                        $user['failed_attempts'] = 0;
                        $user['locked_until']    = null;
                    }
                }

                if (empty($warning)) {
                    if (password_verify($password, $user['password_hash'])) {
                        // Success — reset failed attempts, start session
                        $pdo->prepare('UPDATE users SET failed_attempts=0, locked_until=NULL WHERE id=?')
                            ->execute([$user['id']]);
                        $_SESSION['user_id']    = $user['id'];
                        $_SESSION['first_name'] = $user['first_name'];
                        $_SESSION['last_name']  = $user['last_name'];
                        $_SESSION['email']      = $user['email'];
                        header('Location: /foodfusion/index.php');
                        exit;
                    } else {
                        // Failed attempt
                        $attempts = $user['failed_attempts'] + 1;
                        if ($attempts >= 3) {
                            // Lock for 3 minutes
                            $lockUntil = (new DateTime('+3 minutes'))->format('Y-m-d H:i:s');
                            $pdo->prepare('UPDATE users SET failed_attempts=?, locked_until=? WHERE id=?')
                                ->execute([$attempts, $lockUntil, $user['id']]);
                            $warning = 'Account locked after 3 failed attempts. Please wait 3 minutes before trying again.';
                        } else {
                            $pdo->prepare('UPDATE users SET failed_attempts=? WHERE id=?')
                                ->execute([$attempts, $user['id']]);
                            $remaining = 3 - $attempts;
                            $error = "Invalid password. {$remaining} attempt(s) remaining before lockout.";
                        }
                    }
                }
            }
        }
    }
}

$pageTitle = 'Sign In – FoodFusion';
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
    <h2>Welcome Back</h2>
    <p>Sign in to your FoodFusion account.</p>

    <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($warning): ?><div class="alert alert-warning"><?= htmlspecialchars($warning) ?></div><?php endif; ?>

    <form method="POST">
      <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>"/>
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="jane@example.com" required autofocus/>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required/>
      </div>
      <button type="submit" class="btn btn-primary btn-full">Sign In</button>
    </form>

    <div class="auth-footer mt-2">
      Don't have an account? <a href="/foodfusion/pages/register.php">Create one free</a>
    </div>
  </div>
</main>

<script src="/foodfusion/js/main.js"></script>
</body>
</html>
