<?php
include __DIR__ . '/helpers.php';
?>

<nav class="navbar navbar-custom">
  <div class="container navbar-flex">
    <div class="navbar-left">
      <a class="navbar-brand" href="index.php" aria-label="Prime Language">
        <img src="<?php echo asset('assets/img/prime-logo.png'); ?>" alt="Prime Language" />
      </a>
    </div>
    <?php
    $isRegisterPage = basename($_SERVER['PHP_SELF']) === 'register.php';
    $isAuthed = !empty($_SESSION['user']);
    if ($isRegisterPage): ?>
      <div class="navbar-right ms-auto">
        <a class="btn btn-sm btn-outline-secondary" href="login.php" data-i18n="Entrar">Entrar</a>
      </div>
    <?php elseif (!$isAuthed): ?>
      <div class="navbar-right">
        <a class="btn btn-sm btn-outline-secondary" href="login.php" data-i18n="Entrar">Entrar</a>
        <a class="btn btn-sm btn-success" href="register.php" data-i18n="Cadastrar">Cadastrar</a>
      </div>
    <?php else: ?>
      <div class="navbar-right">
        <a class="btn btn-sm btn-outline-secondary me-2" href="profile.php" data-i18n="Perfil"><?php echo htmlentities($_SESSION['user']['name'] ?? 'Perfil'); ?></a>
        <a class="btn btn-sm btn-danger" href="logout.php" data-i18n="Sair">Sair</a>
      </div>
    <?php endif; ?>
  </div>
</nav>

