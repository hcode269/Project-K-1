<?php
// login.php
session_start();
// Nếu đã đăng nhập, chuyển về index.php
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/dbconnect/config.php';
$errors = [];

$successMessage = '';
if (isset($_GET['registered']) && $_GET['registered'] == '1') {
    $successMessage = 'Tạo tài khoản thành công. Vui lòng đăng nhập.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!$username || !$password) {
        $errors[] = 'Vui lòng điền đầy đủ thông tin.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT userId AS id, username AS name, passwordHash AS hash FROM Users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['hash'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Username hoặc mật khẩu không đúng.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- reset css -->
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <!-- embed font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <!-- style css -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Login</title>
  </head>
  <body>
    <div class="bg-login">
      <div class="container">
        <div class="box-login">
          <div class="box-content">
            <div class="box-content__logo">
              <img
                class="box-content__logo-thumb"
                src="./assets/img/logo.svg"
                alt="logo"
              />
            </div>
            <p class="box-content__header">Login Account</p>
            <?php if ($successMessage): ?>
              <p style="color:green"><?= htmlspecialchars($successMessage) ?></p>
            <?php endif; ?>
            <?php if ($errors): ?>
              <ul style="color:red">
                <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <form action="#!" method="POST">
              <div class="box-email">
                <input
                  class="box-email__input"
                  type="text"
                  name="username"
                  placeholder="Email Address"
                  required
                />
              </div>
              <div class="box-password">
                <input
                  class="box-password__input"
                  type="text"
                  name="password"
                  placeholder="Password"
                  required
                />
              </div>
              <div class="box-button">
                <button class="box-button__submit">Login Account</button>
              </div>
            </form>
            <div class="redirect">
              <p class="redirect__question">Don't Have An Account Yet?</p>
              <span
                ><a class="redirect__link" href="register.php">Sign Up Now</a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
