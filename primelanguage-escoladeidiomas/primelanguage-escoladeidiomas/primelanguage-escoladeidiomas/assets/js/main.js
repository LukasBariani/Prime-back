/* main.js - simple transitions and UI behaviors */
document.addEventListener('DOMContentLoaded',()=>{
  // Fade in page
  document.body.classList.add('page-fade-enter');
  requestAnimationFrame(()=>document.body.classList.add('page-fade-enter-active'));

  // Delegate clicks on anchors to run transition -> navigation
  document.body.addEventListener('click', e=>{
    const el = e.target.closest('a');
    if(!el) return;
    const href = el.getAttribute('href');
    if(!href || href.startsWith('#') || href.startsWith('mailto:') ) return;
    // allow external links (start with http)
    if(href.startsWith('http')) return;
    e.preventDefault();
    if(document.body.classList.contains('page-fade-exit-active')) return; // avoid double
    document.body.classList.remove('page-fade-enter-active');
    document.body.classList.add('page-fade-exit-active');
    setTimeout(()=>window.location.href = href,420);
  });

  // Build and run WordGuess game if present on the page
  const grid = document.querySelector('.word-grid');
  if (grid) {
    // Minimal word list (you can expand or fetch remotely)
    const WORDS = ["APPLE","PLANT","HOUSE","TRAIN","GREEN","LIGHT","NIGHT","WHITE","WATER","SMILE","HAPPY","BRAVE","QUICK","LAUGH","MUSIC","RIVER","BEACH","MOUNT","MONEY","PEACE",
"SWEET","SOUND","SHORE","CLOUD","STONE","FLAME","BLAZE","HEART","VOICE","DREAM",
"FROST","BERRY","FRUIT","FIELD","GRAIN","PLAIN","BLINK","BRING","CARRY","GHOST",
"RANCH","CIRCLE","SCALE","WATCH","CLOCK","SHARP","ROUND","SHEET","PAPER","PILOT",
"SPACE","ROBOT","FRAME","BRICK","CHAIN","CATCH","THROW","WRITE","PAINT","LAYER",
"BRAND","DRIVE","SPEED","RANGE","TRACK","ROUTE","MAPLE","ATOLL","CORAL","SHELL",
"WHALE","SHARK","TIGER","HORSE","SHEEP","CAMEL","LLAMA","MOUSE","RAVEN","EAGLE",
"SWIFT","PANDA","ZEBRA","KOALA","LEMUR","MANGO","LEMON","BREAD","PIZZA","PASTA",
"SALAD","TASTE","SPICE","SUGAR","CANDY","SMOKE","STEAM","RADIO","PHONE","EMAIL",
"LOGIN","ERROR","ALERT","INPUT","LOGIC","ARRAY","STACK","QUEUE","BASIC","CLASS",
"PRIDE","TRUST","HONOR","LOYAL","UNITY","CIVIL","RURAL","URBAN","CLEAN","DIRTY",
"BRISK","FRESH","ROAST","GRILL","GLOVE","SWEPT","HASTE","SHAKE","CRANE","BRINK",
"BLOOM","GLASS","FLOUR","GUILD","VAPOR","COVER","BRACE","FABLE","GLORY","GRAIL",
"OPERA","SONIC","PIXEL","VECTOR","PIXIE","ALGAE","PETAL","STORM","THORN","EMBER",
"NURSE","DOZEN","FANCY","GAMER","HUMAN","INDEX","LEMMA","MOTIF","NEXUS","OASIS",
"QUERY","PULSE","SALTY","TANGO","VERSE","AHEAD","BLESS","CRISP","DODGE","ELATE",
"FERRY","GLEAN","HUMOR","IDEAL","JUDGE","KNOCK","LINER","MORAL","NEEDS","OFFER",
"RALLY","TEMPO","VISTA","WAGER","XENIA","YEARN","PRIMO","CIVIC","ALERT","MERCY","NINJA","PILAR","SAVOR","TITAN","ULTRA","VIVID","WRIST","YEAST","ZONAL","ADULT",
"BASAL","CIDER","DECKS","EPOCH","GAMMA","IDOLS","JAZZY","KARMA","LATCH","MERCY",
"NINJA","PULSE","SALTY","TANGO","VERSE","WHIMY","XENON","YOUNG","ZAPPY","BLESS","CRISP","DODGE","ELATE","GLEAN","IDEAL","JUDGE","KNOCK","LINER","MORAL","NEEDS","OFFER","RALLY","TEMPO","VISTA","WAGER","XENIA","YEARN"];
    const SECRET = WORDS[Math.floor(Math.random()*WORDS.length)];
    const ROWS = 6, COLS = 5;
    let curRow = 0, curCol = 0;
    const tiles = [];

    // create grid
    for (let r=0;r<ROWS;r++){
      const row = document.createElement('div');
      row.className='d-flex justify-content-center mb-1';
      const rowTiles = [];
      for (let c=0;c<COLS;c++){
        const t = document.createElement('div');
        t.className='tile';
        row.appendChild(t);
        rowTiles.push(t);
      }
      grid.appendChild(row);
      tiles.push(rowTiles);
    }

    // keyboard UI
    const keyboard = document.querySelector('.keyboard');
    const rows = ['QWERTYUIOP','ASDFGHJKL','ZXCVBNM'];
    const keyMap = {};
    rows.forEach(r=>{
      const rowEl = document.createElement('div'); rowEl.className='kbd-row mb-1 d-flex justify-content-center';
      for(const ch of r){
        const k = document.createElement('button'); k.className='key btn btn-light me-1'; k.textContent=ch; k.type='button';
        k.addEventListener('click',()=>handleKey(ch));
        rowEl.appendChild(k); keyMap[ch]=k;
      }
      keyboard.appendChild(rowEl);
    });
    const ctrlRow = document.createElement('div'); ctrlRow.className='d-flex justify-content-center';
    const enterBtn = document.createElement('button'); enterBtn.className='key btn btn-success me-2'; enterBtn.textContent='ENTER'; enterBtn.type='button'; enterBtn.addEventListener('click',()=>handleKey('ENTER'));
    const delBtn = document.createElement('button'); delBtn.className='key btn btn-danger'; delBtn.textContent='DEL'; delBtn.type='button'; delBtn.addEventListener('click',()=>handleKey('DEL'));
    ctrlRow.appendChild(enterBtn); ctrlRow.appendChild(delBtn); keyboard.appendChild(ctrlRow);

    let isAnimating = false;
    // input handling
    function handleKey(k){
      if(isAnimating) return;
      if(k==='ENTER') return submitGuess();
      if(k==='DEL') return deleteLetter();
      if(curCol< COLS && /^[A-Z]$/.test(k)){
        tiles[curRow][curCol].textContent = k;
        tiles[curRow][curCol].classList.add('filled');
        curCol++;
      }
    }

    function deleteLetter(){
      if(curCol>0){
        curCol--; tiles[curRow][curCol].textContent=''; tiles[curRow][curCol].classList.remove('filled');
      }
    }

    function submitGuess(){
      if(curCol !== COLS) return flashRow(curRow);
      const guess = tiles[curRow].map(t=>t.textContent||'').join('');
      if(!guess) return flashRow(curRow);
      // simple validation: must be 5 letters
      // evaluate
      const secret = SECRET.split('');
      const guessArr = guess.split('');
      const result = new Array(COLS).fill('absent');
      const secretUsed = new Array(COLS).fill(false);
      // first pass: correct positions
      for(let i=0;i<COLS;i++){
        if(guessArr[i]===secret[i]){ result[i]='correct'; secretUsed[i]=true; }
      }
      // second pass: present elsewhere
      for(let i=0;i<COLS;i++){
        if(result[i]==='correct') continue;
        for(let j=0;j<COLS;j++){
          if(!secretUsed[j] && guessArr[i]===secret[j]){ result[i]='present'; secretUsed[j]=true; break; }
        }
      }
      // apply coloring and keyboard hints with flip animation
      isAnimating = true;
      for(let i=0;i<COLS;i++){
        ((i)=>{
          const t = tiles[curRow][i];
          setTimeout(()=>{
            t.classList.add('reveal');
            // after half flip, set color
            setTimeout(()=>{
              t.classList.add(result[i]); // 'correct' | 'present' | 'absent'
              // keyboard color priority
              const k = guessArr[i];
              const kb = keyMap[k];
              if(kb){
                if(result[i]==='correct') { kb.classList.remove('btn-light'); kb.classList.remove('btn-warning'); kb.classList.add('btn-success'); }
                else if(result[i]==='present' && !kb.classList.contains('btn-success')) { kb.classList.remove('btn-light'); kb.classList.add('btn-warning'); }
                else if(!kb.classList.contains('btn-success') && !kb.classList.contains('btn-warning')) { kb.classList.remove('btn-light'); kb.classList.add('btn-secondary'); }
              }
            },150);
          }, i*320);
        })(i);
      }

      // after all reveals finished
      setTimeout(()=>{
        isAnimating = false;
        if(result.every(r=>r==='correct')){
          alert('Parabéns! Você acertou: '+guess);
          return;
        }
        curRow++; curCol=0;
        if(curRow>=ROWS){ alert('Fim de jogo. Palavra: '+SECRET); }
      }, COLS*320 + 300);
    }

    function flashRow(r){
      tiles[r].forEach(t=>{ t.classList.add('shake'); setTimeout(()=>t.classList.remove('shake'),400); });
    }

    // physical keyboard support
    document.addEventListener('keydown',e=>{
      if(e.key==='Enter') handleKey('ENTER');
      else if(e.key==='Backspace') handleKey('DEL');
      else{
        const k = e.key.toUpperCase(); if(/^[A-Z]$/.test(k)) handleKey(k);
      }
    });
  }
  // Navbar sticky/shadow on scroll
  const nav = document.querySelector('.navbar-custom');
  if(nav){
    const onScroll = ()=>{
      if(window.scrollY>12) nav.classList.add('sticky'); else nav.classList.remove('sticky');
    }
    onScroll();
    window.addEventListener('scroll', onScroll);
  }

  /* Accessibility: language switch (theme toggle removed) */
  const langSelect = document.getElementById('site-lang');

  // translation dictionary (simple client-side swap for common strings)
  const TRANSLATIONS = {
    'pt': {
      'Aprenda idiomas com confiança':'Aprenda idiomas com confiança',
  'Aulas curtas, prática diária e comunidade ativa — tudo para você falar com segurança.':'Aulas curtas, prática diária e comunidade ativa — tudo para você falar com segurança.',
  'Ver cursos':'Ver cursos',
  'Inscreva-se e experimente a primeira semana grátis.':'Inscreva-se e experimente a primeira semana grátis.',
  'o mundo em apenas um clique.':'o mundo em apenas um clique.',
      'Aprender':'Aprender',
      'Comunidade':'Comunidade',
      'Trilhas':'Trilhas',
      'WordGuess':'WordGuess',
      'Entrar':'Entrar',
      'Cadastrar':'Cadastrar',
      'Comece grátis':'Comece grátis',
      'Ver cursos':'Ver cursos',
      'Pronto para começar?':'Pronto para começar?',
      'Inscreva-se e experimente a primeira semana grátis.':'Inscreva-se e experimente a primeira semana grátis.',
      'Registre-se':'Registre-se',
      'O que vamos aprender hoje?':'O que vamos aprender hoje?',
      'Qual o nosso diferencial?':'Qual o nosso diferencial?',
      'O que dizem sobre a Prime:':'O que dizem sobre a Prime:',
      'Aprenda idiomas':'Aprenda idiomas',
      'ONDE e QUANDO quiser!':'ONDE e QUANDO quiser!',
      'Baixe o aplicativo da Prime Language.':'Baixe o aplicativo da Prime Language.',
      'Comece agora!':'Comece agora!'
    },
    'en': {
      'Aprenda idiomas com confiança':'Learn languages with confidence',
  'Aulas curtas, prática diária e comunidade ativa — tudo para você falar com segurança.':'Short lessons, daily practice and an active community — everything to help you speak with confidence.',
  'Ver cursos':'See courses',
  'Inscreva-se e experimente a primeira semana grátis.':'Sign up and try the first week free.',
  'o mundo em apenas um clique.':'the world in a single click.' ,
  'Aprender':'Learn',
  'Comunidade':'Community',
  'Trilhas':'Tracks',
  'WordGuess':'WordGuess',
  'Entrar':'Log in',
  'Cadastrar':'Sign up',
      'Comece grátis':'Start free',
      'Ver cursos':'See courses',
      'Pronto para começar?':'Ready to start?',
      'Inscreva-se e experimente a primeira semana grátis.':'Sign up and try the first week free.',
      'Registre-se':'Sign up',
      'O que vamos aprender hoje?':'What will we learn today?',
      'Qual o nosso diferencial?':'Why Prime?',
      'O que dizem sobre a Prime:':'What people say about Prime:',
      'Aprenda idiomas':'Learn languages',
      'ONDE e QUANDO quiser!':'WHERE and WHEN you want!',
      'Baixe o aplicativo da Prime Language.':'Download the Prime Language app.',
      'Comece agora!':'Start now!'
    },
    'es': {
      'Aprenda idiomas com confiança':'Aprende idiomas con confianza',
  'Aulas curtas, prática diária e comunidade ativa — tudo para você falar com segurança.':'Lecciones cortas, práctica diaria y una comunidad activa — todo para ayudarte a hablar con confianza.',
  'Ver cursos':'Ver cursos',
  'Inscreva-se e experimente a primeira semana grátis.':'Regístrate y prueba la primera semana gratis.',
  'o mundo em apenas um clique.':'el mundo en un solo clic.' ,
  'Aprender':'Aprender',
  'Comunidade':'Comunidad',
  'Trilhas':'Rutas',
  'WordGuess':'WordGuess',
  'Entrar':'Entrar',
  'Cadastrar':'Registrarse',
      'Comece grátis':'Comienza gratis',
      'Ver cursos':'Ver cursos',
      'Pronto para começar?':'Listo para empezar?',
      'Inscreva-se e experimente a primeira semana grátis.':'Regístrate y prueba la primera semana gratis.',
      'Registre-se':'Regístrate',
      'O que vamos aprender hoje?':'¿Qué aprenderemos hoy?',
      'Qual o nosso diferencial?':'¿Cuál es nuestra diferencia?',
      'O que dizem sobre a Prime:':'Lo que dicen sobre Prime:',
      'Aprenda idiomas':'Aprende idiomas',
      'ONDE e QUANDO quiser!':'¡DONDE y CUÁNDO quieras!',
      'Baixe o aplicativo da Prime Language.':'Descarga la aplicación de Prime Language.',
      'Comece agora!':'¡Comienza ahora!'
    }
    ,
    'fr': {},
    'de': {},
    'it': {},
    'ja': {},
    'ko': {}
  };

  // fallback: copy English translations into newly added languages so UI updates immediately
  if(TRANSLATIONS['en']){
    ['fr','de','it','ja','ko'].forEach(l=>{
      TRANSLATIONS[l] = Object.assign({}, TRANSLATIONS['en']);
    });
  }

  // Build canonical mapping: for any known string in any language, map it back to a canonical key.
  // Prefer Portuguese ('pt') keys as canonical when available, else fall back to the English key.
  const CANONICAL = {};
  // First, collect all keys from pt (if present)
  if(TRANSLATIONS['pt']){
    Object.keys(TRANSLATIONS['pt']).forEach(k=>{ CANONICAL[k] = k; });
  }
  // For every language and its map, ensure reverse lookup maps the translated string back to a canonical key
  Object.keys(TRANSLATIONS).forEach(lang=>{
    const map = TRANSLATIONS[lang]||{};
    Object.keys(map).forEach(k=>{
      const translated = map[k];
      if(translated && !CANONICAL[translated]){
        // if there's already a canonical for k (e.g. pt), use it, otherwise use k
        CANONICAL[translated] = CANONICAL[k] || k;
      }
    });
  });

  function applyTranslations(locale){
    // 1) translate elements explicitly marked with data-i18n
    document.querySelectorAll('[data-i18n]').forEach(el=>{
      const key = el.getAttribute('data-i18n');
      if(TRANSLATIONS[locale] && TRANSLATIONS[locale][key]) el.textContent = TRANSLATIONS[locale][key];
      else if(TRANSLATIONS['en'] && TRANSLATIONS['en'][key]) el.textContent = TRANSLATIONS['en'][key];
    });

    // 2) translate visible text nodes across the document for non-annotated text
    // Build a reverse lookup map from any known language to the target translation
    const reverse = {};
    Object.keys(TRANSLATIONS).forEach(lang=>{
      const map = TRANSLATIONS[lang];
      Object.keys(map||{}).forEach(k=>{
        // store mapping of original string k in this source lang to target locale value
        if(!reverse[k]) reverse[k] = {};
        reverse[k][lang] = map[k];
      });
    });

    // Helper to walk text nodes
    function walk(node){
      let child = node.firstChild;
      while(child){
        const next = child.nextSibling;
        if(child.nodeType === Node.TEXT_NODE){
          const txt = child.nodeValue.trim();
          if(txt.length>1){
            // Try exact match replacement by finding a key that matches the current text in any language
            for(const sourceStr in reverse){
              const canonicalKey = CANONICAL[sourceStr] || sourceStr;
              if(txt === sourceStr){
                let out = (TRANSLATIONS[locale] && TRANSLATIONS[locale][canonicalKey]) || (TRANSLATIONS['en'] && TRANSLATIONS['en'][canonicalKey]) || Object.values(reverse[sourceStr])[0];
                if(out && out!==txt){ child.nodeValue = out; break; }
              }
              // small heuristic: if text contains the sourceStr as substring, replace that substring
              else if(txt.indexOf(sourceStr) !== -1){
                let out = (TRANSLATIONS[locale] && TRANSLATIONS[locale][canonicalKey]) || (TRANSLATIONS['en'] && TRANSLATIONS['en'][canonicalKey]) || Object.values(reverse[sourceStr])[0];
                if(out && out!==sourceStr){ child.nodeValue = txt.split(sourceStr).join(out); }
              }
            }
          }
        } else if(child.nodeType === Node.ELEMENT_NODE){
          // skip inputs, textareas, scripts, styles
          const tag = child.tagName.toLowerCase();
          if(tag==='script' || tag==='style' || tag==='textarea' || tag==='input'){
            // skip
          } else {
            walk(child);
          }
        }
        child = next;
      }
    }

    walk(document.body);
  }

  // Note: theme toggle removed. If theme persistence is needed later, reintroduce here.

  const savedLang = localStorage.getItem('pl_lang') || 'pt';
  // Seed data-i18n attributes for elements that don't have them so we can translate the full page
  function seedDataI18n(){
    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_ELEMENT, null, false);
    let el;
    while(el = walker.nextNode()){
      try{
        // skip interactive or non-text containers
        const tag = el.tagName.toLowerCase();
        if(['script','style','textarea','input','select','option'].includes(tag)) continue;
        if(el.hasAttribute('data-i18n')) continue;
        // only leaf nodes (no element children) with text content
        if(el.children.length === 0){
          const txt = el.textContent.trim();
          if(txt && txt.length>1){
            // prefer canonical key if available, otherwise use the current text
            const key = CANONICAL[txt] || txt;
            el.setAttribute('data-i18n', key);
          }
        }
      }catch(e){/* ignore */}
    }
  }

  if(langSelect) langSelect.value = savedLang;
  // seed attributes then apply translations for full coverage
  seedDataI18n();
  applyTranslations(savedLang);
  if(langSelect) langSelect.addEventListener('change',()=>{ const v = langSelect.value; localStorage.setItem('pl_lang', v); applyTranslations(v); document.documentElement.setAttribute('lang', v); });
  // update small footer label next to the flag to show chosen language
  const footerLangLabel = document.querySelector('.site-footer .lang-select .small');
  function updateFooterLangLabel(code){
    const names = {pt:'Português', en:'English', es:'Español'};
    if(footerLangLabel) footerLangLabel.textContent = names[code] || code;
  }
  if(langSelect) { updateFooterLangLabel(langSelect.value); langSelect.addEventListener('change', ()=> updateFooterLangLabel(langSelect.value)); }
  // ensure html lang attr set on load
  document.documentElement.setAttribute('lang', savedLang);

  // Simple entrance animations using IntersectionObserver
  try{
    const obs = new IntersectionObserver((entries, o)=>{
      entries.forEach(en=>{
        if(en.isIntersecting){
          en.target.classList.add('anim-visible');
          o.unobserve(en.target);
        }
      });
    },{root:null,rootMargin:'0px 0px -8% 0px',threshold:0.12});

    document.querySelectorAll('[data-animate], .anim-fade-up, .anim-scale').forEach(el=>{
      // mark initially hidden
      if(!el.classList.contains('anim-visible')) el.classList.add('anim-hidden');
      obs.observe(el);
    });
  }catch(e){/* IntersectionObserver fallback: reveal all */
    document.querySelectorAll('[data-animate], .anim-fade-up, .anim-scale').forEach(el=>el.classList.add('anim-visible'));
  }

  /* --- Live homepage interactions --- */
  // Chip interactions & quick preview
  const chips = document.querySelectorAll('.chip-btn');
  if(chips && chips.length){
    const preview = document.getElementById('chip-preview');
    chips.forEach(c=>{
      c.addEventListener('mouseenter',()=>{ if(preview) preview.textContent = 'Iniciar uma lição rápida de ' + c.dataset.lang; });
      c.addEventListener('mouseleave',()=>{ if(preview) preview.textContent = ''; });
      c.addEventListener('click',()=>{
        // quick-start placeholder: navigate to courses filtered by language
        const lang = c.dataset.lang;
        // store preferred language and go to courses
        localStorage.setItem('pl_pref_lang', lang);
        window.location.href = 'courses.php?lang='+encodeURIComponent(lang);
      });
    });
  }

  // Simple onboarding modal for first-time visitors
  if(!localStorage.getItem('pl_onboard_seen')){
    const modal = document.createElement('div'); modal.className='onboard-backdrop';
    modal.innerHTML = `
      <div class="onboard" role="dialog" aria-modal="true">
        <h4>Comece rápido</h4>
        <p class="small text-muted">Me diga um pouco sobre você para personalizar a experiência.</p>
        <div class="options" id="onboard-goal">
          <div class="option" data-val="work">Trabalho</div>
          <div class="option" data-val="travel">Viagens</div>
          <div class="option" data-val="study">Estudos</div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
          <button class="btn btn-outline-secondary" id="onboard-skip">Pular</button>
          <button class="btn btn-primary" id="onboard-done">Começar</button>
        </div>
      </div>`;
    document.body.appendChild(modal);
    // interactions
    document.querySelectorAll('.onboard .option').forEach(o=>{
      o.addEventListener('click',()=>{ document.querySelectorAll('.onboard .option').forEach(x=>x.classList.remove('selected')); o.classList.add('selected'); });
    });
    document.getElementById('onboard-skip').addEventListener('click',()=>{ localStorage.setItem('pl_onboard_seen','1'); modal.remove(); });
    document.getElementById('onboard-done').addEventListener('click',()=>{
      const sel = document.querySelector('.onboard .option.selected');
      if(sel) localStorage.setItem('pl_onboard_goal', sel.dataset.val);
      localStorage.setItem('pl_onboard_seen','1');
      modal.remove();
    });
  }

  // Hero parallax for hero-card image (subtle)
  const heroImg = document.querySelector('.hero-card img');
  if(heroImg){
    document.addEventListener('mousemove',e=>{
      const cx = window.innerWidth/2; const cy = window.innerHeight/2;
      const dx = (e.clientX - cx)/cx; const dy = (e.clientY - cy)/cy;
      heroImg.style.transform = `translate(${dx*6}px, ${dy*6}px)`;
    });
    document.addEventListener('mouseleave',()=>{ heroImg.style.transform='translate(0,0)'; });
  }
});

