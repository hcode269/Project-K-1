<?php
// session_start();
// require_once 'config.php';

// // Nếu người dùng đã đăng nhập, chuyển hướng về trang chủ
// if (isset($_SESSION['userId'])) {
//   header("Location: index.php");
//   exit();
// }

// // Xử lý đăng nhập khi submit form
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//   $username = $_POST['username'] ?? '';
//   $password = $_POST['password'] ?? '';

//   if ($username && $password) {
//     $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
//     $stmt->execute([$username]);
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($user && password_verify($password, $user['passwordHash'])) {
//       $_SESSION['userId'] = $user['userId'];
//       $_SESSION['username'] = $user['username'];
//       $_SESSION['isAdmin'] = $user['isAdmin'];
//       $_SESSION['displayName'] = $user['displayName'];

//       header("Location: index.php");
//       exit();
//     } else {
//       $error = "Sai tên đăng nhập hoặc mật khẩu.";
//     }
//   } else {
//     $error = "Vui lòng điền đầy đủ thông tin.";
//   }
// }
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
  <title>Login</title>
</head>

<body>
  <div class="bg-login">

    <div class="box-login">
      <div class="box-content">
        <div class="box-content__logo">
          <img
            class="box-content__logo-thumb"
            src="./assets/img/logo.svg"
            alt="logo" />
        </div>
        <p class="box-content__header">Login Account</p>
        <?php if (!empty($error)): ?>
          <p style="color:red;"> <?= htmlspecialchars($error) ?> </p>
        <?php endif; ?>
        <form action="#" method="POST">
          <div class="box-email">
            <input
              class="box-email__input"
              type="text"
              placeholder="Email Address" />
          </div>
          <div class="box-password">
            <input
              class="box-password__input"
              type="password"
              placeholder="Password" />
          </div>
          <div class="box-button">
            <button class="box-button__submit">Sign In</button>
          </div>
        </form>
        <div class="redirect--login">
          <p class="redirect__question">Have An Account?</p>
          <span><a class="redirect__link" href="./create_account.php">
              Sign Up</a></span>
        </div>
      </div>
    </div>
  </div>
</body>

</html>