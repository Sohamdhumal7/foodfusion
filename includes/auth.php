<?php
// includes/auth.php  –  Session helpers
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: /foodfusion/pages/login.php');
        exit;
    }
}

function currentUser(): array {
    return [
        'id'         => $_SESSION['user_id']   ?? null,
        'first_name' => $_SESSION['first_name'] ?? '',
        'last_name'  => $_SESSION['last_name']  ?? '',
        'email'      => $_SESSION['email']      ?? '',
    ];
}

function logout(): void {
    session_unset();
    session_destroy();
    header('Location: /foodfusion/index.php');
    exit;
}

// CSRF helpers
function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
