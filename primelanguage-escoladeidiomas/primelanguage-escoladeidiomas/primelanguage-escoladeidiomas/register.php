<?php
require_once __DIR__ . '/partials/helpers.php';

if (!empty($_SESSION['user'])) {
  header('Location: courses.php');
  exit;
}

// handle POST registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');

  if ($name && $email && $password) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['user'] = [
      'name' => $name,
      'email' => $email,
      'pass' => $hashed // demo only, do not use in production
    ];
    unset($_SESSION['onboarding']);
    header('Location: onboarding/language.php');
    exit;
  } else {
    $error = 'Por favor preencha todos os campos.';
  }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar-se</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
      body, .register-page, .register-inner, .register-form, .register-left, .register-right, .register-top, .form-error, .terms, h1, h2, h3, h4, h5, h6, label, input, button {
        font-family: 'Josefin Sans', Arial, sans-serif !important;
      }
    </style>
  </head>
  <body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <main class="register-page">
      <div class="register-inner">
        <section class="register-left">
          <h2>Junte-se
agora à nossa
comunidade!</h2>
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
          <form method="post" action="register.php" class="register-form">
            <label>Nome
              <input type="text" name="name" required placeholder="Nome completo">
            </label>
            <label>E-mail
              <input type="email" name="email" required placeholder="seu@email.com">
            </label>
            <label>Senha
              <input type="password" name="password" required placeholder="Senha">
            </label>
            <button class="btn btn-success btn-large btn-animated" type="submit">Registrar-se</button>
          </form>
          <p class="terms">Ao me registrar, declaro que li e aceitei os Termos de Serviço e Privacidade (nova).</p>
        </section>
      </div>
    </main>
    <script src="assets/js/main.js"></script>
  </body>
</html>
