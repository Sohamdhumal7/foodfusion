=

CREATE DATABASE IF NOT EXISTS foodfusion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE foodfusion;

-- Drop tables in safe order (FK child first)
DROP TABLE IF EXISTS community_recipes;
DROP TABLE IF EXISTS contact_messages;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name      VARCHAR(60)  NOT NULL,
    last_name       VARCHAR(60)  NOT NULL,
    email           VARCHAR(180) NOT NULL UNIQUE,
    password_hash   VARCHAR(255) NOT NULL,
    failed_attempts TINYINT UNSIGNED NOT NULL DEFAULT 0,
    locked_until    DATETIME     NULL DEFAULT NULL,
    created_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- recipes
-- ─────────────────────────────────────────────
CREATE TABLE recipes (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(150)  NOT NULL,
    description TEXT          NOT NULL,
    ingredients TEXT          NOT NULL,
    steps       TEXT          NOT NULL,
    cuisine     VARCHAR(80)   NOT NULL,
    difficulty  ENUM('Easy','Medium','Hard') NOT NULL DEFAULT 'Easy',
    diet        VARCHAR(100)  NULL,
    image_url   VARCHAR(255)  NULL,
    prep_time   VARCHAR(30)   NULL,
    cook_time   VARCHAR(30)   NULL,
    servings    TINYINT       NULL DEFAULT 4,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- community_recipes
-- ─────────────────────────────────────────────
CREATE TABLE community_recipes (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id     INT UNSIGNED  NOT NULL,
    title       VARCHAR(150)  NOT NULL,
    description TEXT          NOT NULL,
    ingredients TEXT          NOT NULL,
    steps       TEXT          NOT NULL,
    cuisine     VARCHAR(80)   NOT NULL,
    difficulty  ENUM('Easy','Medium','Hard') NOT NULL DEFAULT 'Easy',
    image_url   VARCHAR(255)  NULL,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_community_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- contact_messages
-- ─────────────────────────────────────────────
CREATE TABLE contact_messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120) NOT NULL,
    email      VARCHAR(180) NOT NULL,
    subject    VARCHAR(200) NOT NULL,
    message    TEXT         NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- 24 Curated Sample Recipes
-- ─────────────────────────────────────────────
INSERT INTO recipes (title, description, ingredients, steps, cuisine, difficulty, diet, image_url, prep_time, cook_time, servings) VALUES

('Spaghetti Carbonara',
 'Classic Roman pasta with silky egg sauce, crispy pancetta and generous black pepper.',
 'Spaghetti 400g|Pancetta 150g|Eggs 4|Pecorino Romano 100g|Parmesan 50g|Black pepper|Salt',
 'Boil salted water and cook spaghetti al dente.|Fry pancetta in a dry pan until crispy then remove from heat.|Whisk eggs with grated cheese and lots of black pepper.|Drain pasta reserving 1 cup water.|Off heat toss pasta with pancetta then add egg mix adding pasta water to emulsify.|Serve immediately with extra cheese.',
 'Italian','Medium','Non-Vegetarian',
 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=800','15 min','20 min',4),

('Margherita Pizza',
 'Authentic Neapolitan pizza with fresh tomato sauce, buffalo mozzarella and basil.',
 'Pizza dough 500g|San Marzano tomatoes 400g|Buffalo mozzarella 250g|Fresh basil|Olive oil|Salt|Garlic 2 cloves',
 'Stretch dough into a thin 30cm circle.|Crush tomatoes with garlic and salt for the sauce.|Spread sauce thinly on the dough.|Tear mozzarella over the top.|Bake at 250C for 8 to 10 minutes until blistered.|Top with fresh basil and a drizzle of olive oil.',
 'Italian','Medium','Vegetarian',
 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=800','30 min','10 min',2),

('Mushroom Risotto',
 'Creamy Italian risotto with porcini and chestnut mushrooms, white wine and parmesan.',
 'Arborio rice 320g|Mixed mushrooms 400g|Onion 1|Garlic 3 cloves|White wine 150ml|Vegetable stock 1.2L|Parmesan 80g|Butter 50g|Olive oil|Thyme|Salt|Pepper',
 'Saute onion and garlic in olive oil until soft.|Add mushrooms and cook 5 minutes.|Add rice and toast 2 minutes.|Pour in wine and stir until absorbed.|Add stock one ladle at a time stirring constantly for 18 minutes.|Stir in butter and parmesan then rest 2 minutes before serving.',
 'Italian','Hard','Vegetarian',
 'https://images.unsplash.com/photo-1476124369491-e7addf5db371?w=800','10 min','25 min',4),

('Classic Tiramisu',
 'Italian dessert with espresso-soaked ladyfingers, mascarpone cream and dusted cocoa.',
 'Ladyfingers 24|Mascarpone 500g|Eggs 4 large|Sugar 100g|Espresso 300ml cooled|Marsala wine 50ml|Cocoa powder for dusting',
 'Whisk egg yolks with sugar until pale and thick.|Fold in mascarpone until smooth.|Whisk egg whites to stiff peaks and fold into the mixture.|Mix espresso with marsala wine.|Quickly dip ladyfingers in coffee and layer in a dish.|Spread half the cream then repeat the layers.|Dust with cocoa and refrigerate at least 4 hours.',
 'Italian','Medium','Vegetarian',
 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=800','30 min','0 min',8),

('Chicken Tikka Masala',
 'Tender grilled chicken in a rich creamy spiced tomato sauce - a true classic.',
 'Chicken thighs 700g|Yoghurt 200g|Tomato puree 400ml|Double cream 100ml|Onion 2|Garlic 5 cloves|Ginger 3cm|Garam masala 2 tsp|Cumin 1 tsp|Paprika 1 tsp|Turmeric 1 tsp|Oil|Salt|Fresh coriander',
 'Marinate chicken in yoghurt, spices, garlic and ginger for 2 hours.|Grill or pan-fry chicken until charred then set aside.|Fry onions until golden then add garlic and ginger paste.|Add spices and cook 1 minute then add tomato puree.|Simmer 15 minutes then add cream and chicken.|Cook 10 more minutes and garnish with coriander.',
 'Indian','Medium','Non-Vegetarian',
 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800','2 hrs','30 min',4),

('Dal Tadka',
 'Comforting Indian yellow lentil soup with a tempering of ghee, cumin and warming spices.',
 'Yellow lentils 300g|Onion 1 large|Tomatoes 2|Garlic 4 cloves|Ginger 2cm|Cumin seeds 1 tsp|Turmeric 0.5 tsp|Coriander powder 1 tsp|Chilli 1|Ghee 2 tbsp|Salt|Fresh coriander',
 'Rinse lentils and simmer in water with turmeric for 20 minutes until soft.|Heat ghee and fry cumin seeds until they pop.|Add onion, garlic and ginger and fry until golden.|Add tomatoes and spices and cook 8 minutes.|Pour over lentils, stir well and simmer 5 minutes.|Garnish with fresh coriander and serve with rice or naan.',
 'Indian','Easy','Vegan',
 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800','10 min','30 min',4),

('Butter Chicken',
 'Mild and fragrant Indian curry with tender chicken in a velvety tomato and butter sauce.',
 'Chicken breast 600g|Butter 60g|Onion 2|Tomatoes 400g tin|Double cream 150ml|Garlic 4 cloves|Ginger 2cm|Kashmiri chilli 1 tsp|Garam masala 2 tsp|Honey 1 tsp|Salt',
 'Marinate chicken in spices and yoghurt for 1 hour.|Cook chicken in butter until browned then remove.|In the same pan fry onion, garlic and ginger until soft.|Add tomatoes and simmer 15 minutes then blend sauce smooth.|Return to pan with chicken, add cream and honey.|Simmer 10 minutes and serve with naan.',
 'Indian','Medium','Non-Vegetarian',
 'https://images.unsplash.com/photo-1588166524941-3bf61a9c41db?w=800','1 hr','30 min',4),

('Beef Tacos',
 'Authentic Mexican street tacos with seasoned beef, fresh pico de gallo and guacamole.',
 'Ground beef 500g|Corn tortillas 12|Onion 1|Garlic 3 cloves|Cumin 2 tsp|Chilli powder 1 tsp|Tomatoes 3|Lime 2|Avocado 2|Coriander|Cheddar cheese|Sour cream',
 'Brown beef with onion, garlic and spices then season well.|Dice tomatoes, onion and coriander with lime juice for pico de gallo.|Mash avocados with lime juice and salt for guacamole.|Warm tortillas in a dry pan.|Assemble tacos with beef, salsa, guacamole, cheese and sour cream.',
 'Mexican','Easy','Non-Vegetarian',
 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=800','20 min','15 min',4),

('Chicken Enchiladas',
 'Corn tortillas filled with pulled chicken, smothered in red enchilada sauce and melted cheese.',
 'Cooked chicken 400g shredded|Corn tortillas 8|Red enchilada sauce 500ml|Cheddar cheese 200g|Onion 1|Garlic 2 cloves|Cumin 1 tsp|Sour cream|Fresh coriander|Jalapenos',
 'Mix chicken with onion, garlic, cumin and half the cheese.|Pour a little sauce in a baking dish.|Fill each tortilla with chicken, roll and place seam-down.|Pour remaining sauce over the top and add remaining cheese.|Bake at 190C for 20 minutes until bubbling.|Serve with sour cream and coriander.',
 'Mexican','Easy','Non-Vegetarian',
 'https://images.unsplash.com/photo-1534352956036-cd81e27dd615?w=800','20 min','20 min',4),

('Pad Thai',
 'Thailand most popular noodle dish with rice noodles, prawns, egg and tamarind sauce.',
 'Rice noodles 300g|Prawns 300g|Eggs 3|Beansprouts 200g|Spring onions 4|Garlic 3 cloves|Tamarind paste 3 tbsp|Fish sauce 2 tbsp|Palm sugar 2 tbsp|Peanut oil|Crushed peanuts|Lime|Chilli flakes',
 'Soak noodles in warm water for 20 minutes.|Heat wok with oil then fry garlic and add prawns.|Push to side and scramble eggs in the centre.|Add noodles and the sauce mixture of tamarind, fish sauce and sugar.|Toss everything together on high heat.|Add beansprouts and spring onions and toss 1 minute.|Serve topped with peanuts, lime and chilli.',
 'Asian','Medium','Non-Vegetarian',
 'https://images.unsplash.com/photo-1559314809-0d155014e29e?w=800','25 min','15 min',2),

('Vegetable Stir Fry',
 'Quick and vibrant Asian stir fry with seasonal vegetables in a glossy soy and sesame sauce.',
 'Broccoli 200g|Peppers 2|Snap peas 150g|Carrots 2|Mushrooms 200g|Garlic 3 cloves|Ginger 2cm|Soy sauce 3 tbsp|Sesame oil 1 tbsp|Cornstarch 1 tsp|Oyster sauce 2 tbsp|Sesame seeds|Rice to serve',
 'Mix soy sauce, oyster sauce, sesame oil and cornstarch for the sauce.|Heat wok until smoking then add oil.|Fry garlic and ginger for 30 seconds.|Add harder vegetables first then softer ones after.|Pour sauce over and toss to coat everything.|Garnish with sesame seeds and serve over steamed rice.',
 'Asian','Easy','Vegan',
 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800','15 min','10 min',4),

('Tonkotsu Ramen',
 'Japanese comfort ramen with rich pork broth, soft-boiled marinated egg and chashu pork.',
 'Ramen noodles 400g|Pork belly 500g|Eggs 4|Soy sauce 100ml|Mirin 50ml|Chicken stock 2L|Garlic 6 cloves|Ginger 4cm|Spring onions|Nori sheets|Bamboo shoots|Sesame seeds',
 'Braise pork belly in soy sauce, mirin and water for 2 hours.|Marinate boiled eggs in soy-mirin solution for 4 hours.|Simmer stock with garlic and ginger for 30 minutes.|Season broth with soy sauce and miso to taste.|Cook noodles according to packet.|Assemble bowls with noodles, hot broth and sliced pork.|Top with halved egg, spring onions, nori and sesame.',
 'Japanese','Hard','Non-Vegetarian',
 'https://images.unsplash.com/photo-1569050467447-ce54b3bbc37d?w=800','4 hrs','30 min',4),

('Chicken Fried Rice',
 'Classic Chinese-style fried rice with chicken, egg and vegetables in a soy and sesame sauce.',
 'Cooked rice 600g day-old|Chicken breast 300g|Eggs 3|Peas 100g|Carrots 2|Spring onions 4|Garlic 3 cloves|Soy sauce 3 tbsp|Sesame oil 1 tsp|Vegetable oil|White pepper',
 'Dice chicken and season then fry in hot oil until cooked and set aside.|Scramble eggs in the wok then set aside.|Fry garlic, carrots and peas until tender.|Add rice breaking up any clumps on high heat.|Add chicken and eggs back in then pour soy sauce.|Toss continuously for 3 to 4 minutes.|Finish with sesame oil and spring onions.',
 'Asian','Easy','Non-Vegetarian',
 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800','10 min','15 min',4),

('Classic Beef Burger',
 'Juicy smash burger with double patties, American cheese, pickles and special burger sauce.',
 'Ground beef 600g|Brioche buns 4|American cheese 8 slices|Lettuce|Tomato|Pickles|Onion|Mayo 4 tbsp|Ketchup 2 tbsp|Mustard 1 tbsp|Pickle juice 1 tsp|Butter',
 'Mix mayo, ketchup, mustard and pickle juice for the special sauce.|Divide beef into 150g balls without overworking.|Heat a cast iron pan until smoking then add butter.|Add beef ball and smash flat immediately then season.|Cook 2 minutes then flip and add cheese and cook 1 more minute.|Toast buns and layer sauce, lettuce, tomato, pickles and patty.',
 'American','Easy','Non-Vegetarian',
 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800','15 min','10 min',4),

('Avocado Toast',
 'Sourdough toast loaded with smashed avocado, poached egg and chilli flakes.',
 'Sourdough bread 4 slices|Avocados 3 ripe|Eggs 4|Lemon 1|Chilli flakes|Salt|Pepper|Olive oil|Everything bagel seasoning',
 'Toast sourdough until golden and crispy.|Mash avocados with lemon juice, salt and pepper.|Poach eggs in simmering water with a splash of vinegar for 3 minutes.|Spread avocado generously on the toast.|Top with a poached egg.|Season with chilli flakes, bagel seasoning and olive oil.',
 'American','Easy','Vegetarian',
 'https://images.unsplash.com/photo-1505575156881-dd15ae275636?w=800','10 min','10 min',2),

('New York Cheesecake',
 'Dense and creamy baked cheesecake with a buttery biscuit base and vanilla bean filling.',
 'Digestive biscuits 250g|Butter 100g melted|Cream cheese 900g|Sour cream 200g|Sugar 250g|Eggs 4|Vanilla extract 2 tsp|Cornstarch 2 tbsp|Lemon zest 1',
 'Crush biscuits with butter and press into a 23cm tin then chill 30 minutes.|Beat cream cheese and sugar until smooth.|Add eggs one at a time then add sour cream, vanilla, cornstarch and lemon zest.|Wrap tin in foil and bake in a water bath at 160C for 90 minutes.|Turn off oven and leave inside for 1 hour.|Chill overnight before serving.',
 'American','Hard','Vegetarian',
 'https://images.unsplash.com/photo-1578775887804-699de7086ff9?w=800','30 min','90 min',10),

('French Onion Soup',
 'Classic Parisian bistro soup with caramelised onions, rich beef broth and melted Gruyere.',
 'Onions 1.2kg|Butter 60g|Olive oil 2 tbsp|Beef stock 1.5L|White wine 200ml|Thyme 4 sprigs|Bay leaves 2|Baguette sliced|Gruyere cheese 200g|Salt|Pepper',
 'Slice onions thinly and cook in butter and oil on low heat for 45 minutes until deeply caramelised.|Pour in wine and cook off the alcohol.|Add stock, thyme and bay leaves and simmer 20 minutes then season.|Ladle soup into ovenproof bowls.|Top with baguette slices and a mound of Gruyere.|Grill until cheese is golden and bubbling.',
 'French','Hard','Vegetarian',
 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800','15 min','70 min',4),

('Beef Bourguignon',
 'Classic French beef stew braised slowly in red wine with mushrooms and lardons.',
 'Beef chuck 1.2kg|Red wine 750ml|Bacon lardons 200g|Button mushrooms 300g|Pearl onions 200g|Carrots 3|Celery 3 stalks|Garlic 4 cloves|Tomato paste 2 tbsp|Beef stock 300ml|Thyme|Bay leaves|Flour 2 tbsp',
 'Brown beef in batches then set aside.|Fry lardons then add vegetables and tomato paste.|Add flour and cook 2 minutes.|Pour in wine and stock then return the beef.|Braise in oven at 160C for 2.5 hours.|Add mushrooms and pearl onions in the last 30 minutes.',
 'French','Hard','Non-Vegetarian',
 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800','30 min','3 hrs',6),

('Greek Salad',
 'Refreshing summer salad with chunky tomatoes, cucumber, olives, red onion and feta.',
 'Tomatoes 4 large|Cucumber 1|Red onion 1|Kalamata olives 150g|Feta cheese 200g|Olive oil 4 tbsp|Red wine vinegar 1 tbsp|Dried oregano 1 tsp|Salt|Pepper',
 'Cut tomatoes into large chunks.|Slice cucumber and red onion.|Combine vegetables and olives in a bowl.|Crumble feta over the top without mixing.|Drizzle with olive oil and red wine vinegar.|Season with oregano, salt and pepper and serve immediately.',
 'Mediterranean','Easy','Vegetarian',
 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800','10 min','0 min',4),

('Creamy Hummus',
 'Silky smooth homemade hummus with tahini, lemon and garlic served with warm pita bread.',
 'Chickpeas 400g tin|Tahini 60g|Lemon 2|Garlic 2 cloves|Olive oil|Cumin 0.5 tsp|Ice water 50ml|Salt|Paprika|Pita bread 4',
 'Drain chickpeas and remove skins for extra smoothness.|Blend tahini with lemon juice until pale and creamy.|Add chickpeas, garlic, cumin and salt then blend 4 minutes.|Add ice water gradually for your desired consistency.|Spread in a bowl and drizzle olive oil and sprinkle paprika.|Serve with warm pita bread.',
 'Mediterranean','Easy','Vegan',
 'https://images.unsplash.com/photo-1623428187969-5da2dcea5ebf?w=800','15 min','5 min',6),

('Crispy Fish and Chips',
 'Quintessentially British beer-battered cod with thick-cut chips and mushy peas.',
 'Cod fillets 4 large|Potatoes 1kg floury|Plain flour 200g|Baking powder 1 tsp|Cold lager 300ml|Oil for frying|Mushy peas 400g tin|Tartar sauce|Malt vinegar|Salt|Lemon',
 'Cut potatoes into thick chips then parboil 5 minutes and air dry.|Fry chips at 130C for 8 minutes then drain and set aside.|Whisk flour, baking powder, beer and salt until smooth for the batter.|Heat oil to 180C then coat fish in flour then batter.|Fry fish 6 to 8 minutes until golden and crispy.|Blast chips at 180C until golden and serve with peas and tartar sauce.',
 'British','Medium','Non-Vegetarian',
 'https://images.unsplash.com/photo-1579208575657-c595a05383b7?w=800','20 min','30 min',4),

('Shakshuka',
 'Vibrant Middle Eastern eggs poached in a spiced tomato and pepper sauce with feta.',
 'Eggs 6|Tomatoes 800g tin|Red peppers 2|Onion 1|Garlic 4 cloves|Cumin 1 tsp|Paprika 1 tsp|Harissa 1 tbsp|Feta cheese 100g|Olive oil|Fresh parsley|Salt|Pepper',
 'Fry onion and peppers in olive oil until soft.|Add garlic, cumin, paprika and harissa and cook 1 minute.|Add tomatoes and simmer 15 minutes until thick then season.|Make wells in the sauce and crack eggs in.|Cover and cook on low heat 8 to 10 minutes until whites are set.|Crumble feta over and scatter parsley then serve with crusty bread.',
 'Middle Eastern','Easy','Vegetarian',
 'https://images.unsplash.com/photo-1590412200988-a436970781fa?w=800','10 min','25 min',4),

('Salmon Sushi Rolls',
 'Homemade maki rolls with seasoned sushi rice, fresh salmon, avocado and cucumber.',
 'Sushi rice 400g|Rice vinegar 60ml|Sugar 2 tbsp|Salt 1 tsp|Nori sheets 6|Sashimi salmon 300g|Avocado 2|Cucumber 1|Soy sauce|Wasabi|Pickled ginger',
 'Cook sushi rice then mix in vinegar, sugar and salt and cool.|Place nori on a bamboo mat shiny side down.|Spread rice evenly leaving 2cm at the top edge.|Lay salmon, avocado and cucumber in a line.|Roll tightly using the mat pressing gently.|Wet the edge to seal then cut into 8 pieces with a sharp wet knife.|Serve with soy sauce, wasabi and pickled ginger.',
 'Japanese','Hard','Non-Vegetarian',
 'https://images.unsplash.com/photo-1553621042-f6e147245754?w=800','45 min','20 min',4),

('Chocolate Lava Cake',
 'Decadent individual chocolate fondants with a molten dark chocolate centre.',
 'Dark chocolate 200g|Butter 150g|Eggs 4|Egg yolks 4|Sugar 120g|Plain flour 60g|Cocoa powder for dusting|Vanilla ice cream to serve',
 'Melt chocolate and butter together then cool slightly.|Whisk eggs, yolks and sugar until pale and thick.|Fold chocolate into the egg mixture.|Fold in flour gently.|Butter ramekins and dust with cocoa powder.|Pour batter into ramekins and chill 30 minutes.|Bake at 200C for exactly 12 minutes.|Turn out immediately and serve with ice cream.',
 'French','Medium','Vegetarian',
 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?w=800','20 min','12 min',6);
