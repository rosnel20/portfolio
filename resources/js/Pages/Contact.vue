<template>
  <div class="cpage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />
    <main>
      <!-- HERO -->
      <section class="ch">
        <div class="ch-bg">
          <div class="ch-grid"></div>
          <div class="ch-orb o1"></div>
          <div class="ch-orb o2"></div>
          <div class="ch-lines">
            <div class="chl" v-for="i in 5" :key="i" :style="{ '--i': i }"></div>
          </div>
        </div>
        <div class="ch-inner">
          <div class="ch-crumb">
            <Link href="/" class="chc-back">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Accueil
            </Link>
            <span class="chc-sep">/</span>
            <span class="chc-cur">Contact</span>
          </div>
          <div class="ch-badge"><span class="chb-dot"></span>Disponible · Réponse sous 24h</div>
          <h1 class="ch-title">Démarrons un<br><em>projet ensemble</em></h1>
          <p class="ch-sub">Mission freelance, CDI, collaboration ouverte —<br class="br-hide"> chaque projet est une nouvelle aventure.</p>
        </div>
        <div class="ch-scroll"><div class="chs-bar"></div><span>Scroll</span></div>
      </section>

      <!-- BODY -->
      <section class="cb">
        <div class="cb-inner">
          <!-- Gauche -->
          <div class="cbi-left">
            <div class="cil-label">01 · Coordonnées</div>
            <div class="cil-cards">
              <a href="mailto:mrrosnel6@gmail.com" class="cic email">
                <div class="cic-ico"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
                <div class="cic-body"><div class="cic-label">Email</div><div class="cic-val">mrrosnel6@gmail.com</div></div>
                <svg class="cic-arr" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
              <a href="https://github.com/rosnel20" target="_blank" rel="noopener" class="cic github">
                <div class="cic-ico"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg></div>
                <div class="cic-body"><div class="cic-label">GitHub</div><div class="cic-val">github.com/rosnel20</div></div>
                <svg class="cic-arr" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
              <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener" class="cic linkedin">
                <div class="cic-ico"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></div>
                <div class="cic-body"><div class="cic-label">LinkedIn</div><div class="cic-val">linkedin.com/in/rosneldev</div></div>
                <svg class="cic-arr" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
            </div>
            <div class="cil-dispo">
              <div class="cild-head"><span class="cild-dot"></span>Disponibilité</div>
              <div class="cild-status">Ouvert aux opportunités en <strong>2025</strong></div>
              <div class="cild-types">
                <span>Freelance</span><span>CDI</span><span>Collaboration</span><span>Stage</span>
              </div>
            </div>
          </div>

          <!-- Droite : formulaire -->
          <div class="cbi-right">
            <div class="cir-label">02 · Formulaire</div>

            <Transition name="fade">
              <div v-if="success" class="cir-success">
                <div class="css-ico"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></div>
                <div class="css-t">Message envoyé !</div>
                <div class="css-s">Je vous répondrai sous 24 heures. Merci de m'avoir contacté.</div>
                <button class="css-again" @click="resetForm">Envoyer un autre message</button>
              </div>
            </Transition>

            <form v-if="!success" @submit.prevent="submit" novalidate class="cir-form">
              <div v-if="globalError" class="cf-alert">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ globalError }}
              </div>
              <div class="cf-row">
                <div class="cf-field" :class="{ focused: focus.name, error: form.errors.name }">
                  <label class="cf-label" for="f-name">Nom complet</label>
                  <input id="f-name" v-model="form.name" type="text" placeholder="Votre nom" autocomplete="name" @focus="focus.name=true" @blur="focus.name=false"/>
                  <span v-if="form.errors.name" class="cf-err">{{ form.errors.name }}</span>
                </div>
                <div class="cf-field" :class="{ focused: focus.email, error: form.errors.email }">
                  <label class="cf-label" for="f-email">Adresse email</label>
                  <input id="f-email" v-model="form.email" type="email" placeholder="vous@example.com" autocomplete="email" @focus="focus.email=true" @blur="focus.email=false"/>
                  <span v-if="form.errors.email" class="cf-err">{{ form.errors.email }}</span>
                </div>
              </div>
              <div class="cf-field" :class="{ focused: focus.subject, error: form.errors.subject }">
                <label class="cf-label" for="f-subject">Sujet</label>
                <input id="f-subject" v-model="form.subject" type="text" placeholder="De quoi souhaitez-vous parler ?" @focus="focus.subject=true" @blur="focus.subject=false"/>
                <span v-if="form.errors.subject" class="cf-err">{{ form.errors.subject }}</span>
              </div>
              <div class="cf-chips">
                <button v-for="c in quickSubjects" :key="c" type="button" class="cfc" :class="{ active: form.subject === c }" @click="form.subject=c">{{ c }}</button>
              </div>
              <div class="cf-field ta" :class="{ focused: focus.message, error: form.errors.message }">
                <label class="cf-label" for="f-message">Message</label>
                <textarea id="f-message" v-model="form.message" rows="5" placeholder="Décrivez votre projet, vos besoins, votre budget estimé..." @focus="focus.message=true" @blur="focus.message=false"></textarea>
                <div class="cf-count" :class="{ warn: form.message.length > 1800 }">{{ form.message.length }} / 2000</div>
                <span v-if="form.errors.message" class="cf-err">{{ form.errors.message }}</span>
              </div>
              <button type="submit" class="cf-submit" :disabled="form.processing">
                <span v-if="!form.processing" class="cfs-label">
                  Envoyer le message
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </span>
                <span v-else class="cfs-spinner"></span>
              </button>
            </form>
          </div>
        </div>
      </section>

      <AppFooter />
    </main>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'

