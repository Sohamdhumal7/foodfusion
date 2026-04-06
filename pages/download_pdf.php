<?php
// pages/download_pdf.php
// Generates a real downloadable PDF recipe card using pure PHP (no extra libraries needed)
// Uses HTML-to-browser-print approach that works in all XAMPP installations

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$id = intval($_GET['id'] ?? 1);

$collections = [
  1 => [
    'title'  => 'Classic Italian Collection',
    'colour' => '#c8522a',
    'icon'   => '🇮🇹',
    'intro'  => 'A celebration of authentic Italian home cooking. These recipes have been passed down through generations of Italian families and adapted for the modern kitchen.',
    'recipes'=> [
      [
        'name'        => 'Spaghetti Carbonara',
        'time'        => '35 minutes | Serves 4 | Difficulty: Medium',
        'desc'        => 'Classic Roman pasta with silky egg sauce, crispy pancetta and generous black pepper.',
        'ingredients' => ['Spaghetti 400g','Pancetta 150g','Eggs 4 large','Pecorino Romano 100g','Parmesan 50g','Black pepper (lots)','Salt'],
        'steps'       => ['Boil a large pot of well-salted water.','Cook spaghetti until al dente. Reserve 1 cup pasta water before draining.','Fry pancetta in a dry pan until crispy. Remove from heat.','In a bowl whisk eggs with grated cheese and lots of black pepper.','Combine hot pasta with pancetta in the pan (off heat).','Pour egg mixture over, tossing quickly. Add pasta water to create a creamy sauce.','Serve immediately with extra grated cheese.'],
      ],
      [
        'name'        => 'Margherita Pizza',
        'time'        => '40 minutes | Serves 2 | Difficulty: Medium',
        'desc'        => 'Authentic Neapolitan pizza with fresh tomato sauce, buffalo mozzarella and basil.',
        'ingredients' => ['Pizza dough 500g','San Marzano tomatoes 400g','Buffalo mozzarella 250g','Fresh basil','Olive oil','Salt','Garlic 2 cloves'],
        'steps'       => ['Preheat oven to maximum temperature (250C+).','Stretch dough into a thin 30cm circle on a floured surface.','Crush tomatoes with garlic and a pinch of salt for the sauce.','Spread sauce thinly over dough leaving a 2cm border.','Tear mozzarella and distribute evenly.','Bake 8-10 minutes until crust is blistered.','Top with fresh basil and a drizzle of olive oil before serving.'],
      ],
      [
        'name'        => 'Mushroom Risotto',
        'time'        => '35 minutes | Serves 4 | Difficulty: Hard',
        'desc'        => 'Creamy Arborio rice with porcini and chestnut mushrooms, white wine and parmesan.',
        'ingredients' => ['Arborio rice 320g','Mixed mushrooms 400g','Onion 1','Garlic 3 cloves','White wine 150ml','Vegetable stock 1.2L (hot)','Parmesan 80g','Butter 50g','Olive oil','Thyme sprigs','Salt and pepper'],
        'steps'       => ['Keep stock hot in a separate pan throughout cooking.','Saute onion and garlic in olive oil until translucent.','Add mushrooms with thyme and cook 5 minutes.','Add rice and toast stirring for 2 minutes.','Pour in wine and stir until fully absorbed.','Add stock one ladle at a time, stirring constantly. Repeat for 18 minutes.','Remove from heat. Stir in cold butter and parmesan. Rest 2 minutes. Serve.'],
      ],
    ],
  ],
  2 => [
    'title'  => 'Quick 30-Minute Meals',
    'colour' => '#2a7a5e',
    'icon'   => '⚡',
    'intro'  => 'Delicious, satisfying meals that come together in 30 minutes or less. Perfect for busy weeknights when you want something homemade without the long cook time.',
    'recipes'=> [
      [
        'name'        => 'Avocado Toast',
        'time'        => '10 minutes | Serves 2 | Difficulty: Easy',
        'desc'        => 'Sourdough toast loaded with smashed avocado, poached egg and chilli flakes.',
        'ingredients' => ['Sourdough bread 4 slices','Ripe avocados 3','Eggs 4','Lemon 1','Chilli flakes','Salt and pepper','Olive oil','Everything bagel seasoning (optional)'],
        'steps'       => ['Toast sourdough until golden and crispy.','Mash avocados with lemon juice, salt and pepper to your preferred texture.','Bring water to a gentle simmer, add a splash of vinegar.','Crack eggs in and poach for 3 minutes until whites are set but yolk is runny.','Spread avocado generously on toast.','Top with a poached egg and season with chilli flakes and olive oil.'],
      ],
      [
        'name'        => 'Vegetable Stir Fry',
        'time'        => '25 minutes | Serves 4 | Difficulty: Easy',
        'desc'        => 'Quick and vibrant Asian stir fry with seasonal vegetables in soy and sesame sauce.',
        'ingredients' => ['Broccoli 200g','Bell peppers 2','Snap peas 150g','Carrots 2','Mushrooms 200g','Garlic 3 cloves','Ginger 2cm piece','Soy sauce 3 tbsp','Sesame oil 1 tbsp','Cornstarch 1 tsp','Oyster sauce 2 tbsp','Sesame seeds','Steamed rice to serve'],
        'steps'       => ['Combine soy sauce, oyster sauce, sesame oil and cornstarch in a bowl for the sauce.','Heat a wok or large pan until smoking hot. Add vegetable oil.','Fry garlic and ginger for 30 seconds until fragrant.','Add carrots and broccoli first. Stir fry 3 minutes on high heat.','Add peppers, snap peas and mushrooms. Cook 2 more minutes.','Pour sauce over vegetables. Toss until everything is coated and glossy.','Serve over rice. Garnish with sesame seeds.'],
      ],
      [
        'name'        => 'Shakshuka',
        'time'        => '25 minutes | Serves 4 | Difficulty: Easy',
        'desc'        => 'Middle Eastern eggs poached in a spiced tomato and pepper sauce with crumbled feta.',
        'ingredients' => ['Eggs 6','Tinned tomatoes 800g','Red peppers 2','Onion 1','Garlic 4 cloves','Cumin 1 tsp','Smoked paprika 1 tsp','Harissa paste 1 tbsp','Feta cheese 100g','Olive oil','Fresh parsley','Salt and pepper'],
        'steps'       => ['Fry onion and peppers in olive oil over medium heat until softened (8 minutes).','Add garlic, cumin, paprika and harissa. Stir and cook 1 minute.','Add tinned tomatoes. Simmer uncovered for 12-15 minutes until sauce thickens.','Season with salt and pepper.','Use a spoon to make 6 wells in the sauce. Crack an egg into each.','Cover with a lid and cook on low heat 8-10 minutes until whites are set.','Crumble feta, scatter parsley and serve immediately from the pan.'],
      ],
    ],
  ],
  3 => [
    'title'  => 'Vegetarian and Vegan Favourites',
    'colour' => '#558b2f',
    'icon'   => '🌱',
    'intro'  => 'Vibrant, nutrient-rich recipes that prove plant-based cooking is anything but boring. From creamy lentil soups to showstopping risottos.',
    'recipes'=> [
      [
        'name'        => 'Dal Tadka',
        'time'        => '40 minutes | Serves 4 | Difficulty: Easy',
        'desc'        => 'Comforting Indian yellow lentil soup with a tempering of ghee, cumin and spices.',
        'ingredients' => ['Yellow lentils 300g','Onion 1 large','Tomatoes 2 ripe','Garlic 4 cloves','Ginger 2cm piece','Cumin seeds 1 tsp','Ground turmeric 0.5 tsp','Ground coriander 1 tsp','Green chilli 1','Ghee or oil 2 tbsp','Salt','Fresh coriander to garnish'],
        'steps'       => ['Rinse lentils under cold water until clear.','Simmer lentils in 800ml water with turmeric for 20 minutes until completely soft.','Heat ghee in a pan. Add cumin seeds and fry until they splutter.','Add onion and fry until golden brown (8 minutes).','Add garlic, ginger and chilli. Cook 2 minutes.','Add tomatoes and ground coriander. Cook 8 minutes until sauce thickens.','Pour the tempering over lentils and stir. Simmer 5 minutes. Garnish with coriander.'],
      ],
      [
        'name'        => 'Creamy Hummus',
        'time'        => '20 minutes | Serves 6 | Difficulty: Easy',
        'desc'        => 'Silky smooth homemade hummus with tahini, lemon and garlic served with warm pita.',
        'ingredients' => ['Chickpeas 400g tin','Good quality tahini 60g','Lemons 2 (juice only)','Garlic 2 cloves','Good olive oil','Ground cumin 0.5 tsp','Ice-cold water 50ml','Salt to taste','Smoked paprika to garnish','Warm pita bread to serve'],
        'steps'       => ['Drain and rinse chickpeas. For maximum smoothness remove the skins by rubbing.','Place tahini and lemon juice in a food processor. Blend 1 minute until pale.','Add chickpeas, garlic, cumin and a generous pinch of salt.','Blend for 4 full minutes, adding ice water gradually through the spout.','Taste and adjust seasoning, adding more lemon or salt as needed.','Spread in a wide bowl creating a well in the centre.','Fill well with olive oil, sprinkle paprika and serve with warm pita.'],
      ],
      [
        'name'        => 'Greek Salad',
        'time'        => '10 minutes | Serves 4 | Difficulty: Easy',
        'desc'        => 'Refreshing summer salad with tomatoes, cucumber, olives, onion and creamy feta.',
        'ingredients' => ['Large ripe tomatoes 4','Cucumber 1','Red onion 1','Kalamata olives 150g','Feta cheese 200g (block)','Extra virgin olive oil 4 tbsp','Red wine vinegar 1 tbsp','Dried oregano 1 tsp','Salt and black pepper'],
        'steps'       => ['Cut tomatoes into large irregular chunks.','Cut cucumber in half lengthways then slice thickly.','Slice red onion into thin half-moons.','Combine tomatoes, cucumber, onion and olives in a large bowl.','Place the whole block of feta on top. Do not crumble it yet.','Drizzle generously with olive oil and red wine vinegar.','Sprinkle with oregano, salt and pepper. Crumble feta as you serve.'],
      ],
    ],
  ],
  4 => [
    'title'  => 'Baking Fundamentals',
    'colour' => '#7b3f00',
    'icon'   => '🧁',
    'intro'  => 'Master the essentials of baking with these reliable, tested recipes. Understanding these fundamentals will unlock an entire world of sweet and savoury baking.',
    'recipes'=> [
      [
        'name'        => 'New York Cheesecake',
        'time'        => '2 hours + overnight | Serves 10 | Difficulty: Hard',
        'desc'        => 'Dense and creamy baked cheesecake with a buttery biscuit base and vanilla filling.',
        'ingredients' => ['Digestive biscuits 250g','Butter 100g (melted)','Full-fat cream cheese 900g','Sour cream 200g','Caster sugar 250g','Eggs 4 large','Vanilla extract 2 tsp','Cornstarch 2 tbsp','Lemon zest 1 lemon'],
        'steps'       => ['Crush biscuits into fine crumbs. Mix with melted butter. Press firmly into a 23cm springform tin. Chill 30 minutes.','Preheat oven to 160C. Beat cream cheese until smooth.','Add sugar and beat until combined.','Add eggs one at a time on low speed.','Add sour cream, vanilla, cornstarch and lemon zest. Mix until just combined.','Wrap tin tightly in foil. Place in a roasting tin. Fill with hot water halfway up.','Bake 90 minutes. Turn off oven and leave inside 1 hour. Refrigerate overnight.'],
      ],
      [
        'name'        => 'Chocolate Lava Cake',
        'time'        => '30 minutes + 30 min chill | Serves 6 | Difficulty: Medium',
        'desc'        => 'Decadent individual chocolate fondants with a perfect molten dark chocolate centre.',
        'ingredients' => ['Dark chocolate 200g (70% cocoa)','Unsalted butter 150g','Eggs 4 large','Egg yolks 4','Caster sugar 120g','Plain flour 60g','Cocoa powder for dusting','Vanilla ice cream to serve'],
        'steps'       => ['Melt chocolate and butter together in a bowl over simmering water. Cool 10 minutes.','Whisk whole eggs, yolks and sugar in a large bowl for 5 minutes until very pale and thick.','Pour chocolate into egg mixture and fold gently until combined.','Sift in flour and fold until just incorporated. Do not overmix.','Butter 6 ramekins well and dust with cocoa powder.','Pour batter in. Chill 30 minutes (or up to 24 hours).','Bake at 200C for exactly 12 minutes. Run a knife around edge and turn out immediately.'],
      ],
      [
        'name'        => 'Classic Tiramisu',
        'time'        => '30 minutes + 4 hrs chill | Serves 8 | Difficulty: Medium',
        'desc'        => 'Italian dessert with espresso-soaked ladyfingers and silky mascarpone cream.',
        'ingredients' => ['Savoiardi ladyfingers 24','Mascarpone cheese 500g','Large eggs 4 (separated)','Caster sugar 100g','Strong espresso 300ml (cooled)','Marsala wine 50ml','Good quality cocoa powder for dusting'],
        'steps'       => ['Whisk egg yolks with sugar until pale, thick and doubled in volume.','Fold mascarpone into the egg yolk mixture until completely smooth.','In a separate bowl whisk egg whites to stiff peaks.','Gently fold egg whites into mascarpone mixture in three additions.','Combine cooled espresso with marsala wine in a shallow dish.','Working quickly dip each ladyfinger (1-2 seconds per side) and arrange in a single layer in a dish.','Spread half the cream. Repeat with a second layer. Cover and refrigerate at least 4 hours. Dust with cocoa to serve.'],
      ],
    ],
  ],
];

