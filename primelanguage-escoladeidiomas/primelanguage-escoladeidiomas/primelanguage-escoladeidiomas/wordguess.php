<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WordGuess</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
  <?php include 'partials/helpers.php'; ?>
  <link rel="stylesheet" href="<?php echo asset('assets/css/styles.css'); ?>">
</head>
<body>
  <?php
    $userInitial = '';
    if (!empty($_SESSION['user']['name'])) {
      $userInitial = strtoupper(mb_substr($_SESSION['user']['name'],0,1));
    }
  ?>
  <?php if ($userInitial): ?>
    <a href="profile.php" class="profile-fab" title="Perfil">
      <span><?php echo $userInitial; ?></span>
    </a>
  <?php endif; ?>
  <style>
    .profile-fab {
      position:fixed;
      top:32px;
      right:48px;
      z-index:1000;
      width:52px;
      height:52px;
      background:linear-gradient(135deg,#5fc4b0 0%,#7ed6df 100%);
      color:#fff;
      border-radius:50%;
      box-shadow:0 4px 24px #5fc4b055;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:2rem;
      font-family:'Josefin Sans',sans-serif;
      font-weight:700;
      letter-spacing:1px;
      text-decoration:none;
      transition:transform .3s,box-shadow .3s;
      border:none;
      outline:none;
      cursor:pointer;
      animation: fabIn .7s cubic-bezier(.77,0,.18,1);
    }
    .profile-fab:hover {
      transform:scale(1.12) rotate(-6deg);
      box-shadow:0 8px 32px #7ed6df99;
      background:linear-gradient(135deg,#7ed6df 0%,#5fc4b0 100%);
    }
    @keyframes fabIn {
      from { opacity:0; transform:scale(0.7) translateY(-32px); }
      to { opacity:1; transform:scale(1) translateY(0); }
    }
  </style>
  <nav class="wow-navbar d-flex align-items-center justify-content-center py-3 mb-4 position-relative" style="background:transparent;font-family:'Josefin Sans',sans-serif;">
    <a href="index.php" class="logo-link d-flex align-items-center" style="margin-right:48px;transition:margin .4s cubic-bezier(.77,0,.18,1);padding-left:16px;">
      <img src="assets/img/prime-logo.png" alt="Prime Language" style="height:40px;width:auto;filter:drop-shadow(0 2px 8px #0001);transition:filter .4s;">
    </a>
    <div class="d-flex gap-4">
      <a href="wordguess.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none active" style="color:#fff;background:#5fc4b0;font-weight:600;box-shadow:0 2px 8px #0001;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        WordGuess
        <span class="wow-underline"></span>
      </a>
      <a href="trilhas.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none" style="color:#222;font-weight:600;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        Trilhas
        <span class="wow-underline"></span>
      </a>
      <a href="courses.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none" style="color:#222;font-weight:600;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        Cursos
        <span class="wow-underline"></span>
      </a>
      <a href="community.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none" style="color:#222;font-weight:600;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        Comunidade
        <span class="wow-underline"></span>
      </a>
    </div>
  </nav>
  <style>
    .wow-navbar {
      box-shadow: 0 4px 24px #0001;
      border-radius: 18px;
      background: rgba(255,255,255,0.7);
      backdrop-filter: blur(4px);
      animation: fadeInDown .7s cubic-bezier(.77,0,.18,1);
      max-width: 700px;
      margin: 32px auto 24px auto;
    }
    @keyframes fadeInDown {
      from { opacity:0; transform:translateY(-32px); }
      to { opacity:1; transform:translateY(0); }
    }
    .wow-nav-link {
      position:relative;
      overflow:hidden;
      z-index:1;
    }
    .wow-nav-link .wow-underline {
      position:absolute;
      left:50%;
      bottom:8px;
      width:0;
      height:3px;
      background:#5fc4b0;
      border-radius:2px;
      transition:width .4s cubic-bezier(.77,0,.18,1),left .4s cubic-bezier(.77,0,.18,1);
      z-index:-1;
    }
    .wow-nav-link:hover .wow-underline,
    .wow-nav-link.active .wow-underline {
      width:80%;
      left:10%;
    }
    .wow-nav-link:hover {
      color:#5fc4b0;
      background:rgba(95,196,176,0.08);
      box-shadow:0 2px 12px #5fc4b033;
      transform:translateY(-2px) scale(1.04);
    }
    .wow-nav-link.active {
      color:#fff !important;
      background:#5fc4b0 !important;
      box-shadow:0 2px 12px #5fc4b033;
      transform:scale(1.08);
    }
    .wow-nav-link[href*="community.php"] {
      background:linear-gradient(90deg,#5fc4b0 0%,#7ed6df 100%);
      color:#fff;
      box-shadow:0 2px 12px #7ed6df33;
      font-weight:700;
      letter-spacing:0.5px;
      transition:background .4s,box-shadow .4s;
    }
    .wow-nav-link[href*="community.php"]:hover {
      background:linear-gradient(90deg,#7ed6df 0%,#5fc4b0 100%);
      box-shadow:0 4px 16px #7ed6df55;
      color:#fff;
      transform:scale(1.08);
    }
    .logo-link img:hover {
      filter:drop-shadow(0 4px 16px #5fc4b055) brightness(1.1);
    }
  </style>
  <main class="container py-5 text-center">
    <h2 class="mb-4">WordGuess</h2>
    <div class="word-grid mx-auto mb-4"></div>
    <div class="keyboard mx-auto"></div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo asset('assets/js/main.js'); ?>"></script>
</body>
</html>