const theme = ref(localStorage.getItem('theme') || 'dark')
function toggleTheme() { theme.value = theme.value === 'dark' ? 'light' : 'dark'; localStorage.setItem('theme', theme.value) }

const page        = usePage()
const success     = ref(page.props.flash?.success === true)
const form        = useForm({ name:'', email:'', subject:'', message:'' })
const focus       = reactive({ name:false, email:false, subject:false, message:false })
const globalError = ref('')
const quickSubjects = ['Mission freelance','Offre CDI','Collaboration','Question technique']

function submit() {
  globalError.value = ''
  form.post('/contact', {
    preserveScroll: true,
    onSuccess: () => { success.value = true; form.reset() },
    onError: (e) => { if (e.global) globalError.value = e.global },
  })
}
function resetForm() { success.value = false; globalError.value = ''; form.reset(); form.clearErrors() }
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap');

.cpage.dark {
  --bg:#0A0A0A; --bg2:#111111; --footer-bg:#080808;
  --card:rgba(255,255,255,.04); --card-b:rgba(255,255,255,.08);
  --text:#F0F0F0; --muted:#555; --muted2:#888;
  --nav-bg:rgba(12,12,12,.88); --nav-b:rgba(255,255,255,.09);
  --red:#E53E3E; --red-soft:rgba(229,62,62,.1); --blue:#3B82F6;
  --input-bg:rgba(255,255,255,.04); --input-b:rgba(255,255,255,.1);
}
.cpage.light {
  --bg:#F8F8F8; --bg2:#FFFFFF; --footer-bg:#EFEFEF;
  --card:rgba(0,0,0,.035); --card-b:rgba(0,0,0,.09);
  --text:#0A0A0A; --muted:#888; --muted2:#AAA;
  --nav-bg:rgba(248,248,248,.92); --nav-b:rgba(0,0,0,.09);
  --red:#C53030; --red-soft:rgba(197,48,48,.08); --blue:#2563EB;
  --input-bg:rgba(0,0,0,.03); --input-b:rgba(0,0,0,.12);
  --footer-bg:#EFEFEF;
}
* { box-sizing:border-box; margin:0; padding:0; }
.cpage { font-family:'Outfit',sans-serif; background:var(--bg); color:var(--text); overflow-x:hidden; transition:background .4s,color .4s; min-height:100vh; }