if (!isset($collections[$id])) {
    http_response_code(404);
    die('Recipe collection not found.');
}

$col = $collections[$id];

// Output HTML designed to print as PDF
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($col['title']) ?> - FoodFusion Recipe Card</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;600&display=swap');

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: #fff;
    color: #1a1a1a;
    line-height: 1.7;
    font-size: 13px;
  }

  .pdf-header {
    background: <?= $col['colour'] ?>;
    color: white;
    padding: 2.5rem 3rem;
    position: relative;
    overflow: hidden;
  }
  .pdf-header::after {
    content: '<?= $col['icon'] ?>';
    position: absolute;
    right: 2rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 5rem;
    opacity: .2;
  }
  .pdf-header .logo {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    opacity: .8;
    margin-bottom: .5rem;
    letter-spacing: .08em;
    text-transform: uppercase;
  }
  .pdf-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 900;
    margin-bottom: .5rem;
  }
  .pdf-header p { opacity: .85; font-size: .95rem; max-width: 600px; }

  .pdf-body { padding: 2.5rem 3rem; }

  .intro-box {
    background: #faf9f6;
    border-left: 4px solid <?= $col['colour'] ?>;
    padding: 1.2rem 1.5rem;
    border-radius: 0 8px 8px 0;
    margin-bottom: 2.5rem;
    font-size: .9rem;
    color: #444;
  }

  .recipe-card {
    border: 1.5px solid #e8e3db;
    border-radius: 12px;
    margin-bottom: 2.5rem;
    overflow: hidden;
    page-break-inside: avoid;
  }

  .recipe-title-bar {
    background: <?= $col['colour'] ?>18;
    border-bottom: 1.5px solid <?= $col['colour'] ?>33;
    padding: 1rem 1.5rem;
  }
  .recipe-title-bar h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: <?= $col['colour'] ?>;
    margin-bottom: .2rem;
  }
  .recipe-title-bar .meta {
    font-size: .78rem;
    color: #888;
    letter-spacing: .04em;
  }
  .recipe-desc {
    padding: .75rem 1.5rem;
    font-style: italic;
    color: #666;
    font-size: .875rem;
    border-bottom: 1px dashed #e8e3db;
    background: #fafafa;
  }

  .recipe-body {
    display: grid;
    grid-template-columns: 1fr 1.6fr;
    gap: 0;
  }

  .ingredients-col {
    padding: 1.25rem 1.5rem;
    border-right: 1.5px solid #e8e3db;
  }
  .steps-col { padding: 1.25rem 1.5rem; }

  .col-heading {
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .12em;
    color: <?= $col['colour'] ?>;
    margin-bottom: .75rem;
    display: flex;
    align-items: center;
    gap: .4rem;
  }

  .ingredients-list { list-style: none; }
  .ingredients-list li {
    font-size: .82rem;
    padding: .3rem 0;
    border-bottom: 1px solid #f0ede6;
    color: #333;
    display: flex;
    align-items: center;
    gap: .4rem;
  }
  .ingredients-list li::before {
    content: '';
    width: 5px; height: 5px;
    border-radius: 50%;
    background: <?= $col['colour'] ?>;
    flex-shrink: 0;
  }

  .steps-list { list-style: none; counter-reset: step; }
  .steps-list li {
    counter-increment: step;
    font-size: .82rem;
    padding: .35rem 0 .35rem 2rem;
    border-bottom: 1px solid #f0ede6;
    color: #333;
    position: relative;
  }
  .steps-list li::before {
    content: counter(step);
    position: absolute;
    left: 0;
    top: .35rem;
    width: 18px; height: 18px;
    border-radius: 50%;
    background: <?= $col['colour'] ?>;
    color: white;
    font-size: .65rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
  }

  .pdf-footer {
    margin-top: 3rem;
    padding: 1.5rem 3rem;
    border-top: 1px solid #e8e3db;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: .78rem;
    color: #999;
  }
  .pdf-footer strong { color: <?= $col['colour'] ?>; }

  .print-bar {
    background: #1a1a1a;
    color: white;
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 100;
  }
  .print-bar span { font-size: .9rem; opacity: .8; }
  .print-btn {
    background: <?= $col['colour'] ?>;
    color: white;
    border: none;
    padding: .6rem 1.5rem;
    border-radius: 100px;
    font-size: .9rem;
    font-weight: 600;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    display: flex;
    align-items: center;
    gap: .5rem;
  }
  .close-btn {
    background: transparent;
    color: white;
    border: 1px solid rgba(255,255,255,.3);
    padding: .6rem 1.2rem;
    border-radius: 100px;
    font-size: .85rem;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
  }
  .btn-group { display: flex; gap: .75rem; }

  @media print {
    .print-bar { display: none !important; }
    body { font-size: 11px; }
    .pdf-header { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .recipe-title-bar { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .pdf-body { padding: 1.5rem; }
  }
</style>
</head>
<body>

<!-- Sticky top bar -->
<div class="print-bar">
  <span>📄 <?= htmlspecialchars($col['title']) ?> — FoodFusion Recipe Card</span>
  <div class="btn-group">
    <button class="close-btn" onclick="window.close()">← Back</button>
    <button class="print-btn" onclick="window.print()">
      🖨️ Save as PDF / Print
    </button>
  </div>
</div>

<!-- PDF Header -->
<div class="pdf-header">
  <div class="logo">🍽 FoodFusion — Recipe Collection</div>
  <h1><?= $col['icon'] ?> <?= htmlspecialchars($col['title']) ?></h1>
  <p>foodfusion.com &nbsp;·&nbsp; Professional Recipe Cards &nbsp;·&nbsp; <?= date('Y') ?></p>
</div>

<div class="pdf-body">

  <div class="intro-box">
    <?= htmlspecialchars($col['intro']) ?>
  </div>

  <?php foreach ($col['recipes'] as $r): ?>
  <div class="recipe-card">
    <div class="recipe-title-bar">
      <h2><?= htmlspecialchars($r['name']) ?></h2>
      <div class="meta">⏱ <?= htmlspecialchars($r['time']) ?></div>
    </div>
    <div class="recipe-desc"><?= htmlspecialchars($r['desc']) ?></div>
    <div class="recipe-body">
      <div class="ingredients-col">
        <div class="col-heading">🛒 Ingredients</div>
        <ul class="ingredients-list">
          <?php foreach ($r['ingredients'] as $ing): ?>
          <li><?= htmlspecialchars($ing) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="steps-col">
        <div class="col-heading">👨‍🍳 Method</div>
        <ol class="steps-list">
          <?php foreach ($r['steps'] as $step): ?>
          <li><?= htmlspecialchars($step) ?></li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

</div>

<div class="pdf-footer">
  <span>© <?= date('Y') ?> <strong>FoodFusion</strong> — All rights reserved</span>
  <span>Visit us at <strong>foodfusion.com</strong></span>
  <span>Page 1 of 1</span>
</div>

<script>
  // Auto-prompt print dialog after a short delay so fonts load
  // User can save as PDF using browser's built-in "Save as PDF" printer
  window.addEventListener('load', function() {
    setTimeout(function() {
      // Uncomment the line below to auto-open print dialog on load:
      // window.print();
    }, 1000);
  });
</script>

</body>
</html>
