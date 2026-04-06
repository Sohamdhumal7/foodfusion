<?php
// pages/about.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
$pageTitle = 'About Us – FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Our Story</span>
    <h1>About FoodFusion</h1>
    <p style="max-width:580px;margin:.75rem auto 0">We are a passionate community dedicated to celebrating food, culture, and the joy of cooking.</p>
  </div>
</div>

<!-- ── MISSION ────────────────────────────────────────── -->
<section class="section">
  <div class="container">
    <div class="grid-2" style="align-items:center;gap:4rem">
      <div>
        <span class="section-tag">Our Mission</span>
        <h2>Bringing the World to Your Kitchen</h2>
        <p style="margin:1rem 0">FoodFusion was founded on a simple belief: food is the most universal language. Whether you are a curious beginner or a seasoned home chef, our platform provides the tools, inspiration, and community to elevate your cooking journey.</p>
        <p>We curate recipes from over 45 cuisines, host live cooking events, and provide downloadable resources to help you master new techniques at your own pace.</p>
        <div style="display:flex;gap:1.5rem;margin-top:2rem;flex-wrap:wrap">
          <div style="text-align:center">
            <div style="font-family:var(--ff-display);font-size:2rem;font-weight:900;color:var(--primary)">2019</div>
            <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">Founded</div>
          </div>
          <div style="text-align:center">
            <div style="font-family:var(--ff-display);font-size:2rem;font-weight:900;color:var(--primary)">45+</div>
            <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">Cuisines</div>
          </div>
          <div style="text-align:center">
            <div style="font-family:var(--ff-display);font-size:2rem;font-weight:900;color:var(--primary)">1,200+</div>
            <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">Recipes</div>
          </div>
        </div>
      </div>
      <div>
        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700" alt="Our kitchen" style="border-radius:var(--radius-lg);width:100%;height:400px;object-fit:cover;box-shadow:var(--shadow-lg)"/>
      </div>
    </div>
  </div>
</section>

<!-- ── VALUES ─────────────────────────────────────────── -->
<section class="section features-strip">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">What We Stand For</span>
      <h2>Our Culinary Philosophy</h2>
    </div>
    <div class="grid-3">
      <div class="feature-item card" style="padding:2rem">
        <span class="feature-icon">🌱</span>
        <h4>Sustainability</h4>
        <p>We champion seasonal, local produce and sustainable cooking practices that are good for people and the planet.</p>
      </div>
      <div class="feature-item card" style="padding:2rem">
        <span class="feature-icon">🤝</span>
        <h4>Inclusivity</h4>
        <p>Food knows no borders. We celebrate diversity in every recipe and welcome cooks of every skill level and background.</p>
      </div>
      <div class="feature-item card" style="padding:2rem">
        <span class="feature-icon">💡</span>
        <h4>Innovation</h4>
        <p>From fusion cooking to modern techniques, we encourage creativity and experimentation in the kitchen.</p>
      </div>
      <div class="feature-item card" style="padding:2rem">
        <span class="feature-icon">📚</span>
        <h4>Education</h4>
        <p>We believe in lifelong learning. Our resources are designed to continuously improve your cooking skills.</p>
      </div>
      <div class="feature-item card" style="padding:2rem">
        <span class="feature-icon">❤️</span>
        <h4>Community</h4>
        <p>Cooking is more fun together. We foster genuine connections between food lovers across the globe.</p>
      </div>
      <div class="feature-item card" style="padding:2rem">
        <span class="feature-icon">⭐</span>
        <h4>Quality</h4>
        <p>Every recipe is tested and reviewed. We maintain the highest standards so you can cook with confidence.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── TEAM ───────────────────────────────────────────── -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">The People Behind the Platform</span>
      <h2>Meet Our Team</h2>
      <p>A dedicated group of food lovers, technologists, and storytellers.</p>
    </div>
    <div class="grid-4">
      <?php
      $team = [
        ['initials'=>'SL','name'=>'Sophie Laurent','role'=>'Founder & Head Chef','bio'=>'Le Cordon Bleu graduate with 15 years of professional kitchen experience.'],
        ['initials'=>'MO','name'=>'Marcus Osei','role'=>'Recipe Director','bio'=>'Specialises in West African and fusion cuisine. Author of two cookbooks.'],
        ['initials'=>'AP','name'=>'Aisha Patel','role'=>'Community Manager','bio'=>'Builds and nurtures our vibrant food community across all platforms.'],
        ['initials'=>'TW','name'=>'Tom Wilson','role'=>'Lead Developer','bio'=>'Full-stack developer passionate about building tools for creative people.'],
      ];
      foreach ($team as $m): ?>
      <div class="team-card">
        <div class="team-avatar placeholder"><?= $m['initials'] ?></div>
        <div class="team-role"><?= $m['role'] ?></div>
        <h4 style="margin:.4rem 0"><?= $m['name'] ?></h4>
        <p style="font-size:.875rem"><?= $m['bio'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