/* Hero */
.ch { position:relative; min-height:65vh; display:flex; align-items:center; padding:8rem 5vw 4rem; overflow:hidden; }
.ch-bg { position:absolute; inset:0; pointer-events:none; }
.ch-grid { position:absolute; inset:0; background-image:linear-gradient(rgba(229,62,62,.07) 1px,transparent 1px),linear-gradient(90deg,rgba(229,62,62,.07) 1px,transparent 1px); background-size:48px 48px; -webkit-mask-image:radial-gradient(ellipse 90% 80% at 50% 50%,black 20%,transparent 80%); mask-image:radial-gradient(ellipse 90% 80% at 50% 50%,black 20%,transparent 80%); }
.ch-orb { position:absolute; border-radius:50%; filter:blur(110px); pointer-events:none; }
.ch-orb.o1 { width:600px; height:600px; background:var(--red); opacity:.07; top:-180px; right:-100px; animation:orb 14s ease-in-out infinite; }
.ch-orb.o2 { width:360px; height:360px; background:var(--blue); opacity:.05; bottom:-60px; left:8%; animation:orb 18s ease-in-out infinite reverse; }
@keyframes orb { 0%,100%{transform:translate(0,0)} 50%{transform:translate(30px,-24px)} }
.ch-lines { position:absolute; inset:0; overflow:hidden; }
.chl { position:absolute; left:calc(var(--i)*18%); top:0; bottom:0; width:1px; background:linear-gradient(to bottom,transparent,rgba(229,62,62,.08) 40%,rgba(229,62,62,.08) 60%,transparent); transform:skewX(-18deg); animation:lineFade 4s ease-in-out infinite; animation-delay:calc(var(--i)*.3s); }
@keyframes lineFade { 0%,100%{opacity:.5} 50%{opacity:1} }
.ch-inner { position:relative; z-index:2; max-width:1100px; margin:0 auto; width:100%; }
.ch-crumb { display:flex; align-items:center; gap:.55rem; font-size:.76rem; color:var(--muted); margin-bottom:2rem; }
.chc-back { display:inline-flex; align-items:center; gap:.4rem; color:var(--muted); text-decoration:none; transition:color .2s; }
.chc-back:hover { color:var(--text); }
.chc-sep { opacity:.4; }
.chc-cur { color:var(--muted2); }
.ch-badge { display:inline-flex; align-items:center; gap:.5rem; font-family:'JetBrains Mono',monospace; font-size:.66rem; letter-spacing:.12em; text-transform:uppercase; color:var(--red); background:var(--red-soft); border:1px solid rgba(229,62,62,.22); padding:.33rem .95rem; border-radius:100px; margin-bottom:1.8rem; }
.chb-dot { width:6px; height:6px; border-radius:50%; background:#4ADE80; animation:bl 2s infinite; flex-shrink:0; }
@keyframes bl { 0%,100%{opacity:1} 50%{opacity:.3} }
.ch-title { font-size:clamp(2.6rem,7vw,5.5rem); font-weight:900; letter-spacing:-.05em; line-height:1.0; color:var(--text); margin-bottom:1.3rem; }
.ch-title em { font-style:italic; color:var(--red); background:linear-gradient(135deg,var(--red),#FC8181); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.ch-sub { font-size:clamp(.88rem,1.5vw,.97rem); color:var(--muted2); line-height:1.85; }
.br-hide { display:inline; }
.ch-scroll { position:absolute; bottom:1.5rem; left:50%; transform:translateX(-50%); display:flex; flex-direction:column; align-items:center; gap:.4rem; font-family:'JetBrains Mono',monospace; font-size:.58rem; letter-spacing:.2em; text-transform:uppercase; color:var(--muted); }
.chs-bar { width:1px; height:38px; background:var(--card-b); overflow:hidden; position:relative; }
.chs-bar::after { content:''; position:absolute; inset-inline:0; top:0; height:50%; background:var(--red); animation:sb 2.4s ease-in-out infinite; }
@keyframes sb { 0%{transform:translateY(-100%);opacity:0} 30%{opacity:1} 100%{transform:translateY(200%);opacity:0} }

/* Body */
.cb { background:var(--bg2); padding:5rem 5vw 6rem; }
.cb-inner { max-width:1100px; margin:0 auto; display:grid; grid-template-columns:320px 1fr; gap:5rem; align-items:start; }

.cil-label, .cir-label { font-family:'JetBrains Mono',monospace; font-size:.62rem; color:var(--muted); letter-spacing:.2em; text-transform:uppercase; margin-bottom:1.8rem; display:flex; align-items:center; gap:.55rem; }
.cil-label::before, .cir-label::before { content:''; display:block; width:16px; height:1px; background:var(--red); }

.cil-cards { display:flex; flex-direction:column; gap:.7rem; margin-bottom:2rem; }
.cic { display:flex; align-items:center; gap:1rem; background:var(--card); border:1px solid var(--card-b); border-radius:14px; padding:.9rem 1.1rem; text-decoration:none; color:var(--text); transition:border-color .22s,box-shadow .22s; }
.cic-ico { width:38px; height:38px; border-radius:9px; flex-shrink:0; display:flex; align-items:center; justify-content:center; background:var(--red-soft); color:var(--red); border:1px solid rgba(229,62,62,.15); }
.cic.github .cic-ico   { background:rgba(100,100,100,.08); color:var(--text); border-color:rgba(100,100,100,.15); }
.cic.linkedin .cic-ico { background:rgba(10,102,194,.08); color:#0A66C2; border-color:rgba(10,102,194,.15); }
.cic-body { flex:1; min-width:0; }
.cic-label { font-family:'JetBrains Mono',monospace; font-size:.58rem; color:var(--muted); letter-spacing:.12em; text-transform:uppercase; margin-bottom:.18rem; }
.cic-val   { font-size:.82rem; font-weight:600; color:var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.cic-arr   { color:var(--muted); transition:transform .22s,color .22s; flex-shrink:0; }

.cil-dispo { background:var(--card); border:1px solid var(--card-b); border-radius:14px; padding:1.2rem 1.3rem; }
.cild-head { display:flex; align-items:center; gap:.5rem; font-family:'JetBrains Mono',monospace; font-size:.6rem; color:var(--muted); letter-spacing:.14em; text-transform:uppercase; margin-bottom:.7rem; }
.cild-dot { width:6px; height:6px; border-radius:50%; background:#4ADE80; animation:bl 2s infinite; flex-shrink:0; }
.cild-status { font-size:.84rem; color:var(--text); font-weight:600; margin-bottom:.75rem; }
.cild-status strong { color:var(--red); }
.cild-types { display:flex; flex-wrap:wrap; gap:.38rem; }
.cild-types span { font-family:'JetBrains Mono',monospace; font-size:.6rem; color:var(--red); background:var(--red-soft); border:1px solid rgba(229,62,62,.15); padding:.16rem .55rem; border-radius:5px; }

/* Form */
.cir-form { display:flex; flex-direction:column; gap:1.1rem; }
.cf-row   { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.cf-field { display:flex; flex-direction:column; gap:.38rem; }
.cf-label { font-family:'JetBrains Mono',monospace; font-size:.62rem; color:var(--muted); letter-spacing:.12em; text-transform:uppercase; transition:color .2s; }
.cf-field.focused .cf-label { color:var(--red); }
.cf-field.error   .cf-label { color:#FC8181; }
.cf-field input, .cf-field textarea { background:var(--input-bg); border:1px solid var(--input-b); border-radius:10px; padding:.75rem 1rem; color:var(--text); font-family:'Outfit',sans-serif; font-size:.87rem; outline:none; resize:none; transition:border-color .2s,box-shadow .2s,background .2s; width:100%; }
.cf-field input::placeholder, .cf-field textarea::placeholder { color:var(--muted); }
.cf-field.focused input, .cf-field.focused textarea { border-color:var(--red); background:var(--red-soft); box-shadow:0 0 0 3px rgba(229,62,62,.07); }
.cf-field.error input, .cf-field.error textarea { border-color:#FC8181; box-shadow:0 0 0 3px rgba(252,129,129,.07); }
.cf-err   { font-size:.7rem; color:#FC8181; font-family:'JetBrains Mono',monospace; }
.cf-count { font-family:'JetBrains Mono',monospace; font-size:.58rem; color:var(--muted); text-align:right; margin-top:.28rem; transition:color .2s; }
.cf-count.warn { color:#F59E0B; }
.cf-chips { display:flex; flex-wrap:wrap; gap:.4rem; }
.cfc { background:var(--card); border:1px solid var(--card-b); color:var(--muted2); font-size:.72rem; font-family:'Outfit',sans-serif; padding:.28rem .75rem; border-radius:100px; cursor:pointer; transition:all .18s; white-space:nowrap; }
.cfc.active { color:var(--red); border-color:var(--red); background:var(--red-soft); font-weight:600; }
.cf-alert { display:flex; align-items:center; gap:.6rem; background:rgba(252,129,129,.08); border:1px solid rgba(252,129,129,.25); color:#FC8181; border-radius:10px; padding:.72rem 1rem; font-size:.82rem; }
.cf-submit { display:inline-flex; align-items:center; justify-content:center; gap:.55rem; background:var(--red); color:#fff; border:none; padding:.9rem 2rem; border-radius:12px; cursor:pointer; font-family:'Outfit',sans-serif; font-size:.88rem; font-weight:700; box-shadow:0 6px 24px rgba(229,62,62,.25); transition:transform .2s,opacity .2s,box-shadow .2s; align-self:flex-start; min-width:180px; }
.cf-submit:disabled { opacity:.7; cursor:not-allowed; }
.cfs-spinner { width:18px; height:18px; border-radius:50%; border:2px solid rgba(255,255,255,.3); border-top-color:#fff; animation:spin .7s linear infinite; }
@keyframes spin { to { transform:rotate(360deg); } }
.cfs-label { display:inline-flex; align-items:center; gap:.5rem; }
.cir-success { display:flex; flex-direction:column; align-items:flex-start; gap:1rem; padding:2rem 1.8rem; background:var(--card); border:1px solid rgba(74,222,128,.2); border-radius:16px; }
.css-ico { width:50px; height:50px; border-radius:50%; background:rgba(74,222,128,.12); color:#4ADE80; display:flex; align-items:center; justify-content:center; border:1px solid rgba(74,222,128,.25); }
.css-t { font-size:1.15rem; font-weight:800; color:var(--text); }
.css-s { font-size:.86rem; color:var(--muted2); }
.css-again { background:none; border:1px solid var(--card-b); color:var(--muted2); padding:.52rem 1.1rem; border-radius:8px; cursor:pointer; font-size:.8rem; font-family:'Outfit',sans-serif; transition:color .2s,border-color .2s; }
.fade-enter-active, .fade-leave-active { transition:opacity .3s,transform .3s; }
.fade-enter-from { opacity:0; transform:translateY(10px); }
.fade-leave-to   { opacity:0; transform:translateY(-10px); }

/* ══ HOVER : vrais pointeurs seulement ══ */
@media (hover: hover) and (pointer: fine) {
  .cic:hover { transform:translateX(5px); }
  .cic.email:hover    { border-color:var(--red); }
  .cic.github:hover   { border-color:rgba(100,100,100,.5); }
  .cic.linkedin:hover { border-color:#0A66C2; }
  .cic:hover .cic-arr { transform:translateX(3px); color:var(--text); }
  .cfc:hover { color:var(--text); border-color:var(--red); background:var(--red-soft); }
  .cf-submit:hover:not(:disabled) { transform:translateY(-2px); box-shadow:0 10px 32px rgba(229,62,62,.32); }
  .css-again:hover { color:var(--text); border-color:var(--red); }
  .chc-back:hover { color:var(--text); }
}

/* ══ RESPONSIVE ══ */
@media (max-width:960px) {
  .cb-inner { grid-template-columns:1fr; gap:3rem; }
  .cbi-left { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; align-items:start; }
  .cil-label { grid-column:1/-1; }
}

@media (max-width:680px) {
  .ch { padding:6.5rem 5vw 3.5rem; min-height:auto; }
  .cb { padding:4rem 5vw 5rem; }
  .cbi-left { grid-template-columns:1fr; }
  .cf-row { grid-template-columns:1fr; }
  .br-hide { display:none; }
  .ch-scroll { display:none; }
  .cb-inner { gap:2.5rem; }
}

@media (max-width:480px) {
  .ch { padding:5.5rem 4vw 3rem; }
  .cb { padding:3rem 4vw 4rem; }
  .ch-title  { font-size:clamp(2rem,9vw,2.5rem); }
  .cf-submit { width:100%; align-self:stretch; }
  .cil-dispo { padding:1rem; }
  .cic-val   { font-size:.78rem; }
  .cic { gap:.75rem; padding:.8rem .9rem; }
  .cic-ico { width:34px; height:34px; }
  .cf-chips  { gap:.35rem; }
  .cfc { font-size:.68rem; padding:.25rem .65rem; }
}

@media (max-width:360px) {
  .ch-badge  { font-size:.58rem; padding:.28rem .7rem; }
  .cild-types span { font-size:.56rem; }
  .ch-title { font-size:1.9rem; }
}
</style>