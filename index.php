<?php
session_start();
require_once 'config.php';
$_SESSION['userId'] = 1;

$dislayName = '';
if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];

  $stmt = $pdo->prepare('SELECT displayName FROM users WHERE userId = ?');
  $stmt->execute([$userId]);
  $user = $stmt->fetch();

  if ($user) {
    $displayName = $user['displayName'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="./assets/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./assets/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./assets/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./assets/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./assets/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./assets/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./assets/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="./assets/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./assets/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="./assets/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="./assets/img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Nhúng thư viện Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- reset css -->
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <!-- embed font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap"
    rel="stylesheet" />
  <!-- style css -->
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>NutriPlaner</title>
</head>

<body>
  <!-- ==========================HEADER=================== -->
  <header class="header fixed">
    <div class="container">
      <div class="header__body">
        <!-- Logo -->
        <a href="./index.php"><img
            src="./assets/img/logo.svg"
            alt="NutriPlanerLogo"
            class="header__body--logo" /></a>
        <!-- Action -->
        <div class="header-navbartop">
          <div class="header-navbartop__search">
            <img
              src="./assets/img/search_icon.svg"
              alt="searchicon"
              class="header-navbartop__search--searchicon" />
            <input
              type="text"
              placeholder="SEARCH"
              id="searchInput"
              class="header-navbartop__search--searchinput" />
          </div>
          <nav class="header-navbarbottom">
            <ul class="header-navbarbottom__list">
              <li>
                <a
                  class="header-navbarbottom__item active"
                  href="./index.php">HOMEPAGE</a>
              </li>
              <li>
                <a class="header-navbarbottom__item" href="./dishes.php">DISHES</a>
              </li>
              <li>
                <a class="header-navbarbottom__item" href="./calculator.php">CALCULATOR</a>
              </li>
              <li>
                <a class="header-navbarbottom__item" href="./contact_us.php">CONTACT US</a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- Account -->
        <div class="header__account">
          <img
            src="./assets/img/ava_user.jpg"
            alt="account"
            id="accountAvatar"
            class="header__acount--ava" />
          <div class="header__acount--name"><?php echo htmlspecialchars($displayName) ?></div>
          <div class="account-dropdown" id="accountDropdown">
            <div class="account-dropdown__box">
              <button class="account-dropdown__logout">
                <span class="logout-text">Logout</span>
                <span class="logout-icon-initial"><i class="fa-solid fa-arrow-right"></i></span>
                <span class="logout-icon-final"><i class="fa-solid fa-arrow-right"></i></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ==========================MAIN=================== -->
  <main>
    <div class="main-banner homepage-img">
      <h1 class="main-banner__name">HOME PAGE</h1>
      <div class="main-banner__content container">
        <h2 class="main-banner__content--title">
          Welcome to Nutrition Planner!
        </h2>
        <p class="main-banner__content--desc">
          Nutrition Planner helps you create a healthy diet, optimize
          nutrition, and achieve your health goals. Whether you're looking to
          lose weight, build muscle, or maintain your health, we provide
          personalized meal plans and tailored nutrition advice.
        </p>
      </div>
    </div>
    <!-- ==========================CONTENT2=================== -->
    <section class="main-choosetype container">
      <h2 class="main-choosetype-title">
        CHOOSE THE DISH YOU ARE INTERESTED IN
      </h2>
      <!-- FILTER -->
      <div class="filter-box">
        <div>
          <label for="filter-calories-min">Calories Min</label>
          <input
            type="number"
            id="filter-calories-min"
            placeholder="Example: 50" />
        </div>
        <div>
          <label for="filter-calories-max">Calories Max</label>
          <input
            type="number"
            id="filter-calories-max"
            placeholder="Example: 500" />
        </div>
        <div>
          <label for="filter-diet">Diet Type</label>
          <select id="filter-diet">
            <option value="all">All</option>
            <option value="vegan">Vegan</option>
            <option value="keto">Keto</option>
            <option value="paleo">Paleo</option>
            <option value="vegetarian">Vegetarian</option>
            <option value="gluten-free">Gluten-Free</option>
          </select>
        </div>
        <div>
          <label for="filter-mealtype">Meal Type</label>
          <select id="filter-mealtype">
            <option value="all">All</option>
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
            <option value="smothies">Smothies</option>
            <option value="snack">Snack</option>
          </select>
        </div>
        <div>
          <label for="filter-allergen">Allergen</label>
          <select id="filter-allergen">
            <option value="all">none</option>
            <option value="dairy">Không chứa dairy</option>
            <option value="gluten">Không chứa gluten</option>
            <option value="nuts">Không chứa nuts</option>
            <option value="soy">Không chứa soy</option>
          </select>
        </div>
      </div>
      <!-- Menu các món ăn -->
      <div class="main-dishmenu">
        <div class="main-dishmenu-list container" id="dish-list">
          <!-- DISH 1 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish1.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Salmon Salad</a>
              <div class="dish__card-info--desc">Calories: 502 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">snack</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              egg, cheese, almonds
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 2 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish2.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Beef Stir-fry</a>
              <div class="dish__card-info--desc">Calories: 700 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              banana, spinach, milk
            </div>
            <div class="dish__allergen" style="display: none">soy</div>
          </div>
          <!-- DISH 3 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish3.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Vegan Bowl</a>
              <div class="dish__card-info--desc">Calories: 479 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegetarian</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              milk, egg, beef
            </div>
            <div class="dish__allergen" style="display: none">gluten</div>
          </div>
          <!-- DISH 4 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish4.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Chicken Soup</a>
              <div class="dish__card-info--desc">Calories: 323 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegetarian</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              egg, rice, spinach
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 5 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish5.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Fruit Smoothie</a>
              <div class="dish__card-info--desc">Calories: 113 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegetarian</span>
                <span class="dish__card-tag--tag2">lunch</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              sweet potato, broccoli, honey
            </div>
            <div class="dish__allergen" style="display: none">gluten</div>
          </div>
          <!-- DISH 6 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish6.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Avocado Toast</a>
              <div class="dish__card-info--desc">Calories: 273 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegetarian</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              tofu, cheese, peanuts
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 7 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish7.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Oatmeal with Berries</a>
              <div class="dish__card-info--desc">Calories: 333 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">keto</span>
                <span class="dish__card-tag--tag2">snack</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              quinoa, berries, yogurt
            </div>
            <div class="dish__allergen" style="display: none">soy</div>
          </div>
          <!-- DISH 8 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish8.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Grilled Chicken</a>
              <div class="dish__card-info--desc">Calories: 183 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">snack</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              oats, sweet potato, cheese
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 9 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish9.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Tofu Curry</a>
              <div class="dish__card-info--desc">Calories: 199 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">keto</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              peanuts, rice, broccoli
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 10 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish10.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Egg Muffins</a>
              <div class="dish__card-info--desc">Calories: 488 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">keto</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              egg, spinach, berries
            </div>
            <div class="dish__allergen" style="display: none">soy</div>
          </div>
          <!-- DISH 11 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish11.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Protein Pancakes</a>
              <div class="dish__card-info--desc">Calories: 273 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">snack</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              salmon, broccoli, milk
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 12 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish12.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Zucchini Noodles</a>
              <div class="dish__card-info--desc">Calories: 222 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">snack</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              sweet potato, berries, beef
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 13 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish13.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Shrimp Tacos</a>
              <div class="dish__card-info--desc">Calories: 520 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              tofu, carrot, berries
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 14 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish14.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Kale Chips</a>
              <div class="dish__card-info--desc">Calories: 297 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              rice, milk, oats
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 15 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish15.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Lentil Stew</a>
              <div class="dish__card-info--desc">Calories: 530 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              almonds, beef, sweet potato
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 16 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish16.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Banana Smoothie</a>
              <div class="dish__card-info--desc">Calories: 285 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">gluten-free</span>
                <span class="dish__card-tag--tag2">dinner</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              berries, honey, tofu
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 17 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish17.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Yogurt Parfait</a>
              <div class="dish__card-info--desc">Calories: 132 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">gluten-free</span>
                <span class="dish__card-tag--tag2">lunch</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              tofu, almonds, quinoa
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 18 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish18.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Quinoa Salad</a>
              <div class="dish__card-info--desc">Calories: 369 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">gluten-free</span>
                <span class="dish__card-tag--tag2">dinner</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              banana, oats, tofu
            </div>
            <div class="dish__allergen" style="display: none">soy</div>
          </div>
          <!-- DISH 19 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish19.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Pumpkin Soup</a>
              <div class="dish__card-info--desc">Calories: 290 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">dinner</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              spinach, berries, egg
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 20 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish20.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Stuffed Peppers</a>
              <div class="dish__card-info--desc">Calories: 239 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              yogurt, sweet potato, oats
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 21 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish21.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Peanut Butter Bars</a>
              <div class="dish__card-info--desc">Calories: 122 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">gluten-free</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              chicken, beef, banana
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 22 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish22.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Chia Pudding</a>
              <div class="dish__card-info--desc">Calories: 588 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              beef, quinoa, spinach
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 23 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish23.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Spinach Omelette</a>
              <div class="dish__card-info--desc">Calories: 157 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">snack</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              tofu, oats, sweet potato
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 24 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish24.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Cauliflower Rice</a>
              <div class="dish__card-info--desc">Calories: 593 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">breakfast</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              broccoli, yogurt, banana
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 25 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish25.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Greek Salad</a>
              <div class="dish__card-info--desc">Calories: 429 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">dinner</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              rice, spinach, salmon
            </div>
            <div class="dish__allergen" style="display: none">gluten</div>
          </div>
          <!-- DISH 26 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish26.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Berry Shake</a>
              <div class="dish__card-info--desc">Calories: 263 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">gluten-free</span>
                <span class="dish__card-tag--tag2">dinner</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              chicken, beef, quinoa
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 27 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish27.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Mushroom Risotto</a>
              <div class="dish__card-info--desc">Calories: 269 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">gluten-free</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              oats, sweet potato, spinach
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
          <!-- DISH 28 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish28.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Energy Balls</a>
              <div class="dish__card-info--desc">Calories: 237 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">paleo</span>
                <span class="dish__card-tag--tag2">lunch</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              broccoli, salmon, tofu
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 29 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish29.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Grilled Tofu</a>
              <div class="dish__card-info--desc">Calories: 370 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegetarian</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              chicken, spinach, honey
            </div>
            <div class="dish__allergen" style="display: none">gluten</div>
          </div>
          <!-- DISH 30 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish30.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Turkey Wrap</a>
              <div class="dish__card-info--desc">Calories: 526 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">vegan</span>
                <span class="dish__card-tag--tag2">smoothies</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              chicken, salmon, berries
            </div>
            <div class="dish__allergen" style="display: none">nuts</div>
          </div>
          <!-- DISH 31 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish31.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Mango Sticky Rice</a>
              <div class="dish__card-info--desc">Calories: 450 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">dessert</span>
                <span class="dish__card-tag--tag2">vegetarian</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              sticky rice, mango, coconut milk, sugar
            </div>
            <div class="dish__allergen" style="display: none">none</div>
          </div>
          <!-- DISH 32 -->
          <div class="main-dishmenu-item">
            <div class="dish__card">
              <img
                src="./assets/img/dish32.jpg"
                alt="dish_img"
                class="dish__card--thumb" />
              <div class="dish__card-function">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  class="bookmark-icon active">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="heart-icon">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                </svg>
              </div>
            </div>
            <div class="dish__card-info">
              <a href="#!" class="dish__card-info--name">Spaghetti Carbonara</a>
              <div class="dish__card-info--desc">Calories: 650 Kcal</div>
              <div class="dish__card-tag">
                <span class="dish__card-tag--tag1">italian</span>
                <span class="dish__card-tag--tag2">dinner</span>
              </div>
              <button class="dish__card--btn">VIEW MORE</button>
            </div>
            <div class="dish__ingredients" style="display: none">
              spaghetti, egg, pancetta, parmesan cheese, black pepper
            </div>
            <div class="dish__allergen" style="display: none">dairy</div>
          </div>
        </div>
      </div>

      <!-- Page pagination -->
      <div class="main-pagination">
        <ul class="main-pagelist">
          <!-- Nút trang sẽ được thêm tự động bằng JS -->
        </ul>
      </div>
    </section>
    <!-- ===========================FEEDBACK===================================== -->
    <section class="feedbackform">
      <h2 class="feedbackform__header">FEEDBACK FORM</h2>
      <div class="feedbackform__body">
        <div class="container feedbackform__content">
          <!-- KHối ảnh bên trái -->
          <div class="feedbackform__img">
            <img
              src="./assets/img/feedback_image.png"
              alt="feedback"
              class="feedbackform__img--thumb" />
          </div>
          <!-- KHối form bên phải -->
          <div class="feedbackform__form">
            <form action="#!">
              <!-- NAME -->
              <div class="feedbackform__formname">
                <p class="feedbackform__formname--label">Name*</p>
                <input
                  class="feedbackform__formname--area"
                  type="text"
                  required />
              </div>
              <!-- EMAIL -->
              <div class="feedbackform__formemail">
                <p class="feedbackform__formname--label">Email Address *</p>
                <input
                  class="feedbackform__formname--area"
                  type="text"
                  required />
              </div>
              <!-- Phonenumber -->
              <div class="feedbackform__formphone">
                <p class="feedbackform__formname--label">Phone Number</p>
                <input
                  class="feedbackform__formname--area"
                  type="tel"
                  name="phone"
                  pattern="[0-9]{10}" />
              </div>
              <!-- MESSAGE -->
              <div class="feedbackform__formmessage">
                <p class="feedbackform__formname--label">Message*</p>
                <textarea
                  name="message"
                  id="message"
                  rows="5"
                  cols="50"
                  class="feedbackform__formname--area"
                  required></textarea>
              </div>
              <div class="feedbackform__formrate">
                <p class="feedbackform__formname--label">Rating</p>
                <div class="star-rating" id="rating">
                  <span class="star" data-value="1">&#9733;</span>
                  <span class="star" data-value="2">&#9733;</span>
                  <span class="star" data-value="3">&#9733;</span>
                  <span class="star" data-value="4">&#9733;</span>
                  <span class="star" data-value="5">&#9733;</span>
                </div>
              </div>
              <button type="submit" class="feedbackform__btnsubmit">
                SEND MESSAGE
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- FOOTER -->
  <footer class="container footer">
    <div class="footer__logo">
      <a href="#!"><img
          src="./assets/img/logo.svg"
          alt="logo"
          class="footer__logo--thumb" /></a>
    </div>
    <p class="footer__title">&#169; 2025 NUTRITION PLANNER</p>
    <div class="footer__content">
      <p class="footer__content--desc">TERM</p>
      <p class="footer__content--desc">PRIVACY</p>
      <p class="footer__content--desc">COOKIES</p>
    </div>
  </footer>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/filter_advanced.js"></script>
  <script src="./assets/js/feedbackform_logic.js"></script>
</body>

</html>