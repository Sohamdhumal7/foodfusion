<?php
// index.php  –  FoodFusion Homepage
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

// Fetch 12 featured recipes
$stmt    = $pdo->query('SELECT * FROM recipes ORDER BY id DESC LIMIT 12');
$recipes = $stmt->fetchAll();

$pageTitle = 'FoodFusion – Home of Culinary Creativity';
require_once __DIR__ . '/includes/header.php';
?>

<!-- ══ HERO ═══════════════════════════════════════════════ -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="container">
    <div class="hero-content">
      <span class="hero-tag">✨ Your Culinary Community</span>
      <h1>Cook, Share &amp; <em>Explore</em> the World's Flavours</h1>
      <p class="hero-desc">FoodFusion brings passionate home cooks together. Discover thousands of recipes, share your creations, and join a community that lives to eat well.</p>
      <div class="hero-btns">
        <a href="/foodfusion/pages/recipes.php" class="btn btn-primary btn-lg">
          <i class="fas fa-utensils"></i> Browse Recipes
        </a>
        <?php if (!isLoggedIn()): ?>
        <button type="button" class="btn btn-outline btn-lg js-open-join-modal" style="color:#fff;border-color:rgba(255,255,255,.35)">
          <i class="fas fa-user-plus"></i> Join for Free
        </button>
        <?php else: ?>
        <a href="/foodfusion/pages/community.php" class="btn btn-outline btn-lg" style="color:#fff;border-color:rgba(255,255,255,.35)">
          <i class="fas fa-book-open"></i> Community Cookbook
        </a>
        <?php endif; ?>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><div class="stat-num">1,200+</div><div class="stat-label">Recipes</div></div>
        <div class="hero-stat"><div class="stat-num">8,500+</div><div class="stat-label">Members</div></div>
        <div class="hero-stat"><div class="stat-num">45+</div><div class="stat-label">Cuisines</div></div>
        <div class="hero-stat"><div class="stat-num">4.9★</div><div class="stat-label">Rated</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ══ FEATURES STRIP ═════════════════════════════════════ -->
<section class="features-strip section" style="padding:3rem 0">
  <div class="container">
    <div class="grid-4">
      <div class="feature-item">
        <span class="feature-icon">🌍</span>
        <h4>Global Cuisines</h4>
        <p>Explore recipes from 45+ countries and culinary traditions.</p>
      </div>
      <div class="feature-item">
        <span class="feature-icon">👩‍🍳</span>
        <h4>Expert Guides</h4>
        <p>Step-by-step tutorials from professional home chefs.</p>
      </div>
      <div class="feature-item">
        <span class="feature-icon">📖</span>
        <h4>Community Cookbook</h4>
        <p>Share your favourite recipes with fellow food lovers.</p>
      </div>
      <div class="feature-item">
        <span class="feature-icon">🎓</span>
        <h4>Culinary Learning</h4>
        <p>Downloadable resources, videos, and cooking hacks.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ CAROUSEL – UPCOMING EVENTS ═════════════════════════ -->
<section class="section carousel-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Live &amp; Upcoming</span>
      <h2>Cooking Events &amp; Trends</h2>
      <p>Join our live cooking sessions, seasonal challenges, and featured recipe showcases.</p>
    </div>

    <div class="carousel-wrap">
      <div class="carousel-track">

        <div class="carousel-slide">
          <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200" alt="Summer Grill Fest"/>
          <div class="carousel-caption">
            <span class="badge badge-cuisine">🔥 Event — 15 July</span>
            <h3>Summer Grill Fest 2025</h3>
            <p>Join 500+ members for our biggest outdoor cook-off yet.</p>
          </div>
        </div>

        <div class="carousel-slide">
          <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200" alt="Italian Week"/>
          <div class="carousel-caption">
            <span class="badge badge-cuisine">🇮🇹 Featured Cuisine</span>
            <h3>Italian Kitchen Week</h3>
            <p>Pasta, pizza, risotto — a full week celebrating la cucina italiana.</p>
          </div>
        </div>

        <div class="carousel-slide">
          <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=1200" alt="Bake Off"/>
          <div class="carousel-caption">
            <span class="badge badge-cuisine">🧁 Community Challenge</span>
            <h3>FoodFusion Bake Off</h3>
            <p>Submit your best bake for a chance to be featured on our homepage.</p>
          </div>
        </div>

        <div class="carousel-slide">
          <img src="https://images.unsplash.com/photo-1543339308-43e59d6b73a6?w=1200" alt="Vegan Month"/>
          <div class="carousel-caption">
            <span class="badge badge-vegan">🌱 Vegan Month</span>
            <h3>Plant-Based Recipe Showcase</h3>
            <p>Discover 200+ incredible vegan recipes added by our community.</p>
          </div>
        </div>

      </div>
      <button class="carousel-btn carousel-prev"><i class="fas fa-chevron-left"></i></button>
      <button class="carousel-btn carousel-next"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="carousel-dots">
      <div class="carousel-dot active"></div>
      <div class="carousel-dot"></div>
      <div class="carousel-dot"></div>
      <div class="carousel-dot"></div>
    </div>
  </div>
