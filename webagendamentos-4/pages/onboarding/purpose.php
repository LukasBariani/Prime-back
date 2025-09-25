<?php
require_once __DIR__ . '/../partials/helpers.php';
// Ensure language selected (optional)
if (empty($_SESSION['onboarding']['language'])) {
    // allow going back to language selection
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purpose = $_POST['purpose'] ?? '';
    if ($purpose) {
        if (!isset($_SESSION['onboarding'])) $_SESSION['onboarding'] = [];
        $_SESSION['onboarding']['purpose'] = $purpose;
        header('Location: level.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Por que aprender?</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo asset('assets/css/styles.css'); ?>">
  <style>
    body, h1, h2, h3, h4, h5, h6, .purpose-main, .purpose-header, .purpose-content, .purpose-card, .btn, .purpose-progress, .bar, button, label, input {
      font-family: 'Josefin Sans', Arial, sans-serif !important;
    }
    .purpose-card {
      opacity: 0.94;
      transform: scale(0.98);
      background: #fff;
      border-radius: 22px;
      box-shadow: 0 4px 24px rgba(22,22,60,0.10);
      border: 2px solid transparent;
      padding: 32px 0 24px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      cursor: pointer;
      margin: 0 12px 0 12px;
      min-width: 160px;
      max-width: 220px;
      width: 100%;
      transition: opacity .44s cubic-bezier(.22,.9,.5,1), transform .44s cubic-bezier(.22,.9,.5,1), box-shadow .44s, background .44s, border-color .44s;
      will-change: transform, box-shadow, background, border-color, opacity;
    }
    .purpose-card:hover {
      opacity: 1;
      transform: scale(1.08) translateY(-8px);
      box-shadow: 0 24px 56px rgba(43,138,123,0.18);
      background: #f7fafc;
      border-color: #bdbdbd;
      z-index: 2;
      filter: brightness(1.03);
    }
    .purpose-card.selected {
      opacity: 1;
      background: linear-gradient(180deg,#ededed 80%,#e6f7f2 100%);
      border-color: #bdbdbd;
      box-shadow: 0 8px 32px rgba(22,22,60,0.13);
      transform: scale(1.05);
      filter: none;
    }
    .purpose-card .purpose-label {
      margin-top: 8px;
      font-size: 1.08rem;
      font-weight: 600;
      color: #222;
      letter-spacing: 0.02em;
      transition: color .32s;
    }
    .purpose-card.selected .purpose-label {
      color: #2b8a7b;
    }
    .btn-continuar, .btn, button {
      font-family: 'Josefin Sans', Arial, sans-serif !important;
      transition: background .44s, box-shadow .44s, transform .44s, opacity .44s;
      box-shadow: 0 2px 12px rgba(24,180,138,0.08);
      font-weight: 700;
      letter-spacing: 0.02em;
    }
    .btn-continuar {
      font-size: 1.15rem;
      padding: 12px 48px;
      border-radius: 12px;
      background: linear-gradient(90deg,#2b8a7b,#18b48a);
      color: #fff;
      border: none;
      margin-top: 24px;
      opacity: 0.96;
    }
    .btn-continuar:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      filter: grayscale(0.3);
    }
    .btn-continuar:hover, .btn-continuar:focus {
      background: linear-gradient(90deg,#18b48a,#2b8a7b);
      box-shadow: 0 12px 40px rgba(24,180,138,0.22);
      transform: scale(1.045);
      opacity: 1;
      filter: brightness(1.08);
    }
    .btn-continuar:active {
      transform: scale(0.98);
      box-shadow: 0 2px 8px rgba(24,180,138,0.10);
    }
    .purpose-progress {
      width: 100%;
      height: 12px;
      background: #e6f7f2;
      border-radius: 8px;
      overflow: hidden;
      margin: 40px auto 0 auto;
      max-width: 480px;
      box-shadow: 0 2px 8px rgba(22,22,60,0.06);
    }
    .bar {
      width: 66%;
      height: 100%;
      background: linear-gradient(90deg,#2b8a7b,#18b48a);
      border-radius: 8px;
      transition: width .45s;
    }
    @media (max-width: 900px) {
      .purpose-grid { grid-template-columns: repeat(2,1fr); gap: 18px; }
      .purpose-content { max-width: 98vw; }
    }
    @media (max-width: 600px) {
      .purpose-grid { grid-template-columns: 1fr; gap: 12px; }
      .purpose-content { max-width: 100vw; }
      .purpose-header { padding-left: 8px; }
    }
  </style>
</head>
<body>
<main class="purpose-main">
  <div class="purpose-header" style="display: flex; align-items: center; justify-content: flex-start; padding: 32px 0 0 32px;">
    <a href="language.php" class="purpose-back-btn" style="width:48px;height:48px;display:inline-flex;align-items:center;justify-content:center;background:#fff;border-radius:50%;box-shadow:0 2px 8px rgba(22,22,60,0.08);margin-right:18px;text-decoration:none;border:0;">
      <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="14" fill="#e6f7f2"/><path d="M17.5 21L11 14L17.5 7" stroke="#2b8a7b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
  <div class="purpose-content" style="max-width:700px;margin:0 auto;text-align:center;">
    <h3 class="purpose-title" style="font-size:2rem;font-weight:700;margin:32px 0 36px 0;color:#222;font-family:'Josefin Sans',Arial,sans-serif;">Por que você deseja aprender <?php echo htmlentities($_SESSION['onboarding']['language'] ?? 'esse idioma'); ?> conosco?</h3>
    <form method="post">
      <div class="purpose-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:32px;justify-items:center;align-items:center;margin-bottom:32px;">
        <?php
        $purposes = [
          ['Trabalho', 'briefcase'],
          ['Cultura', 'book-open'],
          ['Passar o tempo', 'coffee'],
          ['Estudos', 'book'],
          ['Viagens', 'paper-plane'],
          ['Comunicação', 'message'],
        ];
        foreach($purposes as $p): ?>
          <label class="purpose-card" style="background:#fff;border-radius:22px;box-shadow:0 2px 12px rgba(22,22,60,0.07);padding:32px 0 24px 0;display:flex;flex-direction:column;align-items:center;cursor:pointer;transition:box-shadow .32s,transform .32s,background .32s;font-size:1.15rem;font-family:'Josefin Sans',Arial,sans-serif;margin:0 12px 0 12px;min-width:160px;max-width:220px;width:100%;border:2px solid transparent;opacity:0.98;">
            <input type="radio" name="purpose" value="<?php echo htmlentities($p[0]); ?>" style="display:none;">
            <span class="purpose-icon" style="width:48px;height:48px;margin-bottom:12px;display:flex;align-items:center;justify-content:center;">
              <?php
              // SVG icons inline for each purpose
              switch($p[1]) {
                case 'briefcase':
                  echo '<svg width="40" height="40" fill="none" stroke="#222" stroke-width="2.2" viewBox="0 0 32 32"><rect x="7" y="12" width="18" height="12" rx="4"/><path d="M11 12V9a5 5 0 0 1 10 0v3"/></svg>';
                  break;
                case 'book-open':
                  echo '<svg width="40" height="40" fill="none" stroke="#222" stroke-width="2.2" viewBox="0 0 32 32"><path d="M6 8v16a2 2 0 0 0 2 2h7V8H8a2 2 0 0 0-2 2zm20 0v16a2 2 0 0 1-2 2h-7V8h7a2 2 0 0 1 2 2z"/></svg>';
                  break;
                case 'coffee':
                  echo '<svg width="40" height="40" fill="none" stroke="#222" stroke-width="2.2" viewBox="0 0 32 32"><rect x="8" y="12" width="16" height="10" rx="5"/><path d="M24 16a4 4 0 0 0 4-4V12"/></svg>';
                  break;
                case 'book':
                  echo '<svg width="40" height="40" fill="none" stroke="#222" stroke-width="2.2" viewBox="0 0 32 32"><rect x="6" y="8" width="20" height="16" rx="3"/><path d="M16 8v16"/></svg>';
                  break;
                case 'paper-plane':
                  echo '<svg width="40" height="40" fill="none" stroke="#222" stroke-width="2.2" viewBox="0 0 32 32"><path d="M4 28L28 16L4 4L8 16L4 28Z"/></svg>';
                  break;
                case 'message':
                  echo '<svg width="40" height="40" fill="none" stroke="#222" stroke-width="2.2" viewBox="0 0 32 32"><rect x="6" y="8" width="20" height="16" rx="4"/><path d="M10 16h12"/></svg>';
                  break;
              }
              ?>
            </span>
            <div class="purpose-label" style="margin-top:8px;font-size:1.08rem;font-weight:600;color:#222;letter-spacing:0.02em;"><?php echo $p[0]; ?></div>
          </label>
        <?php endforeach; ?>
      </div>
      <button class="btn-continuar" type="submit" id="btn-continuar" disabled style="font-size:1.15rem;padding:12px 48px;border-radius:12px;background:linear-gradient(90deg,#2b8a7b,#18b48a);color:#fff;border:none;box-shadow:0 2px 12px rgba(24,180,138,0.08);font-weight:700;letter-spacing:0.02em;font-family:'Josefin Sans',Arial,sans-serif !important;transition:background .35s,box-shadow .32s,transform .32s,opacity .32s;opacity:0.96;margin-top:24px;">Continuar</button>
      <div class="purpose-progress" style="width:100%;height:12px;background:#e6f7f2;border-radius:8px;overflow:hidden;margin:40px auto 0 auto;max-width:480px;">
        <div class="bar" style="width:66%;height:100%;background:linear-gradient(90deg,#2b8a7b,#18b48a);border-radius:8px;transition:width .45s;"></div>
      </div>
    </form>
  </div>
</main>
<script>
// Ultra professional animation and selection logic
const cards = document.querySelectorAll('.purpose-card');
const radios = document.querySelectorAll('.purpose-card input[type="radio"]');
const btnContinuar = document.getElementById('btn-continuar');
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
    btnContinuar.disabled = false;
  });
  // Also allow keyboard selection
  card.querySelector('input[type="radio"]').addEventListener('change', function() {
    cards.forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
    btnContinuar.disabled = false;
  });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo asset('assets/js/main.js'); ?>"></script>
</body>
</html>
