<?php
// pages/recipes.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$stmt    = $pdo->query('SELECT * FROM recipes ORDER BY cuisine, difficulty');
$recipes = $stmt->fetchAll();

$pageTitle = 'Recipe Collection - FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">World Kitchen</span>
    <h1>Recipe Collection</h1>
    <p style="max-width:540px;margin:.75rem auto 0">Explore our hand-curated collection of <?= count($recipes) ?> recipes from 10 cuisines, filtered by difficulty and dietary preference.</p>
  </div>
</div>

<section class="section">
  <div class="container">

    <!-- Filter: Cuisine -->
    <div style="margin-bottom:1.5rem">
      <p style="font-weight:600;margin-bottom:.75rem;color:var(--text)">🌍 Filter by Cuisine</p>
      <div class="filter-bar">
        <button class="filter-btn active" data-filter="all"           data-group="cuisine">All Cuisines</button>
        <button class="filter-btn" data-filter="italian"              data-group="cuisine">🇮🇹 Italian</button>
        <button class="filter-btn" data-filter="indian"               data-group="cuisine">🇮🇳 Indian</button>
        <button class="filter-btn" data-filter="american"             data-group="cuisine">🇺🇸 American</button>
        <button class="filter-btn" data-filter="mexican"              data-group="cuisine">🇲🇽 Mexican</button>
        <button class="filter-btn" data-filter="asian"                data-group="cuisine">🥢 Asian</button>
        <button class="filter-btn" data-filter="french"               data-group="cuisine">🇫🇷 French</button>
        <button class="filter-btn" data-filter="japanese"             data-group="cuisine">🇯🇵 Japanese</button>
        <button class="filter-btn" data-filter="mediterranean"        data-group="cuisine">🫒 Mediterranean</button>
        <button class="filter-btn" data-filter="british"              data-group="cuisine">🇬🇧 British</button>
        <button class="filter-btn" data-filter="middle eastern"       data-group="cuisine">🧆 Middle Eastern</button>
      </div>
    </div>

    <!-- Filter: Difficulty -->
    <div style="margin-bottom:2.5rem">
      <p style="font-weight:600;margin-bottom:.75rem;color:var(--text)">⚡ Filter by Difficulty</p>
      <div class="filter-bar">
        <button class="filter-btn active" data-filter="all"    data-group="difficulty">All Levels</button>
        <button class="filter-btn" data-filter="easy"   data-group="difficulty">🟢 Easy</button>
        <button class="filter-btn" data-filter="medium" data-group="difficulty">🟡 Medium</button>
        <button class="filter-btn" data-filter="hard"   data-group="difficulty">🔴 Hard</button>
      </div>
    </div>

    <!-- Results count -->
    <p style="margin-bottom:1.5rem;color:var(--text-muted);font-size:.9rem">
      Showing <strong id="recipeCount" style="color:var(--text)"><?= count($recipes) ?></strong> recipes
    </p>

    <?php if (empty($recipes)): ?>
      <div class="empty-state"><span class="empty-icon">🍽</span><p>No recipes found. Check back soon!</p></div>
    <?php else: ?>
    <div class="grid-3" id="recipeGrid">
      <?php foreach ($recipes as $r): ?>
      <article class="card recipe-item"
        data-cuisine="<?= htmlspecialchars(strtolower($r['cuisine'])) ?>"
        data-difficulty="<?= htmlspecialchars(strtolower($r['difficulty'])) ?>"
        data-diet="<?= htmlspecialchars(strtolower($r['diet'] ?? '')) ?>">
        <?php if ($r['image_url']): ?>
          <img class="card-img" src="<?= htmlspecialchars($r['image_url']) ?>" alt="<?= htmlspecialchars($r['title']) ?>" loading="lazy"/>
        <?php endif; ?>
        <div class="card-body">
          <div class="card-meta">
            <span class="badge badge-cuisine"><?= htmlspecialchars($r['cuisine']) ?></span>
            <span class="badge badge-<?= strtolower($r['difficulty']) ?>"><?= htmlspecialchars($r['difficulty']) ?></span>
            <?php if ($r['diet']): ?><span class="badge badge-vegan"><?= htmlspecialchars($r['diet']) ?></span><?php endif; ?>
          </div>
          <h3 style="margin:.5rem 0 .3rem"><?= htmlspecialchars($r['title']) ?></h3>
          <p style="margin-bottom:.75rem;font-size:.875rem"><?= htmlspecialchars(substr($r['description'], 0, 100)) ?>...</p>

          <!-- Quick meta row -->
          <div style="display:flex;gap:1rem;font-size:.8rem;color:var(--text-muted);margin-bottom:.75rem;flex-wrap:wrap">
            <?php if (!empty($r['prep_time'])): ?>
              <span><i class="fas fa-stopwatch"></i> Prep: <?= htmlspecialchars($r['prep_time']) ?></span>
            <?php endif; ?>
            <?php if (!empty($r['cook_time'])): ?>
              <span><i class="fas fa-fire"></i> Cook: <?= htmlspecialchars($r['cook_time']) ?></span>
            <?php endif; ?>
            <?php if (!empty($r['servings'])): ?>
              <span><i class="fas fa-users"></i> Serves <?= (int)$r['servings'] ?></span>
            <?php endif; ?>
          </div>

          <!-- Ingredients preview -->
          <details style="margin-top:.5rem">
            <summary style="cursor:pointer;font-weight:600;font-size:.875rem;color:var(--primary);user-select:none">
              <i class="fas fa-list"></i> Ingredients
            </summary>
            <ul style="margin-top:.5rem;padding-left:1.25rem;list-style:disc">
              <?php foreach (explode('|', $r['ingredients']) as $ing): ?>
                <li style="font-size:.82rem;color:var(--text-muted);padding:.15rem 0"><?= htmlspecialchars(trim($ing)) ?></li>
              <?php endforeach; ?>
            </ul>
          </details>

          <details style="margin-top:.4rem">
            <summary style="cursor:pointer;font-weight:600;font-size:.875rem;color:var(--accent);user-select:none">
              <i class="fas fa-tasks"></i> Method
            </summary>
            <ol style="margin-top:.5rem;padding-left:1.25rem">
              <?php foreach (explode('|', $r['steps']) as $step): ?>
                <li style="font-size:.82rem;color:var(--text-muted);margin-bottom:.3rem"><?= htmlspecialchars(trim($step)) ?></li>
              <?php endforeach; ?>
            </ol>
          </details>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<script>
// Update visible recipe count when filtering
const allItems = document.querySelectorAll('.recipe-item');
const countEl  = document.getElementById('recipeCount');

// Override the default filter to also update count
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    setTimeout(() => {
      const visible = [...allItems].filter(c => c.style.display !== 'none').length;
      if (countEl) countEl.textContent = visible;
    }, 50);
  });
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
