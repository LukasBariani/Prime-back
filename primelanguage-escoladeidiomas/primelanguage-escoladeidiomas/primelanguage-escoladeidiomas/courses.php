<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cursos - PrimeLanguage</title>
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
      <a href="wordguess.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none" style="color:#222;font-weight:600;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        WordGuess
        <span class="wow-underline"></span>
      </a>
      <a href="trilhas.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none" style="color:#222;font-weight:600;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        Trilhas
        <span class="wow-underline"></span>
      </a>
      <a href="courses.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none active" style="color:#fff;background:#5fc4b0;font-weight:600;box-shadow:0 2px 8px #0001;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
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
      border: none;
      outline: none;
    }
    .wow-nav-link[href*="community.php"]:hover {
      background:linear-gradient(90deg,#7ed6df 0%,#5fc4b0 100%);
      box-shadow:0 4px 16px #7ed6df55;
      color:#fff;
      transform:scale(1.08);
      border: none;
      outline: none;
    }
    .logo-link img:hover {
      filter:drop-shadow(0 4px 16px #5fc4b055) brightness(1.1);
    }
  </style>
  <main class="container py-5">
    <div class="mb-4">
      <h2 class="mb-1">English Courses</h2>
      <p class="text-muted">Acompanhe seus cursos e continue de onde parou.</p>
    </div>
    <section class="mb-5" data-animate>
      <h5 class="mb-3">In progress</h5>
      <div class="row g-4">
        <?php 
          $inProgress = [
            ['title'=>'Complete English','level'=>'A2 → B1','desc'=>'A structured pathway covering grammar, listening and reading comprehension. Designed to move you from A2 to solid B1 competence.','img'=>'assets/img/eua.png'],
            ['title'=>'Conversation Boost','level'=>'B1 → B2','desc'=>'High-frequency dialogues, role-plays and pronunciation drills to improve fluency in everyday situations.','img'=>'assets/img/conversation-boost.svg'],
            ['title'=>'Business English','level'=>'B2 → C1','desc'=>'Focused modules on meetings, presentations and professional writing. Build confidence for work contexts.','img'=>'assets/img/businessman.jpg'],
            ['title'=>'Pronunciation Lab','level'=>'A1 → A2','desc'=>'Targeted exercises to improve clarity and accent reduction for beginners and intermediates.','img'=>'assets/img/pronunciation.svg']
          ];
          foreach($inProgress as $card): ?>
        <div class="col-12 col-md-6 col-lg-6">
          <article class="course-card card-clean p-3" data-animate>
            <div class="d-flex align-items-center gap-4">
              <div class="card-thumb card-thumb-lg">
                <img src="<?php echo asset($card['img']); ?>" alt="<?php echo htmlentities($card['title']); ?>" class="img-fluid">
              </div>
              <div class="flex-grow-1">
                <div class="d-flex align-items-start gap-2 mb-2">
                  <h5 class="mb-1 card-title"><?php echo htmlentities($card['title']); ?></h5>
                  <small class="text-muted ms-auto">Level: <?php echo htmlentities($card['level']); ?></small>
                </div>
                <p class="mb-3 course-desc"><?php echo htmlentities($card['desc']); ?></p>
                <div class="d-flex gap-2 align-items-center">
                  <a class="btn btn-primary btn-sm btn-animated" href="courses.php">Continue</a>
                  
                  <div class="ms-auto text-muted small">2 lessons left</div>
                </div>
              </div>
            </div>
          </article>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section data-animate>
      <h5 class="mb-3">More courses</h5>
      <div class="row g-4">
        <?php 
          $more = [
            ['title'=>'English Pronunciation','level'=>'A1 - A2','img'=>'assets/img/english-pronunciation.svg'],
            ['title'=>'The World in English','level'=>'B1 - C1','img'=>'assets/img/travel.png'],
            ['title'=>'English for Travel','level'=>'A1 - A2','img'=>'assets/img/travel-english.svg'],
            ['title'=>'London Central','level'=>'A1 - A2','img'=>'assets/img/london.jpg']
          ];
          foreach($more as $card): ?>
        <div class="col-sm-6 col-lg-3">
          <article class="member-card card-clean p-3 text-start" data-animate>
            <div class="d-flex gap-3 align-items-center">
              <div class="card-thumb-sm">
                <img src="<?php echo asset($card['img']); ?>" alt="<?php echo htmlentities($card['title']); ?>" class="course-img object-cover">
              </div>
              <div class="flex-grow-1">
                <strong class="d-block card-title"><?php echo htmlentities($card['title']); ?></strong>
                <div class="small text-muted mb-2">Level: <?php echo htmlentities($card['level']); ?></div>
                <div class="d-flex align-items-center gap-3">
                  <a class="btn btn-primary btn-sm btn-animated" href="courses.php">Start</a>
                </div>
              </div>
            </div>
          </article>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo asset('assets/js/main.js'); ?>"></script>
</body>
</html>
