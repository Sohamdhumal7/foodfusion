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
          'id'    => 'If2rE7Sagyw',
          'title' => 'Important Cooking Skills With Gordon Ramsay',
          'tag'   => 'Techniques',
          'channel' => 'Gordon Ramsay',
          'desc' => 'A practical skills lesson covering knife work, herbs, fish prep, and core kitchen technique.',
        ],
        [
          'id'    => 'UYhKDweME3A',
          'title' => 'How To Cook The Perfect Pasta',
          'tag'   => 'Pasta',
          'channel' => 'Gordon Ramsay',
          'desc' => 'A focused pasta tutorial with practical tips for timing, texture, and getting a better result every time.',
        ],
        [
          'id'    => 'ZJy1ajvMU1k',
          'title' => 'How To Master 5 Basic Cooking Skills',
          'tag'   => 'Basics',
          'channel' => 'Gordon Ramsay',
          'desc' => 'A beginner-friendly roundup of foundational kitchen skills including pasta, rice, onions, knives, and fish.',
        ],
        [
          'id'    => 'hmCr5b_dnxk',
          'title' => 'How to Make Sushi At Home',
          'tag'   => 'Japanese',
          'channel' => 'Ryan Panico',
          'desc' => 'A home sushi guide covering rice prep, salmon prep, rolls, nigiri, and simple assembly.',
        ],
        [
          'id'    => '8ElZIUqegTg',
          'title' => 'How to Cook the Perfect Steak',
          'tag'   => 'Steak',
          'channel' => 'Luís Andrade',
          'desc' => 'A steak-cooking lesson focused on heat, searing, timing, and building a strong crust.',
        ],
        [
          'id'    => 'VkOtF4hjZkM',
          'title' => 'Cooking With Spice',
          'tag'   => 'Flavour',
          'channel' => 'Gordon Ramsay',
          'desc' => 'A flavour-focused tutorial on using spices with more confidence and balance in everyday cooking.',
        ],
      ];
      foreach ($videos as $v):
        $watchUrl = 'https://www.youtube.com/watch?v=' . rawurlencode($v['id']);
        $embedUrl = 'https://www.youtube-nocookie.com/embed/' . rawurlencode($v['id']) . '?rel=0';
        $thumbnailUrl = 'https://i.ytimg.com/vi/' . rawurlencode($v['id']) . '/hqdefault.jpg';
      ?>
      <div class="card video-card">
        <div class="yt-embed-wrap">
          <button
            type="button"
            class="video-preview js-video-preview"
            data-embed-url="<?= htmlspecialchars($embedUrl) ?>"
            data-title="<?= htmlspecialchars($v['title']) ?>"
            aria-label="Play <?= htmlspecialchars($v['title']) ?>"
          >
            <img
              src="<?= htmlspecialchars($thumbnailUrl) ?>"
              alt="<?= htmlspecialchars($v['title']) ?>"
              class="video-preview-image"
              loading="lazy"
              onerror="this.style.display='none'; this.nextElementSibling.hidden = false;"
            />
            <div class="video-preview-fallback" hidden>
              <span class="video-preview-chip"><?= htmlspecialchars($v['tag']) ?></span>
              <strong><?= htmlspecialchars($v['title']) ?></strong>
            </div>
            <span class="video-preview-play" aria-hidden="true"><i class="fas fa-play"></i></span>
          </button>
        </div>
        <div class="card-body" style="padding:1rem 1.25rem">
          <span class="badge badge-cuisine" style="margin-bottom:.4rem"><?= htmlspecialchars($v['tag']) ?></span>
          <h4 style="font-size:.95rem;line-height:1.4;margin-bottom:.45rem"><?= htmlspecialchars($v['title']) ?></h4>
          <p style="font-size:.85rem;margin-bottom:.35rem"><?= htmlspecialchars($v['desc']) ?></p>
          <p style="font-size:.8rem;color:var(--text-muted);margin-bottom:.85rem">Channel: <?= htmlspecialchars($v['channel']) ?></p>
          <a
            href="<?= htmlspecialchars($watchUrl) ?>"
            class="btn btn-sm btn-outline"
            target="_blank"
            rel="noopener noreferrer"
          >
            <i class="fab fa-youtube"></i> Open on YouTube
          </a>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.js-video-preview').forEach(function (preview) {
    preview.addEventListener('click', function () {
      var embedUrl = preview.getAttribute('data-embed-url');
      var title = preview.getAttribute('data-title') || 'Embedded YouTube video';
      var wrap = preview.closest('.yt-embed-wrap');

      if (!embedUrl || !wrap || wrap.querySelector('iframe')) {
        return;
      }

      var iframe = document.createElement('iframe');
      iframe.src = embedUrl + (embedUrl.indexOf('?') !== -1 ? '&' : '?') + 'autoplay=1';
      iframe.title = title;
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      iframe.allowFullscreen = true;
      iframe.loading = 'eager';
      iframe.referrerPolicy = 'strict-origin-when-cross-origin';
      iframe.style.display = 'block';
      iframe.style.borderRadius = 'var(--radius-lg) var(--radius-lg) 0 0';

      wrap.innerHTML = '';
      wrap.appendChild(iframe);
    });
  });
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
