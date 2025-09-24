<?php
require_once __DIR__ . '/../partials/helpers.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lang = $_POST['language'] ?? '';
    if ($lang) {
        if (!isset($_SESSION['onboarding'])) $_SESSION['onboarding'] = [];
        $_SESSION['onboarding']['language'] = $lang;
        header('Location: purpose.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Escolha de idioma</title>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo asset('assets/css/styles.css'); ?>">
  <style>
    body, .onboard-main, .onboard-header, .onboard-content, h3, .onboard-lang-card, .btn, .onboard-progress, .bar {
      font-family: 'Josefin Sans', Arial, sans-serif !important;
    }
    .onboard-lang-grid {
      display: grid;
      grid-template-columns: repeat(3,1fr);
      gap: 32px;
      justify-items: center;
      align-items: center;
    }
    .onboard-lang-card {
  background: #fff;
  border-radius: 22px;
  box-shadow: 0 2px 12px rgba(22,22,60,0.08);
  padding: 32px 0 18px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: box-shadow .32s, transform .32s, background .32s;
  position: relative;
  border: 2px solid transparent;
  opacity: 0.98;
  min-width: 240px;
  max-width: 340px;
  width: 90%;
    }
    .onboard-lang-card:hover {
      box-shadow: 0 12px 32px rgba(43,138,123,0.14);
      transform: scale(1.06) translateY(-4px);
      opacity: 1;
      z-index: 2;
    }
    .onboard-lang-card.selected {
      background: #f2f2f2;
      border-color: #bdbdbd;
      box-shadow: 0 2px 12px rgba(22,22,60,0.08);
      opacity: 1;
    }
    .onboard-lang-card input[type="radio"] {
      display: none;
    }
    .onboard-lang-card img {
      width: 72px;
      height: 72px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 2px 8px rgba(22,22,60,0.10);
      transition: box-shadow .32s, transform .32s;
    }
    .onboard-lang-card.selected img {
      box-shadow: 0 0 0 4px #bdbdbd;
      transform: scale(1.08);
    }
    .onboard-lang-card .lang-label {
      margin-top: 14px;
      font-size: 1.08rem;
      font-weight: 600;
      color: #222;
      letter-spacing: 0.02em;
    }
    .btn-continuar {
      font-size: 1.15rem;
      padding: 12px 48px;
      border-radius: 12px;
      background: linear-gradient(90deg,#2b8a7b,#18b48a);
      color: #fff;
      border: none;
      box-shadow: 0 2px 12px rgba(24,180,138,0.08);
      font-weight: 700;
      letter-spacing: 0.02em;
      transition: background .35s, box-shadow .32s, transform .32s, opacity .32s;
      opacity: 0.96;
    }
    .btn-continuar:hover, .btn-continuar:focus {
      background: linear-gradient(90deg,#18b48a,#2b8a7b);
      box-shadow: 0 8px 32px rgba(24,180,138,0.18);
      transform: scale(1.04);
      opacity: 1;
    }
    .btn-continuar:active {
      transform: scale(0.98);
      box-shadow: 0 2px 8px rgba(24,180,138,0.10);
    }
    .onboard-progress {
      width: 100%;
      height: 12px;
      background: #e6f7f2;
      border-radius: 8px;
      overflow: hidden;
      margin: 40px auto 0 auto;
      max-width: 480px;
    }
    .bar {
      width: 33%;
      height: 100%;
      background: linear-gradient(90deg,#2b8a7b,#18b48a);
      border-radius: 8px;
      transition: width .45s;
    }
    @media (max-width: 900px) {
      .onboard-lang-grid { grid-template-columns: repeat(2,1fr); gap: 18px; }
      .onboard-content { max-width: 98vw; }
    }
    @media (max-width: 600px) {
      .onboard-lang-grid { grid-template-columns: 1fr; gap: 12px; }
      .onboard-content { max-width: 100vw; }
      .onboard-header { padding-left: 8px; }
    }
  </style>
</head>
<body>


<main class="onboard-main" style="background: #f6f7fb; min-height: 100vh;">
  <div class="onboard-header" style="display: flex; align-items: center; justify-content: flex-start; padding: 32px 0 0 32px;">
    <a href="../index.php" class="onboard-back-btn" style="width:48px;height:48px;display:inline-flex;align-items:center;justify-content:center;background:#fff;border-radius:50%;box-shadow:0 2px 8px rgba(22,22,60,0.08);margin-right:18px;text-decoration:none;border:0;">
      <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="14" fill="#e6f7f2"/><path d="M17.5 21L11 14L17.5 7" stroke="#2b8a7b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
  <div class="onboard-content" style="max-width:700px;margin:0 auto;text-align:center;">
    <h3 style="font-size:2rem;font-weight:700;margin:32px 0 36px 0;color:#222;">Qual desses será seu próximo idioma?</h3>
    <form method="post">
      <div class="onboard-lang-grid">
        <?php
        $langs = [
          'Inglês'=>'../assets/img/flag-en.png',
          'Francês'=>'../assets/img/flag-fr.png',
          'Chinês'=>'../assets/img/flag-zh.png',
          'Japonês'=>'../assets/img/flag-ja.png',
          'Alemão'=>'../assets/img/flag-de.png',
          'Espanhol'=>'../assets/img/flag-es.png',
          'Coreano'=>'../assets/img/flag-ko.png',
          'Italiano'=>'../assets/img/flag-it.png',
          'Russo'=>'../assets/img/flag-ru.png',
        ];
        foreach($langs as $label=>$img): ?>
          <label class="onboard-lang-card">
            <input type="radio" name="language" value="<?php echo htmlentities($label); ?>">
            <img src="<?php echo asset($img); ?>" alt="<?php echo $label; ?>">
            <div class="lang-label"><?php echo $label; ?></div>
          </label>
        <?php endforeach; ?>
      </div>
      <div style="text-align:center;margin:40px 0 0 0;">
        <button class="btn-continuar" type="submit">Continuar</button>
      </div>
      <div class="onboard-progress">
        <div class="bar"></div>
      </div>
    </form>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Ultra professional animation and selection logic
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('.onboard-lang-card');
  const radios = document.querySelectorAll('.onboard-lang-card input[type="radio"]');
  cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.zIndex = 2;
    });
    card.addEventListener('mouseleave', () => {
      card.style.zIndex = '';
    });
    card.addEventListener('click', function(e) {
      radios.forEach(r => {
        r.checked = false;
        r.parentElement.classList.remove('selected');
      });
      const radio = card.querySelector('input[type="radio"]');
      radio.checked = true;
      card.classList.add('selected');
    });
    // Also allow keyboard selection
    card.querySelector('input[type="radio"]').addEventListener('change', function() {
      cards.forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
    });
  });
});
</script>
</body>
</html>
