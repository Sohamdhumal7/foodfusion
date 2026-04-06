<?php
// pages/community.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$message = '';
$msgType = 'success';

// Handle recipe submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isLoggedIn()) {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid request. Please try again.';
        $msgType = 'error';
    } else {
        $title       = trim($_POST['title']       ?? '');
        $description = trim($_POST['description'] ?? '');
        $ingredients = trim($_POST['ingredients'] ?? '');
        $steps       = trim($_POST['steps']       ?? '');
        $cuisine     = trim($_POST['cuisine']     ?? '');
        $difficulty  = $_POST['difficulty']       ?? 'Easy';

        $allowed_diff = ['Easy','Medium','Hard'];
        if (!in_array($difficulty, $allowed_diff)) $difficulty = 'Easy';

        if (strlen($title) < 3 || strlen($description) < 10 || empty($ingredients) || empty($steps) || empty($cuisine)) {
            $message = 'Please fill in all required fields correctly.';
            $msgType = 'error';
        } else {
            $user = currentUser();
            $stmt = $pdo->prepare(
                'INSERT INTO community_recipes (user_id, title, description, ingredients, steps, cuisine, difficulty)
                 VALUES (?,?,?,?,?,?,?)'
            );
            $stmt->execute([$user['id'], $title, $description, $ingredients, $steps, $cuisine, $difficulty]);
            $message = 'Your recipe has been shared with the community!';
        }
    }
}

// Fetch all community recipes
$stmt    = $pdo->query(
    'SELECT cr.*, u.first_name, u.last_name FROM community_recipes cr
     JOIN users u ON cr.user_id = u.id
     ORDER BY cr.created_at DESC'
);
$community = $stmt->fetchAll();

$pageTitle = 'Community Cookbook – FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Made by Members</span>
    <h1>Community Cookbook</h1>
    <p style="max-width:560px;margin:.75rem auto 0">A collaborative space where FoodFusion members share their favourite recipes, cooking tips, and culinary stories.</p>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="community-layout">

      <!-- SUBMIT FORM -->
      <div class="community-form-card community-form-sticky">
        <h3 style="margin-bottom:1.5rem">📝 Share Your Recipe</h3>
        <?php if ($message): ?>
          <div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <?php if (!isLoggedIn()): ?>
          <div class="alert alert-warning">
            <i class="fas fa-lock"></i> Please <a href="/foodfusion/pages/login.php" style="color:inherit;font-weight:700">sign in</a> to share a recipe.
          </div>
        <?php else: ?>
        <form method="POST">
          <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>"/>
          <div class="form-group">
            <label>Recipe Title *</label>
            <input type="text" name="title" placeholder="e.g. Grandma's Chicken Soup" required/>
          </div>
          <div class="form-group">
            <label>Description *</label>
            <textarea name="description" rows="2" placeholder="Brief description of your recipe…" required></textarea>
          </div>
          <div class="form-group">
            <label>Ingredients * <small style="color:var(--text-muted)">(separate with | pipe symbol)</small></label>
            <textarea name="ingredients" rows="3" placeholder="Chicken 1kg|Onion 2|Garlic 4 cloves|Salt|Pepper" required></textarea>
          </div>
          <div class="form-group">
            <label>Steps * <small style="color:var(--text-muted)">(separate with | pipe symbol)</small></label>
            <textarea name="steps" rows="3" placeholder="Chop vegetables.|Boil stock.|Add chicken. Cook 30 min." required></textarea>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Cuisine *</label>
              <input type="text" name="cuisine" placeholder="e.g. Italian" required/>
            </div>
            <div class="form-group">
              <label>Difficulty *</label>
              <select name="difficulty">
                <option>Easy</option>
                <option>Medium</option>
                <option>Hard</option>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-full"><i class="fas fa-paper-plane"></i> Share Recipe</button>
        </form>
        <?php endif; ?>
      </div>

      <!-- COMMUNITY RECIPES -->
      <div>
        <h3 style="margin-bottom:1.5rem">🍳 Community Recipes (<?= count($community) ?>)</h3>
        <?php if (empty($community)): ?>
          <div class="empty-state"><span class="empty-icon">📖</span><p>No community recipes yet. Be the first to share!</p></div>
        <?php else: ?>
        <div style="display:flex;flex-direction:column;gap:1.5rem">
          <?php foreach ($community as $r): ?>
          <article class="card">
            <div class="card-body">
              <div class="card-meta">
                <span class="badge badge-cuisine"><?= htmlspecialchars($r['cuisine']) ?></span>
                <span class="badge badge-<?= strtolower($r['difficulty']) ?>"><?= htmlspecialchars($r['difficulty']) ?></span>
              </div>
              <h3 style="margin:.4rem 0"><?= htmlspecialchars($r['title']) ?></h3>
              <p style="font-size:.875rem;margin-bottom:.75rem"><?= htmlspecialchars($r['description']) ?></p>

              <details>
                <summary style="cursor:pointer;font-weight:600;font-size:.875rem;color:var(--primary)"><i class="fas fa-list"></i> Ingredients</summary>
                <ul style="margin-top:.5rem;padding-left:1.25rem;list-style:disc">
                  <?php foreach (explode('|', $r['ingredients']) as $ing): ?>
                    <li style="font-size:.85rem;color:var(--text-muted)"><?= htmlspecialchars(trim($ing)) ?></li>
                  <?php endforeach; ?>
                </ul>
              </details>
              <details style="margin-top:.4rem">
                <summary style="cursor:pointer;font-weight:600;font-size:.875rem;color:var(--accent)"><i class="fas fa-tasks"></i> Steps</summary>
                <ol style="margin-top:.5rem;padding-left:1.25rem">
                  <?php foreach (explode('|', $r['steps']) as $step): ?>
                    <li style="font-size:.85rem;color:var(--text-muted);margin-bottom:.25rem"><?= htmlspecialchars(trim($step)) ?></li>
                  <?php endforeach; ?>
                </ol>
              </details>

              <div class="card-footer">
                <span style="display:flex;align-items:center;gap:.5rem">
                  <span style="width:30px;height:30px;border-radius:50%;background:var(--primary);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;font-weight:700">
                    <?= strtoupper(substr($r['first_name'],0,1)) ?>
                  </span>
                  <?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?>
                </span>
                <span style="font-size:.8rem"><i class="fas fa-clock"></i> <?= date('d M Y', strtotime($r['created_at'])) ?></span>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
