<?php
require_once __DIR__ . '/partials/helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');
  if ($email && $password) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['user'] = ['email' => $email, 'name' => strtok($email, '@'), 'pass' => $hashed];
    header('Location: courses.php');
    exit;
  } else {
    $error = 'Por favor informe e-mail e senha.';
  }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
  </head>
  <body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <main class="register-page">
      <div class="register-inner">
        <section class="register-left">
          <h2>É bom ter<br>você de<br>volta.</h2>
        </section>
        <section class="register-right card">
          <div class="register-top">
            <div class="flag-circle">
              <img src="assets/img/flag-en.png" alt="flag">
            </div>
            <h3>HELLO!</h3>
          </div>
          <?php if (!empty($error)): ?>
            <div class="form-error"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <form method="post" action="login.php" class="register-form">
            <label>E-mail
              <input type="email" name="email" required placeholder="seu@email.com">
            </label>
            <label>Senha
              <input type="password" name="password" required placeholder="Senha">
            </label>
            <button class="btn btn-success btn-large btn-animated" type="submit">Entrar</button>
          </form>
        </section>
      </div>
    </main>
    <script src="assets/js/main.js"></script>
  </body>
</html>
