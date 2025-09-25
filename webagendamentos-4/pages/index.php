<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['footer_lang'])) {
  $_SESSION['site_lang'] = $_POST['footer_lang'];
  header('Location: index.php');
  exit;
}
$langs = [
  'pt' => [
    'label' => 'Português',
    'flag' => 'assets/img/flag-br.svg',
    'hero' => 'Mais livre. Mais global. Mais presente no mundo.',
    'desc' => 'Aulas curtas, prática diária e comunidade ativa — tudo para você falar com segurança.',
    'cta' => 'Comece grátis',
    'courses' => 'Ver cursos',
    'learn_today' => 'O que vamos aprender hoje?',
    'differential' => 'Qual o nosso diferencial?',
    'review_title' => 'O que dizem sobre a Prime:',
    'download_title' => 'Aprenda idiomas',
    'download_sub' => 'ONDE e <strong>QUANDO</strong> quiser!',
    'download_desc' => 'Baixe o aplicativo da Prime Language.',
    'download_small' => 'o mundo em apenas um clique.'
  ],
  'en' => [
    'label' => 'English',
    'flag' => 'assets/img/flag-en.svg',
    'hero' => 'More free. More global. More present in the world.',
    'desc' => 'Short lessons, daily practice and active community — everything for you to speak confidently.',
    'cta' => 'Start for free',
    'courses' => 'See courses',
    'learn_today' => 'What are we learning today?',
    'differential' => 'What makes us different?',
    'review_title' => 'What people say about Prime:',
    'download_title' => 'Learn languages',
    'download_sub' => 'WHERE and <strong>WHEN</strong> you want!',
    'download_desc' => 'Download the Prime Language app.',
    'download_small' => 'the world in just one click.'
  ],
  'es' => [
    'label' => 'Español',
    'flag' => 'assets/img/flag-es.svg',
    'hero' => 'Más libre. Más global. Más presente en el mundo.',
    'desc' => 'Clases cortas, práctica diaria y comunidad activa — todo para que hables con seguridad.',
    'cta' => 'Empieza gratis',
    'courses' => 'Ver cursos',
    'learn_today' => '¿Qué vamos a aprender hoy?',
    'differential' => '¿Cuál es nuestro diferencial?',
    'review_title' => 'Qué dicen sobre Prime:',
    'download_title' => 'Aprende idiomas',
    'download_sub' => '¡DÓNDE y CUÁNDO quieras!',
    'download_desc' => 'Descarga la app de Prime Language.',
    'download_small' => 'el mundo en un solo clic.'
  ]
];
$siteLang = $_SESSION['site_lang'] ?? 'pt';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PrimeLanguage - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <?php include 'partials/helpers.php'; ?>
    <link rel="stylesheet" href="<?php echo asset('assets/css/styles.css'); ?>">
