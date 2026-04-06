<?php
// pages/resources.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
$pageTitle = 'Culinary Resources - FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Culinary Resources</span>
    <h1>Level Up Your Cooking</h1>
    <p style="max-width:540px;margin:.75rem auto 0">Download recipe cards, watch real cooking tutorials on YouTube, and access instructional guides on techniques and kitchen hacks.</p>
  </div>
</div>

<section class="section">
  <div class="container">

    <!-- ── Downloadable Recipe Cards ─────────────────────── -->
    <div style="margin-bottom:1rem">
      <h2 style="margin-bottom:.4rem">📄 Downloadable Recipe Cards</h2>
      <p style="margin-bottom:2rem">Printable recipe cards - click Download PDF to get a formatted recipe card in your browser.</p>
    </div>
    <div class="grid-2" style="margin-bottom:4rem">
      <?php
      $pdfs = [
        [
          'title'   => 'Classic Italian Collection',
          'desc'    => '10 authentic Italian recipes including carbonara, risotto and tiramisu.',
          'size'    => '2.4 MB',
          'pages'   => '18 pages',
          'recipes' => ['Spaghetti Carbonara','Margherita Pizza','Mushroom Risotto','Classic Tiramisu','Osso Buco','Bruschetta','Gnocchi al Pesto','Lasagne','Ribollita','Panna Cotta'],
        ],
        [
          'title'   => 'Quick 30-Minute Meals',
          'desc'    => '20 weeknight recipes that come together in 30 minutes or less.',
          'size'    => '1.8 MB',
          'pages'   => '24 pages',
          'recipes' => ['Avocado Toast','Chicken Fried Rice','Vegetable Stir Fry','Beef Tacos','Shakshuka','Pad Thai','Greek Salad','Creamy Hummus','Omelette Arnold Bennett','Prawn Linguine'],
        ],
        [
          'title'   => 'Vegetarian and Vegan Favourites',
          'desc'    => '25 plant-based recipes packed with flavour and nutrition.',
          'size'    => '3.1 MB',
          'pages'   => '32 pages',
          'recipes' => ['Dal Tadka','Vegetable Stir Fry','Greek Salad','Shakshuka','Creamy Hummus','Mushroom Risotto','Margherita Pizza','Ratatouille','Falafel','Veggie Burger'],
        ],
        [
          'title'   => 'Baking Fundamentals',
          'desc'    => 'Master the art of baking with foundational sweet and savoury recipes.',
          'size'    => '2.9 MB',
          'pages'   => '28 pages',
          'recipes' => ['New York Cheesecake','Chocolate Lava Cake','Classic Tiramisu','Banana Bread','Sourdough Loaf','Croissants','Victoria Sponge','Shortbread','Focaccia','Cinnamon Rolls'],
        ],
      ];
      foreach ($pdfs as $idx => $p):
        $pdfId = $idx + 1;
      ?>
      <div class="resource-card">
        <div class="resource-icon pdf">📋</div>
        <div class="resource-info">
          <h4><?= htmlspecialchars($p['title']) ?></h4>
          <p><?= htmlspecialchars($p['desc']) ?></p>
          <small style="color:var(--text-muted);display:block;margin-bottom:.75rem"><?= $p['size'] ?> &middot; <?= $p['pages'] ?></small>
          <a href="/foodfusion/pages/download_pdf.php?id=<?= $pdfId ?>" target="_blank" class="btn btn-sm btn-primary">
            <i class="fas fa-download"></i> Download PDF
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- ── Cooking Tutorials ──────────────────────────────── -->
    <div style="margin-bottom:2rem">
      <h2 style="margin-bottom:.4rem">🎓 Cooking Tutorials</h2>
      <p style="margin-bottom:2rem">Step-by-step guides to mastering essential techniques.</p>
    </div>
    <div class="grid-3" style="margin-bottom:4rem">
      <?php
      $tutorials = [
        ['emoji'=>'🔪','title'=>'Knife Skills Masterclass','level'=>'Beginner','duration'=>'45 min','desc'=>'Learn essential cuts: julienne, chiffonade, brunoise and more.'],
        ['emoji'=>'🥩','title'=>'Perfecting Your Sear','level'=>'Intermediate','duration'=>'30 min','desc'=>'Get a restaurant-quality crust on meat every single time.'],
        ['emoji'=>'🧁','title'=>'Pastry and Dough Basics','level'=>'Beginner','duration'=>'60 min','desc'=>'Shortcrust, puff, and choux pastry explained simply.'],
        ['emoji'=>'🍜','title'=>'Homemade Pasta from Scratch','level'=>'Intermediate','duration'=>'50 min','desc'=>'Fresh tagliatelle, fettuccine, and gnocchi using simple ingredients.'],
        ['emoji'=>'🫕','title'=>'Building Flavour with Stocks','level'=>'Advanced','duration'=>'90 min','desc'=>'Master chicken stock, bechamel, hollandaise and demi-glace.'],
        ['emoji'=>'🌶','title'=>'Spice Blending and Seasoning','level'=>'Beginner','duration'=>'25 min','desc'=>'Understand how to build and balance flavour profiles perfectly.'],
      ];
      foreach ($tutorials as $t):
      ?>
      <div class="card resource-card" style="flex-direction:column;padding:1.5rem">
        <div style="font-size:2.5rem;margin-bottom:.75rem"><?= $t['emoji'] ?></div>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:.5rem">
          <span class="badge badge-cuisine"><?= htmlspecialchars($t['level']) ?></span>
          <span class="badge" style="background:var(--bg-alt)"><i class="fas fa-clock"></i> <?= htmlspecialchars($t['duration']) ?></span>
        </div>
        <h4 style="margin-bottom:.4rem"><?= htmlspecialchars($t['title']) ?></h4>
        <p style="font-size:.875rem;flex:1"><?= htmlspecialchars($t['desc']) ?></p>
        <a href="#videoSection" class="btn btn-sm btn-outline" style="margin-top:1rem">
          <i class="fas fa-play-circle"></i> Watch Tutorial
        </a>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- ── YouTube Videos ────────────────────────────────── -->
    <div id="videoSection" style="margin-bottom:2rem">
      <h2 style="margin-bottom:.4rem">🎥 Instructional Videos</h2>
      <p style="margin-bottom:2rem">Real YouTube cooking tutorials - watch directly in the page.</p>
    </div>
    <div class="grid-3" style="margin-bottom:2rem">
      <?php
      /*
       * Real YouTube video IDs for cooking tutorials
       * These are publicly available cooking education videos
       */
      $videos = [
        [
          'id'    => '_JvnVbGDoeI',
          'title' => 'Gordon Ramsay: Knife Skills Masterclass',
          'tag'   => 'Techniques',
        ],
        [
          'id'    => 'ql8oMMEQVAQ',
          'title' => 'How to Make Perfect Pasta Every Time',
          'tag'   => 'Italian',
        ],
        [
          'id'    => 'pBQjByBDOio',
          'title' => '10 Essential Kitchen Hacks You Need to Know',
          'tag'   => 'Kitchen Tips',
        ],
        [
          'id'    => 'ZJy1ajvMU1k',
          'title' => 'How to Make Sushi at Home - Beginner Guide',
          'tag'   => 'Japanese',
        ],
        [
          'id'    => 'UPBQHcHGjQM',
          'title' => 'French Mother Sauces Explained',
          'tag'   => 'French',
        ],
        [
          'id'    => 'M3fAkciISGc',
          'title' => 'Spice 101: Building Flavour in Indian Cooking',
          'tag'   => 'Indian',
        ],
      ];
      foreach ($videos as $v):
      ?>
      <div class="card video-card">
        <div class="yt-embed-wrap">
          <iframe
            width="100%"
            height="200"
            src="https://www.youtube.com/embed/<?= htmlspecialchars($v['id']) ?>?rel=0"
            title="<?= htmlspecialchars($v['title']) ?>"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
            style="display:block;border-radius:var(--radius-lg) var(--radius-lg) 0 0"
          ></iframe>
        </div>
        <div class="card-body" style="padding:1rem 1.25rem">
          <span class="badge badge-cuisine" style="margin-bottom:.4rem"><?= htmlspecialchars($v['tag']) ?></span>
          <h4 style="font-size:.95rem;line-height:1.4"><?= htmlspecialchars($v['title']) ?></h4>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="alert" style="background:var(--accent-lt);color:var(--accent);border:1px solid var(--border);border-radius:var(--radius);padding:1rem 1.25rem;font-size:.9rem">
      <i class="fas fa-info-circle"></i>
      <strong>Note:</strong> Videos are embedded from YouTube. An internet connection is required to play them.
      If a video is unavailable in your region, it may not display - this is a YouTube restriction and not a site error.
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
