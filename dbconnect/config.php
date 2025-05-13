<?php
// config/db.php

$host    = 'localhost';
$dbName  = 'NutriPlanner';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

// 1) Kết nối vào MySQL server (chưa chọn database)
$dsnServer = "mysql:host=$host;charset=$charset";
$options   = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsnServer, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Connection to server failed: ' . $e->getMessage());
}

// 2) Tạo database nếu chưa có
$pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// 3) Chọn database vừa tạo (kết nối lại với DSN có chứa dbname)
$dsnDb = "mysql:host=$host;dbname=$dbName;charset=$charset";
try {
    $pdo = new PDO($dsnDb, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Connection to database failed: ' . $e->getMessage());
}

// 4) Các lệnh tạo bảng và dữ liệu mẫu
$sqlStatements = [
    // Categories
    "CREATE TABLE IF NOT EXISTS Categories (
        categoryId INT PRIMARY KEY,
        categoryName VARCHAR(100) NOT NULL
    )",
    "INSERT IGNORE INTO Categories (categoryId, categoryName) VALUES
        (1, 'breakfast'),
        (2, 'lunch'),
        (3, 'dinner'),
        (4, 'snacks'),
        (5, 'smoothies')",

    // Meals
    "CREATE TABLE IF NOT EXISTS Meals (
        mealId INT PRIMARY KEY,
        mealName VARCHAR(200) NOT NULL,
        recipe TEXT,
        totalCalorie FLOAT,
        totalProtein FLOAT,
        totalFat FLOAT,
        totalCarb FLOAT,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    "INSERT IGNORE INTO Meals (mealId, mealName, recipe, totalCalorie, totalProtein, totalFat, totalCarb) VALUES
    (1, 'Avocado Spinach Smoothie', 'Blend avocado, spinach, almond milk, protein powder', 350, 20, 20, 25),
    (2, 'Overnight Oats', 'Soak oats in almond milk; top with berries and chia seeds', 300, 10, 8, 50),
    (3, 'Egg White Wrap', 'Egg whites cooked into wrap; fill with veggies', 200, 25, 5, 10),
    (4, 'Protein Pancakes', 'Mix protein powder, oats, egg whites; cook as pancakes', 320, 30, 6, 35),
    (5, 'Chia Seed Pudding', 'Soak chia seeds in coconut milk; add vanilla', 280, 8, 15, 20),
    (6, 'Grilled Chicken Salad', 'Grill chicken breast; toss with mixed greens and vinaigrette', 300, 35, 10, 15),
    (7, 'Quinoa & Veggie Bowl', 'Cook quinoa; top with roasted veggies and tahini', 400, 12, 15, 55),
    (8, 'Turkey Avocado Sandwich', 'Whole grain bread, turkey, avocado, lettuce', 350, 25, 15, 30),
    (9, 'Lentil Soup', 'Simmer lentils with veggies and broth', 250, 15, 3, 40),
    (10, 'Tuna Salad Lettuce Wraps', 'Tuna, Greek yogurt, celery; wrap in lettuce', 220, 30, 5, 8),
    (11, 'Baked Salmon & Asparagus', 'Bake salmon; serve with roasted asparagus', 380, 30, 22, 5),
    (12, 'Tofu Stir-Fry', 'Stir-fry tofu and mixed veggies in soy sauce', 320, 18, 12, 30),
    (13, 'Zucchini Noodles with Pesto', 'Spiralize zucchini; toss with pesto sauce', 280, 6, 22, 8),
    (14, 'Chicken & Veggie Skewers', 'Grill chicken and veggies on skewers', 350, 28, 15, 10),
    (15, 'Lentil Curry', 'Cook lentils in curry sauce; serve with cauliflower rice', 330, 17, 10, 40),
    (16, 'Apple Slices with Almond Butter', 'Serve apple slices with almond butter dip', 200, 4, 10, 25),
    (17, 'Carrot & Hummus', 'Serve carrot sticks with hummus', 180, 5, 12, 15),
    (18, 'Protein Energy Balls', 'Mix oats, peanut butter, protein powder; form balls', 250, 12, 15, 20),
    (19, 'Greek Yogurt & Berries', 'Combine Greek yogurt with mixed berries', 180, 15, 4, 18),
    (20, 'Mixed Nuts', 'Portion of almonds, walnuts, cashews', 300, 8, 25, 10),
    (21, 'Berry Blast Smoothie', 'Blend mixed berries, banana, yogurt, honey', 300, 8, 5, 60),
    (22, 'Green Detox Smoothie', 'Blend spinach, kale, green apple, ginger', 250, 5, 2, 50),
    (23, 'Mango Tango Smoothie', 'Blend mango, orange juice, coconut water', 280, 3, 1, 70),
    (24, 'Chocolate Protein Shake', 'Blend chocolate protein powder, milk, banana', 350, 30, 8, 35),
    (25, 'Peanut Butter Banana Smoothie', 'Blend banana, peanut butter, oat milk', 320, 10, 15, 35),
    (26, 'Spinach & Feta Omelette', 'Eggs, spinach, feta cheese; cook into omelette', 270, 18, 18, 4),
    (27, 'Banana Protein Muffins', 'Muffins made with banana, protein powder, oats', 220, 12, 5, 30),
    (28, 'Black Bean Salad', 'Black beans, corn, tomato, cilantro, lime', 310, 12, 5, 55),
    (29, 'Shrimp Stir-Fry', 'Stir-fry shrimp, broccoli, bell peppers', 300, 25, 8, 20),
    (30, 'Kale Chips', 'Baked kale with olive oil and salt', 150, 5, 10, 12)",

    // Ingredients
    "CREATE TABLE IF NOT EXISTS Ingredients (
        ingredientId INT PRIMARY KEY,
        ingredientName VARCHAR(200) NOT NULL,
        caloriePerUnit FLOAT,
        proteinPerUnit FLOAT,
        fatPerUnit FLOAT,
        carbPerUnit FLOAT
    )",
    "INSERT IGNORE INTO Ingredients (ingredientId, ingredientName, caloriePerUnit, proteinPerUnit, fatPerUnit, carbPerUnit) VALUES
    (1, 'Avocado', 160, 2, 15, 9),
    (2, 'Spinach', 23, 3, 0.4, 4),
    (3, 'Chicken Breast', 165, 31, 3.6, 0),
    (4, 'Oats', 389, 17, 7, 66),
    (5, 'Mixed Berries', 57, 1, 0.3, 14),
    (6, 'Greek Yogurt', 59, 10, 0.4, 3.6),
    (7, 'Granola', 489, 10, 20, 65),
    (8, 'Eggs', 155, 13, 11, 1.1),
    (9, 'Quinoa', 120, 4, 2, 21),
    (10, 'Turkey', 104, 17, 2, 0),
    (11, 'Lentils', 116, 9, 0.4, 20),
    (12, 'Salmon', 208, 20, 13, 0),
    (13, 'Tofu', 76, 8, 4.8, 1.9),
    (14, 'Zucchini', 17, 1.2, 0.3, 3.1),
    (15, 'Carrot', 41, 0.9, 0.2, 10),
    (16, 'Apple', 52, 0.3, 0.2, 14),
    (17, 'Almonds', 579, 21, 50, 22)",

    // MealIngredient
    "CREATE TABLE IF NOT EXISTS MealIngredient (
        mealId INT,
        ingredientId INT,
        amount FLOAT,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (mealId, ingredientId),
        FOREIGN KEY (mealId) REFERENCES Meals(mealId) ON DELETE CASCADE,
        FOREIGN KEY (ingredientId) REFERENCES Ingredients(ingredientId) ON DELETE CASCADE
    )",
    "INSERT IGNORE INTO MealIngredient (mealId, ingredientId, amount) VALUES
    (1, 1, 1.5), (1, 2, 0.3),
    (2, 4, 0.6), (2, 5, 0.2), (2, 7, 0.1),
    (3, 8, 2.0), (3, 14, 0.3),
    (4, 4, 0.5), (4, 6, 0.2), (4, 8, 0.3),
    (5, 3, 0.3), (5, 6, 0.4),
    (26, 8, 2.0), (26, 2, 0.5), (26, 6, 0.1),
    (27, 4, 0.4), (27, 5, 0.3), (27, 8, 0.1),
    (6, 3, 2.0), (6, 2, 0.5), (6, 15, 0.1),
    (7, 9, 0.8), (7, 15, 0.4), (7, 14, 0.3),
    (8, 10, 1.5), (8, 1, 0.3), (8, 14, 0.2),
    (9, 11, 1.0), (9, 15, 0.3), (9, 5, 0.2),
    (10, 5, 0.2), (10, 6, 0.3), (10, 15, 0.1),
    (28, 11, 1.2), (28, 16, 0.3), (28, 15, 0.2),
    (11, 12, 1.0), (11, 14, 0.4),
    (12, 13, 1.0), (12, 2, 0.5), (12, 14, 0.3),
    (13, 14, 1.0), (13, 7, 0.2),
    (14, 3, 1.5), (14, 15, 0.4), (14, 2, 0.2),
    (15, 11, 0.8), (15, 16, 0.3), (15, 14, 0.3),
    (29, 12, 1.2), (29, 2, 0.5), (29, 14, 0.3),
    (16, 16, 0.5), (16, 17, 0.2),
    (17, 15, 0.4), (17, 11, 0.2),
    (18, 4, 0.3), (18, 7, 0.2), (18, 6, 0.1),
    (19, 6, 0.5), (19, 5, 0.3),
    (20, 17, 0.6), (20, 1, 0.2),
    (30, 2, 1.0), (30, 12, 0.1),
    (21, 5, 0.6), (21, 6, 0.2), (21, 16, 0.2),
    (22, 2, 0.5), (22, 14, 0.3), (22, 16, 0.2),
    (23, 16, 0.8), (23, 1, 0.2),
    (24, 6, 0.4), (24, 16, 0.3), (24, 4, 0.2),
    (25, 16, 0.5), (25, 17, 0.3), (25, 9, 0.2)",

    // CategoryMeal
    "CREATE TABLE IF NOT EXISTS CategoryMeal (
        categoryId INT,
        mealId INT,
        PRIMARY KEY (categoryId, mealId),
        FOREIGN KEY (categoryId) REFERENCES Categories(categoryId) ON DELETE CASCADE,
        FOREIGN KEY (mealId) REFERENCES Meals(mealId) ON DELETE CASCADE
    )",
    "INSERT IGNORE INTO CategoryMeal (categoryId, mealId) VALUES
    (1,1),(1,2),(1,3),(1,4),(1,5),(2,6),(2,7),(2,8),(2,9),(2,10),
    (3,11),(3,12),(3,13),(3,14),(3,15),(4,16),(4,17),(4,18),(4,19),(4,20),
    (5,21),(5,22),(5,23),(5,24),(5,25),(1,26),(1,27),(2,28),(3,29),(4,30)",

    // DietType
    "CREATE TABLE IF NOT EXISTS DietType (
        dietTypeId INT PRIMARY KEY,
        dietName VARCHAR(100) NOT NULL
    )",
    "INSERT IGNORE INTO DietType (dietTypeId, dietName) VALUES
    (1, 'vegetarian'),
    (2, 'low-carb'),
    (3, 'balanced'),
    (4, 'high-protein'),
    (5, 'keto'),
    (6, 'paleo'),
    (7, 'vegan'),
    (8, 'high-fiber')",

    // MealDiet
    "CREATE TABLE IF NOT EXISTS MealDiet (
        mealId INT,
        dietTypeId INT,
        PRIMARY KEY (mealId, dietTypeId),
        FOREIGN KEY (mealId) REFERENCES Meals(mealId) ON DELETE CASCADE,
        FOREIGN KEY (dietTypeId) REFERENCES DietType(dietTypeId) ON DELETE CASCADE
    )",
    "INSERT IGNORE INTO MealDiet (mealId, dietTypeId) VALUES
    (1, 1),(1, 3),(2, 3),(2, 4),(3, 4),(4, 4),(5, 5),(6, 2),(6, 3),(7, 1),(7, 3),(8, 3),(9, 8),(10, 2),(11, 6),(12, 7),(13, 5),(14, 3),(15, 1),(15, 8),(16, 3),(17, 7),(18, 4),(19, 2),(20, 5),(21, 3),(22, 7),(23, 1),(24, 4),(25, 3),(26, 5),(27, 3),(28, 7),(29, 6),(30, 7)",

    // Tag
    "CREATE TABLE IF NOT EXISTS Tag (
        tagId INT PRIMARY KEY,
        tagName VARCHAR(100) NOT NULL
    )",
    "INSERT IGNORE INTO Tag (tagId, tagName) VALUES
    (1, 'high calories'),
    (2, 'low calories'),
    (3, 'high protein'),
    (4, 'low fat'),
    (5, 'balanced')",

    // IngredientTag
    "CREATE TABLE IF NOT EXISTS IngredientTag (
        ingredientId INT,
        tagId INT,
        PRIMARY KEY (ingredientId, tagId),
        FOREIGN KEY (ingredientId) REFERENCES Ingredients(ingredientId) ON DELETE CASCADE,
        FOREIGN KEY (tagId) REFERENCES Tag(tagId) ON DELETE CASCADE
    )",
    "INSERT IGNORE INTO IngredientTag (ingredientId, tagId) VALUES
    (1, 1),(2, 2),(3, 3),(4, 1),(5, 2),(6, 3),(7, 1),(8, 5),(9, 5),(10, 3),(11, 5),(12, 3),(13, 4),(14, 2),(15, 2),(16, 2),(17, 1)",

    // Users
    "CREATE TABLE IF NOT EXISTS Users (
        userId INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(100) NOT NULL,
        passwordHash VARCHAR(255) NOT NULL,
        isAdmin BOOLEAN DEFAULT FALSE,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    // UserFavorite
    "CREATE TABLE IF NOT EXISTS UserFavorite (
        userId INT,
        mealId INT,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (userId, mealId),
        FOREIGN KEY (userId) REFERENCES Users(userId) ON DELETE CASCADE,
        FOREIGN KEY (mealId) REFERENCES Meals(mealId) ON DELETE CASCADE
    )",

    // Feedback
    "CREATE TABLE IF NOT EXISTS Feedback (
        feedbackId INT PRIMARY KEY AUTO_INCREMENT,
        userId INT,
        rating TINYINT NOT NULL,
        message TEXT,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (userId) REFERENCES Users(userId) ON DELETE CASCADE
    )",
];

// 5) Thực thi từng câu lệnh
foreach ($sqlStatements as $stmt) {
    try {
        $pdo->exec($stmt);
    } catch (PDOException $e) {
        // Nếu có lỗi, bạn có thể log hoặc hiển thị debug tùy ý
        // echo "SQL error: " . $e->getMessage();
    }
}

return $pdo;
