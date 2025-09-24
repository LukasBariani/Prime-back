<?php
session_start();
$user = [
  'name' => 'João Silva',
  'location' => 'São Paulo, Brasil',
  'language' => 'Inglês',
  'streak' => 12,
  'words' => 134,
  'bio' => 'Apaixonado por idiomas e tecnologia. Sempre aprendendo!',
  'avatar' => 'assets/img/usuariowang.png'
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil — PrimeLanguage</title>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
  <style>
    html, body, * {
      font-family: 'Josefin Sans', Arial, sans-serif !important;
      box-sizing: border-box;
    }
    body {
      background: #f6f7fb;
      margin: 0;
      padding: 0;
    }
    .profile-header {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      margin-top: 40px;
      margin-bottom: 24px;
      width: 100%;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }
    .profile-logo {
      flex: 1 1 0;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      min-width: 120px;
    }
    .profile-logo img {
      height: 48px;
      width: auto;
      filter: drop-shadow(0 2px 8px #5fc4b033);
      transition: filter .3s;
    }
    .profile-header-center {
      flex: 2 1 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .btn-voltar-cursos {
      font-family: 'Josefin Sans', Arial, sans-serif;
      font-weight: 700;
      padding: 14px 44px;
      border-radius: 18px;
      background: linear-gradient(90deg,#5fc4b0 0%,#7ed6df 100%);
      color: #fff;
      box-shadow: 0 4px 32px #5fc4b033;
      border: none;
      outline: none;
      font-size: 1.18rem;
      cursor: pointer;
      transition: background .3s, box-shadow .3s, transform .2s, opacity .2s;
      opacity: 0.97;
      text-decoration: none;
      display: inline-block;
      animation: fadeInUp .7s cubic-bezier(.77,0,.18,1);
    }
    .btn-voltar-cursos:hover {
      background: linear-gradient(90deg,#7ed6df 0%,#5fc4b0 100%);
      box-shadow: 0 8px 40px #7ed6df55;
      transform: scale(1.06);
      opacity: 1;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(32px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .profile-card {
      max-width: 440px;
      margin: 0 auto;
      background: #fff;
      border-radius: 32px;
      box-shadow: 0 4px 32px #5fc4b033;
      padding: 40px 32px 32px 32px;
      text-align: center;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      animation: fadeIn .7s cubic-bezier(.77,0,.18,1);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .profile-avatar {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 2px 16px #5fc4b033;
      margin-bottom: 16px;
      background: #f6f7fb;
      border: 3px solid #e9e7fb;
    }
    .profile-name {
      font-size: 1.35rem;
      font-weight: 700;
      color: #222;
      margin-bottom: 4px;
    }
    .profile-location {
      font-size: 1rem;
      color: #5fc4b0;
      margin-bottom: 12px;
    }
    .profile-info {
      display: flex;
      justify-content: center;
      gap: 24px;
      margin-bottom: 18px;
      flex-wrap: wrap;
    }
    .profile-info-item {
      background: #f6f7fb;
      border-radius: 14px;
      padding: 10px 18px;
      font-size: 1.05rem;
      color: #222;
      min-width: 110px;
      box-shadow: 0 2px 8px #0001;
      font-weight: 600;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .profile-info-label {
      font-size: 0.92rem;
      color: #888;
      font-weight: 400;
      margin-bottom: 2px;
    }
    .profile-bio {
      margin-top: 10px;
      font-size: 1.08rem;
      color: #444;
      background: #f6f7fb;
      border-radius: 12px;
      padding: 12px 16px;
      min-height: 48px;
      width: 100%;
      box-sizing: border-box;
      border: 1px solid #e9e7fb;
      resize: none;
      transition: box-shadow .2s;
    }
    .profile-bio:focus {
      box-shadow: 0 2px 12px #5fc4b033;
      outline: none;
      border-color: #5fc4b0;
    }
    .profile-bio-save {
      margin-top: 8px;
      background: #5fc4b0;
      color: #fff;
      font-family: 'Josefin Sans', Arial, sans-serif !important;
      font-size: 1rem;
      font-weight: 700;
      border-radius: 12px;
      border: none;
      padding: 8px 32px;
      box-shadow: 0 2px 12px #5fc4b033;
      cursor: pointer;
      outline: none;
      transition: background .3s, box-shadow .3s, transform .3s, opacity .3s;
      opacity: 0.9;
    }
    .profile-bio-save:hover {
      background: linear-gradient(90deg,#5fc4b0 0%,#7ed6df 100%);
      box-shadow: 0 4px 24px #7ed6df33;
      transform: scale(1.04);
      opacity: 1;
    }
    @media (max-width: 600px) {
      .profile-header { flex-direction: column; gap: 12px; }
      .profile-logo { justify-content: center; }
      .profile-header-center { justify-content: center; }
      .profile-card { padding: 24px 8px; }
      .profile-info { gap: 12px; }
    }
  </style>
</head>
<body>
  <div class="profile-header">
    <div class="profile-logo">
      <a href="index.php"><img src="assets/img/prime-logo.png" alt="Prime Language" /></a>
    </div>
  </div>
  <div class="profile-header-center">
    <a href="courses.php" class="btn-voltar-cursos">← Voltar para Cursos</a>
  </div>
  <main>
    <div class="profile-card">
      <img src="<?php echo isset($_SESSION['avatar']) ? htmlentities($_SESSION['avatar']) : $user['avatar']; ?>" alt="Avatar" class="profile-avatar" />
      <div class="profile-name"><?php echo isset($_SESSION['name']) ? htmlentities($_SESSION['name']) : $user['name']; ?></div>
      <div class="profile-location"><?php echo isset($_SESSION['location']) ? htmlentities($_SESSION['location']) : $user['location']; ?></div>
      <div class="profile-info">
        <div class="profile-info-item">
          <span class="profile-info-label">Idioma</span>
          <?php echo isset($_SESSION['language']) ? htmlentities($_SESSION['language']) : $user['language']; ?>
        </div>
        <div class="profile-info-item">
          <span class="profile-info-label">Streak</span>
          <?php echo isset($_SESSION['streak']) ? htmlentities($_SESSION['streak']) : $user['streak']; ?> dias
        </div>
        <div class="profile-info-item">
          <span class="profile-info-label">Palavras</span>
          <?php echo isset($_SESSION['words']) ? htmlentities($_SESSION['words']) : $user['words']; ?> aprendidas
        </div>
      </div>
      <form method="post" id="bio-form" style="width:100%;margin-top:18px;">
        <textarea name="bio" class="profile-bio" id="profile-bio" rows="2" maxlength="180" spellcheck="true" placeholder="Sua bio..."><?php echo isset($_SESSION['bio']) ? htmlentities($_SESSION['bio']) : $user['bio']; ?></textarea>
        <button type="submit" class="profile-bio-save">Salvar bio</button>
      </form>
    </div>
  </main>
  <script>
    // Bio edit/save animation
    const bioForm = document.getElementById('bio-form');
    bioForm.onsubmit = function(e) {
      e.preventDefault();
      const btn = bioForm.querySelector('.profile-bio-save');
      btn.textContent = 'Salvando...';
      btn.disabled = true;
      setTimeout(function() {
        btn.textContent = 'Salvo!';
        btn.disabled = false;
        setTimeout(function() { btn.textContent = 'Salvar bio'; }, 1200);
      }, 900);
    };
  </script>
</body>
</html>