// Trail interactions: activity buttons, animations, progress and persistence
document.addEventListener('DOMContentLoaded',()=>{
  const STORAGE_KEY = 'pl_trails_state_v1';
  function loadState(){ try{ return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}'); }catch(e){return {}; } }
  function saveState(s){ localStorage.setItem(STORAGE_KEY, JSON.stringify(s)); }

  const state = loadState();

  function updateMiniProgress(container, trackId){
    const total = container.querySelectorAll('.trail-activity-btn').length;
    const doneBtns = container.querySelectorAll('.trail-activity-btn[data-done="1"]').length;
    const pct = total ? Math.round((doneBtns/total)*100) : 0;
    const bar = container.querySelector('.trail-mini-bar');
    const count = container.querySelector('.completed-count');
    if(bar) bar.style.width = pct + '%';
    if(count) count.textContent = doneBtns + '/' + total;
    // persist
    state[trackId] = {};
    state[trackId].done = Array.from(container.querySelectorAll('.trail-activity-btn')).map(b=> b.dataset.done === '1' ? 1 : 0);
    saveState(state);
  }

  // hydrate buttons from storage
  document.querySelectorAll('[id^="track-"]').forEach(section=>{
    const trackId = section.id.replace('track-','');
    const saved = state[trackId] && state[trackId].done ? state[trackId].done : null;
    section.querySelectorAll('.trail-activity-btn').forEach((btn, i)=>{
      const isDone = saved && saved[i];
      if(isDone){
        btn.dataset.done='1'; btn.classList.add('active');
        btn.setAttribute('aria-pressed','true');
        btn.setAttribute('aria-label','Completed');
      } else {
        btn.dataset.done='0'; btn.classList.remove('active');
        btn.setAttribute('aria-pressed','false');
        btn.setAttribute('aria-label','Start activity');
      }
    });
    updateMiniProgress(section, trackId);
  });

  // delegate clicks inside timeline
  const timeline = document.querySelector('.timeline');
  if(timeline){
    timeline.addEventListener('click', e=>{
      const btn = e.target.closest('.trail-activity-btn');
      if(!btn) return;
      const section = btn.closest('[id^="track-"]');
      const trackId = section ? section.id.replace('track-','') : 'unknown';
      // toggle
  const was = btn.dataset.done === '1';
  const now = !was;
  btn.dataset.done = now ? '1' : '0';
  btn.classList.toggle('active', now);
  btn.setAttribute('aria-pressed', now ? 'true' : 'false');
  btn.setAttribute('aria-label', now ? 'Completed' : 'Start activity');
  // animation flair
  btn.classList.add('anim-flare');
  setTimeout(()=>btn.classList.remove('anim-flare'),900);
  updateMiniProgress(section, trackId);
    });
  }
});
