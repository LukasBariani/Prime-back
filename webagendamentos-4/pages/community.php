<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Comunidade</title>
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
  <!-- Navbar animada customizada -->
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
      <a href="courses.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none" style="color:#222;font-weight:600;transition:all .4s cubic-bezier(.77,0,.18,1);position:relative;">
        Cursos
        <span class="wow-underline"></span>
      </a>
      <a href="community.php" class="wow-nav-link px-4 py-2 rounded-4 text-decoration-none active" style="background:linear-gradient(90deg,#5fc4b0 0%,#7ed6df 100%);color:#fff;box-shadow:0 2px 12px #7ed6df33;font-weight:700;letter-spacing:0.5px;transition:background .4s,box-shadow .4s;border:none;outline:none;position:relative;">
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
    <?php
      
      $friends = [
        ['name'=>'Luciana Ramos','lang'=>'Italiano','level'=>'B1','last_message'=>'Vamos praticar ontem?','avatar'=>'assets/img/usuarioluciana.png','active'=>true],
        ['name'=>'Gabriel Souza','lang'=>'Inglês','level'=>'B2','last_message'=>'Posso te ajudar com pronúncia','avatar'=>'assets/img/usuariogabriel.png','active'=>false],
        ['name'=>'Roger Lima','lang'=>'Espanhol','level'=>'A2','last_message'=>'Que tal uma conversa rápida?','avatar'=>'assets/img/usuarioroger.png','active'=>true]
      ];

      $discover = [
        ['name'=>'Wang Zhelin','lang'=>'Italiano','level'=>'B1','desc'=>'Entusiasta de cultura, adora conversar sobre cinema.','avatar'=>'assets/img/casal.png','since'=>'3 semanas','img'=>'assets/img/usuariowang.png'],
        ['name'=>'Taneisha Bailey','lang'=>'Espanhol','level'=>'A2','desc'=>'Gosta de trocar mensagens e praticar gramática.','avatar'=>'assets/img/instagram.png','since'=>'2 semanas','img'=>'assets/img/usuariotanesha.png'],
        ['name'=>'Miguel Hernandez','lang'=>'Japonês','level'=>'C1','desc'=>'Professor de japonês, oferece correções amigáveis.','avatar'=>'assets/img/facebook.png','since'=>'1 mês','img'=>'assets/img/usuariomiguel.png'],
        ['name'=>'Robert Andrich','lang'=>'Inglês','level'=>'B2','desc'=>'Viaja muito e pratica conversas do dia a dia.','avatar'=>'assets/img/linkedin.png','since'=>'4 dias','img'=>'assets/img/usuariorobert.png'],
        ['name'=>'John Peterson','lang'=>'Português','level'=>'C1','desc'=>'Intercambista; fala sobre empregos e entrevistas.','avatar'=>'assets/img/youtube.png','since'=>'6 dias','img'=>'assets/img/usuariojohn.png'],
        ['name'=>'Maria Eduarda','lang'=>'Francês','level'=>'A2','desc'=>'Procura parceiros de conversação para praticar.','avatar'=>'assets/img/travel.png','since'=>'2 meses','img'=>'assets/img/usuariomaria.png'],
        ['name'=>'Aisha Karim','lang'=>'Árabe','level'=>'A1','desc'=>'Nova na cidade, busca amigos para praticar o básico.','avatar'=>'assets/img/flag-ar.png','since'=>'1 semana','img'=>'assets/img/usuarioaisha.png'],
        ['name'=>'Luca Bianchi','lang'=>'Italiano','level'=>'B2','desc'=>'Estudante universitário, interessado em cultura e música.','avatar'=>'assets/img/flag-it.png','since'=>'2 semanas','img'=>'assets/img/usuarioluca.png'],
        ['name'=>'Sofia Ivanova','lang'=>'Russo','level'=>'A2','desc'=>'Procura parceiros para prática de conversação informal.','avatar'=>'assets/img/flag-ru.png','since'=>'3 dias','img'=>'assets/img/usuariosofia.png'],
        ['name'=>'Chen Wei','lang'=>'Chinês','level'=>'B1','desc'=>'Intercâmbio recente, quer praticar pronúncia e vocabulário.','avatar'=>'assets/img/flag-zh.png','since'=>'5 dias','img'=>'assets/img/usuariochen.png']
      ];
    ?>

    <div class="community-wrap p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Comunidade</h2>
        <div class="btn-group" role="tablist" aria-label="Community tabs">
          <button class="btn btn-outline-secondary btn-sm active" id="tab-friends" data-target="#friends-screen" type="button">Amigos</button>
          <button class="btn btn-outline-secondary btn-sm" id="tab-discover" data-target="#discover-screen" type="button">Descobrir</button>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <!-- Friends panel -->
          <section id="friends-screen" class="screen" role="tabpanel">
            <div class="mb-3 small text-muted">Converse com seus amigos, veja quem está online e acompanhe o progresso.</div>
            <div class="list-group">
              <?php foreach($friends as $f): ?>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center friend-item" data-name="<?php echo htmlentities($f['name']); ?>">
                  <img src="<?php echo asset($f['avatar']); ?>" alt="avatar" class="avatar-img me-3">
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                      <div>
                        <strong><?php echo htmlentities($f['name']); ?></strong>
                        <div class="small text-muted"><?php echo htmlentities($f['lang']); ?> • Nível <?php echo htmlentities($f['level']); ?></div>
                      </div>
                      <div class="text-end small text-muted"><?php echo $f['active'] ? '<span class="text-success">online</span>' : 'offline'; ?></div>
                    </div>
                    <div class="small text-truncate mt-1"><?php echo htmlentities($f['last_message']); ?></div>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center">
              <div class="small text-muted">Total de amigos: <?php echo count($friends); ?></div>
              <div>
                <button class="btn btn-primary btn-sm" id="btn-new-chat">Novo chat</button>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-8">
          <div id="right-pane">
            <section id="chat-preview" class="screen p-3 bg-white rounded-3" aria-live="polite">
              <h5 id="chat-title">Selecione um amigo para conversar</h5>
              <div class="small text-muted mb-3" id="chat-sub">Suas conversas aparecerão aqui.</div>
              <div class="chat-box mb-3" style="min-height:240px;border-radius:12px;padding:12px;background:var(--panel);box-shadow:var(--shadow)"></div>
              <div class="d-flex gap-2">
                <input type="text" class="form-control" id="chat-input" placeholder="Escreva uma mensagem...">
                <button class="btn btn-primary" id="chat-send">Enviar</button>
              </div>
            </section>

            <section id="discover-screen" class="screen d-none" role="tabpanel">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="small text-muted">Encontre parceiros de conversação recomendados.</div>
                <div><button class="btn btn-outline-secondary btn-sm" id="discover-filter">Filtrar</button></div>
              </div>

                <style>
                  #discover-list .card-clean{border-radius:12px;padding:14px;background:linear-gradient(180deg,var(--card),#fbfdff);box-shadow:0 10px 30px rgba(12,16,30,0.04)}
                  #discover-list .card-thumb-sm{width:84px;height:84px;border-radius:12px;overflow:hidden}
                  #discover-list .card-thumb-sm img{width:100%;height:100%;object-fit:cover}
                  #discover-list .small.text-muted{color:var(--muted-text)}
                </style>

                <div class="row g-3" id="discover-list">
                <?php foreach($discover as $d): ?>
                  <div class="col-md-6">
                    <article class="card-clean p-3 h-100">
                      <div class="d-flex align-items-start gap-3">
                        <div class="card-thumb-sm">
                          <img src="<?php echo asset($d['img']); ?>" alt="<?php echo htmlentities($d['name']); ?>">
                        </div>
                        <div class="flex-grow-1">
                          <div class="d-flex justify-content-between align-items-start">
                            <div>
                              <strong class="d-block"><?php echo htmlentities($d['name']); ?></strong>
                              <div class="small text-muted"><?php echo htmlentities($d['desc']); ?></div>
                            </div>
                            <div class="text-end small text-muted"><?php echo htmlentities($d['lang']); ?> • <?php echo htmlentities($d['level']); ?></div>
                          </div>
                          <div class="mt-3 d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm discover-connect" data-name="<?php echo htmlentities($d['name']); ?>">Conversar</button>
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                <?php endforeach; ?>
              </div>

            </section>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script>
    (function(){
      const tabFriends = document.getElementById('tab-friends');
      const tabDiscover = document.getElementById('tab-discover');
      const friendsScreen = document.getElementById('friends-screen');
      const discoverScreen = document.getElementById('discover-screen');
      const chatTitle = document.getElementById('chat-title');
      const chatSub = document.getElementById('chat-sub');
      const chatBox = document.querySelector('.chat-box');
      const chatInput = document.getElementById('chat-input');
      const chatSend = document.getElementById('chat-send');

      function showScreen(target){
        if(target === 'friends'){
          tabFriends.classList.add('active'); tabDiscover.classList.remove('active');
          friendsScreen.classList.remove('d-none'); friendsScreen.classList.remove('d-none');
          discoverScreen.classList.add('d-none');
        } else {
          tabDiscover.classList.add('active'); tabFriends.classList.remove('active');
          discoverScreen.classList.remove('d-none'); friendsScreen.classList.add('d-none');
        }
      }

      tabFriends.addEventListener('click',()=> showScreen('friends'));
      tabDiscover.addEventListener('click',()=> showScreen('discover'));

      document.querySelectorAll('.friend-item').forEach(item=>{
        item.addEventListener('click', e=>{
          e.preventDefault();
          const name = item.dataset.name || 'Amigo';
          chatTitle.textContent = name;
          chatSub.textContent = 'Conectado • Nível de idioma - veja e envie mensagens abaixo.';
          chatBox.innerHTML = '<div class="small text-muted">Iniciando conversa com ' + name + '...</div>';
          showScreen('friends');
        });
      });

      chatSend.addEventListener('click', ()=>{
        const text = chatInput.value.trim();
        if(!text) return;
        const msg = document.createElement('div'); msg.className = 'mb-2'; msg.textContent = 'Você: ' + text;
        chatBox.appendChild(msg);
        chatBox.scrollTop = chatBox.scrollHeight;
        chatInput.value = '';
      });

     
      document.querySelectorAll('.discover-connect').forEach(b=>{
        b.addEventListener('click', ()=>{
          const name = b.dataset.name || 'Parceiro';
          const li = document.createElement('a'); li.href='#'; li.className='list-group-item list-group-item-action d-flex align-items-center friend-item';
          li.innerHTML = '<img src="assets/img/flag-placeholder.svg" class="avatar-img me-3"><div class="flex-grow-1"><div class="d-flex justify-content-between"><div><strong>'+name+'</strong><div class="small text-muted">Português • A2</div></div><div class="text-end small text-muted">online</div></div><div class="small text-truncate mt-1">Olá! Vamos conversar?</div></div>';
          document.querySelector('#friends-screen .list-group').prepend(li);
          // attach click
          li.addEventListener('click', e=>{ e.preventDefault(); chatTitle.textContent = name; chatBox.innerHTML = '<div class="small text-muted">Conversa com '+name+' iniciada.</div>'; showScreen('friends'); });
          // switch to chat
          chatTitle.textContent = name; chatBox.innerHTML = '<div class="small text-muted">Conversa com '+name+' iniciada.</div>';
          showScreen('friends');
        });
      });

      

     
      document.querySelectorAll('.friend-item, .discover-connect').forEach(el=> el.setAttribute('role','button'));
    })();
  </script>
</body>
</html>