</head>
<body>
  <?php include 'partials/navbar.php'; ?>

  <main>
    <section class="hero-hero">
  <div class="container py-5">
        <div class="row align-items-center gy-4">
          <div class="col-lg-6 left" data-animate>
            <h1 class="display-5 mb-3"><?php echo $langs[$siteLang]['hero']; ?></h1>
            <p class="lead text-muted mb-4"><?php echo $langs[$siteLang]['desc']; ?></p>
            <div class="d-flex gap-3 mb-4">
              <a href="register.php" class="btn btn-lg btn-primary btn-animated btn-cta"><?php echo $langs[$siteLang]['cta']; ?></a>
              <a href="courses.php" class="btn btn-lg btn-outline-secondary btn-animated"><?php echo $langs[$siteLang]['courses']; ?></a>
            </div>
          </div>
          <div class="col-lg-6 text-center" data-animate>
            <img src="<?php echo asset('assets/img/capaprimehero.svg'); ?>" alt="hero" style="width:100%;height:100%;object-fit:cover;display:block;margin-top:60px;">
          </div>
        </div>
      </div>
    </section>
    
    
    <section class="mt-5 text-center">
  <h3 class="mb-4" style="padding-left:64px;padding-right:64px;"><?php echo $langs[$siteLang]['learn_today']; ?></h3>
  <div class="container" style="padding-left:32px;padding-right:32px;">
        <div class="d-flex justify-content-center flex-wrap gap-3">
          <?php $chipLangs = ['Inglês'=>'assets/img/flag-en.png','Mandarim'=>'assets/img/flag-zh.png','Alemão'=>'assets/img/flag-de.png','Espanhol'=>'assets/img/flag-es.png','Coreano'=>'assets/img/flag-ko.png','Russo'=>'assets/img/flag-ru.png','Japonês'=>'assets/img/flag-ja.png','Italiano'=>'assets/img/flag-it.png','Francês'=>'assets/img/flag-fr.png'];
            foreach($chipLangs as $label=>$img): ?>
            <a class="pill-chip d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-light shadow-sm" href="courses.php?lang=<?php echo urlencode($label); ?>">
              <img src="<?php echo asset($img); ?>" alt="<?php echo $label; ?>" width="28">
              <span class="small fw-semibold"><?php echo $label; ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    <section class="mt-5">
  <h4 class="mb-4" style="padding-left:64px;padding-right:64px;"><?php echo $langs[$siteLang]['differential']; ?></h4>
  <div class="row g-4" style="padding-left:32px;padding-right:32px;">
        <div class="col-md-4">
          <div class="feature-card p-4 rounded-3 shadow-sm text-center h-100">
            <img src="<?php echo asset('assets/img/feature-1.svg'); ?>" alt="Professores" class="mb-3" width="84">
            <h6>Professores capacitados</h6>
            <p class="small text-muted">Professores capacitados e especialistas prontos para te auxiliar.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 rounded-3 shadow-sm text-center h-100">
            <img src="<?php echo asset('assets/img/feature-2.svg'); ?>" alt="Exercícios" class="mb-3" width="84">
            <h6>Exercícios dinâmicos</h6>
            <p class="small text-muted">Exercícios dinâmicos, jogos de palavras e desafios diários.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 rounded-3 shadow-sm text-center h-100">
            <img src="<?php echo asset('assets/img/feature-3.svg'); ?>" alt="Gamificação" class="mb-3" width="84">
            <h6>Acumule pontos</h6>
            <p class="small text-muted">Acumule pontos, conquiste medalhas e desbloqueie níveis.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-5 reviews-section">
  <h4 class="mb-4" style="padding-left:64px;padding-right:64px;"><?php echo $langs[$siteLang]['review_title']; ?></h4>
  <div class="row g-4 align-items-stretch" style="padding-left:32px;padding-right:32px;">
        <div class="col-md-4">
          <div class="review-card review-blue p-4 rounded-4 h-100">
            <div class="d-flex align-items-start gap-3 mb-2">
              <img src="<?php echo asset('assets/img/usuarioroger.png'); ?>" alt="Roger" class="review-avatar">
              <div>
                <strong class="review-name">Roger</strong>
                <div class="small review-meta">Aprendeu <span class="lang-pill-mini">Inglês</span></div>
              </div>
            </div>
            <div class="quote-mark">“</div>
            <p class="review-text">As atividades realmente me permitem praticar conversas do mundo real e receber feedback de falantes fluentes.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card review-teal p-4 rounded-4 h-100">
            <div class="d-flex align-items-start gap-3 mb-2">
              <img src="<?php echo asset('assets/img/usuarioluciana.png'); ?>" alt="Luciana H." class="review-avatar">
              <div>
                <strong class="review-name">Luciana H.</strong>
                <div class="small review-meta">Aprendeu <span class="lang-pill-mini">Espanhol</span></div>
              </div>
            </div>
            <div class="quote-mark">“</div>
            <p class="review-text">Eu precisava de uma plataforma confiável para aperfeiçoar meu espanhol, e a Prime foi a escolha certa!</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card review-green p-4 rounded-4 h-100">
            <div class="d-flex align-items-start gap-3 mb-2">
              <img src="<?php echo asset('assets/img/usuariogabriel.png'); ?>" alt="Gabriel" class="review-avatar">
              <div>
                <strong class="review-name">Gabriel</strong>
                <div class="small review-meta">Aprendeu <span class="lang-pill-mini">Francês</span></div>
              </div>
            </div>
            <div class="quote-mark">“</div>
            <p class="review-text">Eu nem soube descrever como minha vida mudou desde que comecei a usar a Prime.</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-4">
        <a href="register.php" class="btn btn-success btn-lg" data-i18n="Comece agora!">Comece agora!</a>
      </div>
    </section>

    <section class="mt-5 mb-5">
      <div class="download-cta rounded-4 p-5 text-center text-white mx-auto" style="max-width:900px;padding-left:32px;padding-right:32px;">
  <h5 class="mb-2"><?php echo $langs[$siteLang]['download_title']; ?></h5>
  <h2 class="cta-large mb-2"><?php echo $langs[$siteLang]['download_sub']; ?></h2>
  <p class="lead mb-4"><?php echo $langs[$siteLang]['download_desc']; ?></p>
        <div class="d-flex justify-content-center gap-4 mb-3">
          <a href="#" class="d-inline-block"><img src="<?php echo asset('assets/img/badge-playstore.png'); ?>" alt="Google Play" width="170"></a>
          <a href="#" class="d-inline-block"><img src="<?php echo asset('assets/img/badge-appstore.png'); ?>" alt="App Store" width="170"></a>
        </div>
  <div class="small"><?php echo $langs[$siteLang]['download_small']; ?></div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <!-- Language selector -->
        <div class="footer-col lang-col">
          <div class="fw-bold mb-2">Idioma de exibição</div>
          <form method="post" class="lang-select d-flex align-items-center gap-2" style="margin-bottom:0;">
            
            
            
              <?php foreach($langs as $key=>$info): ?>
                <option value="<?php echo $key; ?>" <?php if($siteLang===$key) echo 'selected'; ?> data-label="<?php echo $info['label']; ?>" data-flag="<?php echo $info['flag']; ?>"><?php echo $info['label']; ?></option>
              <?php endforeach; ?>
            </select>
          </form>
        </div>
        <div class="vertical-sep"></div>
        <!-- About -->
        <div class="footer-col">
          <h6>Sobre nós</h6>
          <ul class="list-unstyled links">
            <li><small>Cursos</small></li>
            <li><small>Método</small></li>
            <li><small>Equipe</small></li>
            <li><small>Parceiros</small></li>
            <li><small>História</small></li>
            <li><small>Missão</small></li>
          </ul>
        </div>
        <div class="vertical-sep"></div>
        <!-- Plans -->
        <div class="footer-col">
          <h6>Planos</h6>
          <ul class="list-unstyled links">
            <li><small>Planos para usuários</small></li>
            <li><small>Planos para empresas</small></li>
            <li><small>Planos universitários</small></li>
          </ul>
        </div>
        <div class="vertical-sep"></div>
        <!-- Help -->
        <div class="footer-col">
          <h6>Ajuda e suporte</h6>
          <ul class="list-unstyled links">
            <li><small>Dúvidas</small></li>
            <li><small>Contato</small></li>
            <li><small>SAC</small></li>
          </ul>
        </div>
        <div class="vertical-sep"></div>
        <!-- Partners & Social -->
        <div class="footer-col partners-col text-end">
          <h6>Conecte-se conosco!</h6>
          <div class="d-flex justify-content-end align-items-center gap-3 mb-3">
            <img src="assets/img/ibm.png" alt="IBM" style="max-width:60px;">
            <img src="assets/img/cps.png" alt="CPS" style="max-width:60px;">
          </div>
          <div class="copyright">©2025 Prime Language</div>
        </div>
      </div>
    </div>
    <script>
    </script>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo asset('assets/js/main.js'); ?>"></script>
</body>
</html>