</section>

<!-- ══ FEATURED RECIPES ════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Hand-Picked</span>
      <h2>Featured Recipes</h2>
      <p>Our curated selection of crowd-pleasing dishes from cuisines around the world.</p>
    </div>

    <?php if (empty($recipes)): ?>
      <div class="empty-state"><span class="empty-icon">🍽</span><p>No recipes yet. Check back soon!</p></div>
    <?php else: ?>
    <div class="grid-3">
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
          <h3><?= htmlspecialchars($r['title']) ?></h3>
          <p><?= htmlspecialchars(substr($r['description'], 0, 100)) ?>…</p>
          <div class="card-footer">
            <span>
              <?php if ($r['cook_time']): ?>
                <i class="fas fa-clock"></i> <?= htmlspecialchars($r['cook_time']) ?>
              <?php else: ?>
                <i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($r['created_at'])) ?>
              <?php endif; ?>
            </span>
            <?php if (!empty($r['servings'])): ?>
              <span><i class="fas fa-users"></i> Serves <?= (int)$r['servings'] ?></span>
            <?php endif; ?>
            <a href="/foodfusion/pages/recipes.php" class="btn btn-sm btn-outline">View Recipe</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="text-center mt-3">
      <a href="/foodfusion/pages/recipes.php" class="btn btn-primary btn-lg">View All Recipes <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ══ NEWS FEED / CULINARY TRENDS ════════════════════════ -->
<section class="section" style="background:var(--bg-alt)">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Latest News</span>
      <h2>Culinary Trends &amp; Tips</h2>
      <p>Stay up to date with what's hot in the food world.</p>
    </div>
    <div class="grid-3">
      <?php
      $news = [
        ['icon'=>'🌮','title'=>'Street Food Goes Gourmet','date'=>'12 Jun 2025','excerpt'=>'From tacos to baos, street food is finding its way into Michelin-starred kitchens worldwide.','tag'=>'Trends'],
        ['icon'=>'🫙','title'=>'The Fermentation Revival','date'=>'5 Jun 2025','excerpt'=>'Kimchi, kefir, kombucha – find out why fermented foods are dominating home kitchens in 2025.','tag'=>'Techniques'],
        ['icon'=>'🥗','title'=>'Seasonal Eating Made Easy','date'=>'1 Jun 2025','excerpt'=>'Why cooking with seasonal produce not only tastes better but is better for the planet.','tag'=>'Tips'],
      ];
      foreach ($news as $n): ?>
      <article class="card">
        <div class="card-body">
          <div class="card-meta">
            <span class="badge badge-cuisine"><?= $n['tag'] ?></span>
          </div>
          <h3 style="font-size:1.05rem"><?= $n['icon'] ?> <?= $n['title'] ?></h3>
          <p style="margin-top:.5rem"><?= $n['excerpt'] ?></p>
          <div class="card-footer">
            <span><i class="fas fa-clock"></i> <?= $n['date'] ?></span>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ CTA ════════════════════════════════════════════════ -->
<?php if (!isLoggedIn()): ?>
<section class="section" style="text-align:center;background:linear-gradient(135deg,var(--primary) 0%,var(--primary-dk) 100%);color:#fff">
  <div class="container">
    <h2 style="color:#fff">Ready to Start Cooking?</h2>
    <p style="color:rgba(255,255,255,.8);max-width:480px;margin:.75rem auto 2rem">Join thousands of food enthusiasts sharing recipes, tips, and culinary adventures.</p>
    <button type="button" class="btn btn-lg js-open-join-modal" style="background:#fff;color:var(--primary);font-weight:700">
      <i class="fas fa-user-plus"></i> Sign Up Now — It's Free!
    </button>
  </div>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
