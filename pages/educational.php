<?php
// pages/educational.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
$pageTitle = 'Educational Resources - FoodFusion';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <span class="section-tag">Educational Resources</span>
    <h1>Learn, Grow &amp; Cook Sustainably</h1>
    <p style="max-width:560px;margin:.75rem auto 0">Downloadable guides, infographics, and videos covering sustainable cooking, nutrition, and renewable energy in the kitchen.</p>
  </div>
</div>

<section class="section">
  <div class="container">

    <!-- ── Sustainable Cooking Articles ──────────────────── -->
    <div style="margin-bottom:2rem">
      <h2 style="margin-bottom:.4rem">🌱 Sustainable Cooking &amp; Renewable Energy</h2>
      <p style="margin-bottom:0">Explore how our food choices and cooking methods impact the environment.</p>
    </div>
    <div class="grid-2" style="margin-bottom:4rem">
      <?php
      $articles = [
        [
          'emoji' => '☀️',
          'title' => 'Solar-Powered Cooking',
          'tag'   => 'Renewable Energy',
          'desc'  => 'Discover how solar ovens and induction cooktops powered by solar panels are transforming sustainable home cooking. Reduce your carbon footprint while preparing delicious meals.',
        ],
        [
          'emoji' => '♻️',
          'title' => 'Zero-Waste Kitchen Guide',
          'tag'   => 'Sustainability',
          'desc'  => 'Learn practical strategies to minimise food waste, compost effectively, and use every part of an ingredient. Includes a 7-day meal plan designed around zero waste principles.',
        ],
        [
          'emoji' => '🌊',
          'title' => 'Sustainable Seafood Handbook',
          'tag'   => 'Ocean Friendly',
          'desc'  => 'A comprehensive guide to choosing sustainable seafood, understanding certifications, and supporting responsible fishing practices around the world.',
        ],
        [
          'emoji' => '🌿',
          'title' => 'Plant-Based Protein Sources',
          'tag'   => 'Nutrition',
          'desc'  => 'Everything you need to know about getting complete protein from plants. Covers legumes, soy, seitan, and complementary proteins with science-backed guidance.',
        ],
        [
          'emoji' => '⚡',
          'title' => 'Energy Efficient Kitchen Appliances',
          'tag'   => 'Renewable Energy',
          'desc'  => 'Compare the energy consumption of different cooking methods from gas hobs to induction and air fryers. Learn which appliances save the most energy and money.',
        ],
        [
          'emoji' => '🧑‍🌾',
          'title' => 'Farm to Fork: Seasonal Eating',
          'tag'   => 'Sustainability',
          'desc'  => 'Why cooking with seasonal, locally sourced produce not only tastes better but significantly reduces food miles and supports local agricultural communities.',
        ],
      ];
      foreach ($articles as $a):
      ?>
      <div class="card" style="padding:0">
        <div class="card-body" style="padding:1.75rem">
          <div class="card-meta" style="margin-bottom:.75rem">
            <span class="badge badge-cuisine"><?= htmlspecialchars($a['tag']) ?></span>
          </div>
          <h3 style="font-size:1.15rem;margin-bottom:.5rem"><?= $a['emoji'] ?> <?= htmlspecialchars($a['title']) ?></h3>
          <p style="font-size:.9rem"><?= htmlspecialchars($a['desc']) ?></p>
          <a href="#" onclick="alert('Full article would open here.')" class="btn btn-sm btn-outline" style="margin-top:1rem">
            Read Article <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- ── Downloadable Infographics ─────────────────────── -->
    <div style="margin-bottom:2rem">
      <h2 style="margin-bottom:.4rem">📊 Downloadable Infographics</h2>
      <p style="margin-bottom:0">Visual resources you can print or share to promote sustainable food choices.</p>
    </div>
    <div class="grid-3" style="margin-bottom:4rem">
      <?php
      $infographics = [
        ['title'=>'Food Carbon Footprint Chart',       'desc'=>'Visual breakdown of carbon emissions per food category.','icon'=>'🌍'],
        ['title'=>'Seasonal Produce Calendar',          'desc'=>'Month-by-month guide to seasonal fruits and vegetables.','icon'=>'📅'],
        ['title'=>'Nutrition at a Glance',              'desc'=>'Essential vitamins, minerals, and their best plant sources.','icon'=>'💊'],
        ['title'=>'Food Waste Facts 2025',              'desc'=>'Key statistics on food waste and practical reduction tips.','icon'=>'🗑️'],
        ['title'=>'Energy-Efficient Cooking Guide',     'desc'=>'Compare energy use of gas, electric, induction and air fry.','icon'=>'⚡'],
        ['title'=>'Composting Basics',                  'desc'=>'What goes in the compost bin and how the process works.','icon'=>'🌱'],
      ];
      foreach ($infographics as $ig):
      ?>
      <div class="resource-card">
        <div class="resource-icon doc" style="background:var(--accent-lt);font-size:1.6rem"><?= $ig['icon'] ?></div>
        <div class="resource-info">
          <h4><?= htmlspecialchars($ig['title']) ?></h4>
          <p><?= htmlspecialchars($ig['desc']) ?></p>
          <a href="#" class="btn btn-sm btn-accent" style="margin-top:.5rem" onclick="alert('Infographic download would start here.')">
            <i class="fas fa-download"></i> Download
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- ── Educational YouTube Videos ───────────────────── -->
    <div style="margin-bottom:2rem">
      <h2 style="margin-bottom:.4rem">🎥 Educational Videos</h2>
      <p style="margin-bottom:0">Watch and learn about sustainable food systems, nutrition, and eco-friendly cooking.</p>
    </div>
    <div class="grid-3" style="margin-bottom:2rem">
      <?php
      $videos = [
        [
          'id'      => 'idUcFEx5cII',
          'title'   => 'Renewable Energy Explained',
          'tag'     => 'Renewable Energy',
          'channel' => 'Technology in pocket',
          'desc'    => 'A broad overview of solar, wind, hydro, biomass, and geothermal energy sources.',
        ],
        [
          'id'      => 'QpIBrAQ8bBs',
          'title'   => 'Food Systems: Data, Digital and Innovation Levers',
          'tag'     => 'Food Systems',
          'channel' => 'World Economic Forum',
          'desc'    => 'Explores how innovation and policy can improve sustainable food systems and food security.',
        ],
        [
          'id'      => 'U2U5KLXg6Tk',
          'title'   => 'Nutrition 101',
          'tag'     => 'Nutrition',
          'channel' => 'DrMichaelVan',
          'desc'    => 'Introduces core nutrition concepts and healthier food choices for everyday eating.',
        ],
        [
          'id'      => 'slYy7oRR35o',
          'title'   => 'How Solar Energy Works | Solar Panels Explained Simply',
          'tag'     => 'Solar Power',
          'channel' => 'Mind Rift',
          'desc'    => 'Explains photovoltaic cells, solar panels, inverters, and how sunlight becomes electricity.',
        ],
        [
          'id'      => 'MsO_QKtAeak',
          'title'   => '8 Steps to an Eco-Friendly Life in the Kitchen & Beyond',
          'tag'     => 'Eco Cooking',
          'channel' => 'TEDx Talks',
          'desc'    => 'Practical ways to cut food waste and make the kitchen more sustainable.',
        ],
        [
          'id'      => 'xEBOep2iiLk',
          'title'   => 'Solar Stove | Sustainable Cooking',
          'tag'     => 'Solar Cooking',
          'channel' => 'Hydro Environment',
          'desc'    => 'A directly relevant example of renewable energy in a kitchen context for FoodFusion.',
        ],
      ];

      foreach ($videos as $v):
        $watchUrl = 'https://www.youtube.com/watch?v=' . rawurlencode($v['id']);
        $embedUrl = 'https://www.youtube-nocookie.com/embed/' . rawurlencode($v['id']) . '?rel=0';
        $thumbnailUrl = 'https://i.ytimg.com/vi/' . rawurlencode($v['id']) . '/hqdefault.jpg';
        $srcdoc = '<style>'
          . '*{padding:0;margin:0;overflow:hidden}'
          . 'html,body{height:100%}'
          . 'body{position:relative;background:#000;font-family:Arial,sans-serif}'
          . 'img{width:100%;height:100%;object-fit:cover}'
          . 'span{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:68px;height:48px;border-radius:14px;background:rgba(204,24,30,.92);color:#fff;font-size:28px;font-weight:700;line-height:48px;text-align:center}'
          . 'p{position:absolute;left:0;right:0;bottom:0;padding:12px 14px;background:linear-gradient(transparent,rgba(0,0,0,.88));color:#fff;font-size:14px;font-weight:600;line-height:1.4}'
          . '</style>'
          . '<a href="' . htmlspecialchars($embedUrl, ENT_QUOTES) . '">'
          . '<img src="' . htmlspecialchars($thumbnailUrl, ENT_QUOTES) . '" alt="' . htmlspecialchars($v['title'], ENT_QUOTES) . '">'
          . '<span>▶</span>'
          . '<p>' . htmlspecialchars($v['title'], ENT_QUOTES) . '</p>'
          . '</a>';
      ?>
      <div class="card video-card">
        <div class="yt-embed-wrap">
          <iframe
            width="100%"
            height="200"
            src="<?= htmlspecialchars($embedUrl) ?>"
            srcdoc="<?= htmlspecialchars($srcdoc, ENT_QUOTES) ?>"
            title="<?= htmlspecialchars($v['title']) ?>"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"
            style="display:block;border-radius:var(--radius-lg) var(--radius-lg) 0 0"
          ></iframe>
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
            <i class="fab fa-youtube"></i> Watch on YouTube
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="alert" style="background:var(--accent-lt);color:var(--accent);border:1px solid var(--border);border-radius:var(--radius);padding:1rem 1.25rem;font-size:.9rem">
      <i class="fas fa-info-circle"></i>
      <strong>Note:</strong> These videos are embedded directly on the page for in-site playback and each card also includes a YouTube link.
      The selection now covers renewable energy, sustainable food systems, nutrition, and eco-friendly cooking to match this page's learning focus.
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
