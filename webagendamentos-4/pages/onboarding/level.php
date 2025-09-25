<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quase lá!</title>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background: #f6f7fb;
      font-family: 'Josefin Sans', Arial, sans-serif !important;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .onboarding-container {
      max-width: 480px;
      margin: auto;
      background: none;
      text-align: center;
      padding: 0 16px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 80vh;
    }
    .onboarding-back {
      position: absolute;
      left: 32px;
      top: 24px;
      background: #fff;
      border-radius: 50%;
      box-shadow: 0 2px 12px #0001;
      width: 44px;
      height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      border: none;
      outline: none;
      font-size: 1.6rem;
      transition: box-shadow .2s, background .2s;
      z-index: 2;
    }
    .onboarding-back:hover {
      box-shadow: 0 4px 24px #5fc4b055;
      background: #f6f7fb;
    }
    .onboarding-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-top: 32px;
      margin-bottom: 8px;
      color: #222;
      letter-spacing: 0.5px;
    }
    .onboarding-sub {
      font-size: 1.18rem;
      color: #222;
      margin-bottom: 32px;
      font-weight: 400;
    }
    .level-btns {
      display: flex;
      gap: 32px;
      justify-content: center;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }
    .level-btn {
      background: #fff;
      border: 2px solid #e9e7fb;
      border-radius: 18px;
      font-family: 'Josefin Sans', Arial, sans-serif !important;
      font-size: 1.15rem;
      font-weight: 600;
      color: #222;
      padding: 24px 32px;
      min-width: 160px;
      box-shadow: 0 2px 12px #0001;
      cursor: pointer;
      outline: none;
      transition: background .3s, color .3s, box-shadow .3s, border-color .3s, transform .3s;
      opacity: 0.92;
      position: relative;
      margin-bottom: 16px;
    }
    .level-btn:hover {
      background: #e9e7fb;
      color: #5fc4b0;
      box-shadow: 0 4px 24px #5fc4b033;
      transform: scale(1.04);
      opacity: 1;
      border-color: #5fc4b0;
    }
    .level-btn.selected {
      background: #ededed;
      color: #888;
      border-color: #bbb;
      box-shadow: 0 2px 12px #bbb2;
      opacity: 1;
      transform: scale(1.01);
    }
    .continue-btn {
      background: #5fc4b0;
      color: #fff;
      font-family: 'Josefin Sans', Arial, sans-serif !important;
      font-size: 1.15rem;
      font-weight: 700;
      border-radius: 18px;
      border: none;
      padding: 16px 48px;
      margin-top: 16px;
      box-shadow: 0 2px 12px #5fc4b033;
      cursor: pointer;
      outline: none;
      transition: background .3s, box-shadow .3s, transform .3s, opacity .3s;
      opacity: 0.7;
      pointer-events: none;
    }
    .continue-btn.enabled {
      opacity: 1;
      pointer-events: auto;
      background: linear-gradient(90deg,#5fc4b0 0%,#7ed6df 100%);
      box-shadow: 0 4px 24px #7ed6df33;
      transform: scale(1.04);
    }
    .continue-btn:hover.enabled {
      background: linear-gradient(90deg,#7ed6df 0%,#5fc4b0 100%);
      box-shadow: 0 8px 32px #7ed6df99;
      transform: scale(1.08);
    }
    .progress-bar {
      width: 100%;
      max-width: 340px;
      height: 12px;
      background: #e0e0e0;
      border-radius: 8px;
      margin: 48px auto 0 auto;
      overflow: hidden;
      position: relative;
    }
    .progress-bar-inner {
      height: 100%;
      background: #5fc4b0;
      border-radius: 8px;
      width: 72%;
      transition: width .6s cubic-bezier(.77,0,.18,1);
    }
    @media (max-width: 600px) {
      .level-btns {
        flex-direction: column;
        gap: 16px;
      }
      .onboarding-container {
        min-height: 70vh;
      }
    }
  </style>
</head>
<body>
      <a href="language.php" class="purpose-back-btn" style="width:48px;height:48px;display:inline-flex;align-items:center;justify-content:center;background:#fff;border-radius:50%;box-shadow:0 2px 8px rgba(22,22,60,0.08);margin-right:18px;text-decoration:none;border:0;">
      <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="14" fill="#e6f7f2"/><path d="M17.5 21L11 14L17.5 7" stroke="#2b8a7b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  <div class="onboarding-container">
    <div class="onboarding-title">Quase lá!</div>
    <div class="onboarding-sub">Qual o seu nível de Inglês?</div>
    <div class="level-btns">
  <button class="level-btn" id="btn-beginner">Começar do início</button>
  <button class="level-btn" id="btn-test">Realize o Teste!</button>
    </div>
  <button class="continue-btn" id="btn-continue">Continuar</button>
    <div class="progress-bar">
      <div class="progress-bar-inner"></div>
    </div>
  </div>
  <script>
    document.body.style.fontFamily = "'Josefin Sans', Arial, sans-serif";
    const btns = document.querySelectorAll('.level-btn');
    const continueBtn = document.getElementById('btn-continue');
    let selected = null;
    btns.forEach(btn => {
      btn.onclick = function() {
        btns.forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        continueBtn.classList.add('enabled');
        continueBtn.disabled = false;
        continueBtn.style.pointerEvents = 'auto';
        selected = btn.id;
        // Se clicar em "Começar do início", já vai direto para cursos.php
        if (btn.id === 'btn-beginner') {
          setTimeout(function() {
            window.location.href = '../courses.php?start=beginner';
          }, 250);
        }
      };
    });
    continueBtn.onclick = function() {
      if (document.querySelector('.level-btn.selected')) {
        // Se "Começar do início" estiver selecionado, vai para cursos.php
        if (selected === 'btn-beginner') {
          window.location.href = '../courses.php?start=beginner';
        } else if (selected === 'btn-test') {
          window.location.href = 'test.php';
        }
      }
    };
  </script>
</body>
</html>
