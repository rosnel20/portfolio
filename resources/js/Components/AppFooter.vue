<template>
  <footer class="footer">
    <div class="fi">
      <div class="ft-top">
        <div class="ft-brand">
          <Link href="/" class="fb-logo">rosnel<span class="dot">.</span>dev</Link>
          <p>Ingénieur des Travaux Informatiques</p>
          <p>Full-Stack Developer · Cameroun</p>
          <div class="fb-badge">
            <span class="fbb-dot"></span>Disponible pour missions
          </div>
        </div>
        <div class="ft-nav">
          <div class="fn-col">
            <span class="fn-head">Navigation</span>
            <a href="/#hero"     @click.prevent="go('hero')">Accueil</a>
            <a href="/#about"    @click.prevent="go('about')">À propos</a>
            <a href="/#projects" @click.prevent="go('projects')">Projets</a>
            <Link href="/contact">Contact</Link>
          </div>
          <div class="fn-col">
            <span class="fn-head">Liens</span>
            <a href="https://github.com/rosnel20" target="_blank" rel="noopener">GitHub ↗</a>
            <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener">LinkedIn ↗</a>
            <a href="mailto:mrrosnel6@gmail.com">Email ↗</a>
          </div>
        </div>
      </div>

      <div class="ft-email-block">
        <span class="feb-label">Contactez-moi directement</span>
        <a href="mailto:mrrosnel6@gmail.com" class="feb-email">
          mrrosnel6@gmail.com
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>

      <div class="ft-hr"></div>

      <div class="ft-bottom">
        <span>© 2025 Mabong Anaba Ronel Pacely</span>
        <div class="ft-icons">
          <a href="https://github.com/rosnel20" target="_blank" rel="noopener" aria-label="GitHub">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
          </a>
          <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener" aria-label="LinkedIn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="mailto:mrrosnel6@gmail.com" aria-label="Email">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </a>
        </div>
        <span class="ft-made">Vue · Laravel · Inertia</span>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
function go(id) {
  const el = document.getElementById(id)
  if (el) window.scrollTo({ top: el.offsetTop - 90, behavior: 'smooth' })
  else window.location.href = '/#' + id
}
</script>

<style scoped>
.footer { background:var(--footer-bg); border-top:1px solid var(--card-b); }
.fi { max-width:1200px; margin:0 auto; padding:4rem 5vw 2rem; }

.ft-top { display:flex; justify-content:space-between; gap:3rem; flex-wrap:wrap; margin-bottom:3rem; }
.ft-brand { max-width:240px; }
.fb-logo { font-family:'Outfit',sans-serif; font-size:1.35rem; font-weight:900; color:var(--text); text-decoration:none; letter-spacing:-.04em; display:block; margin-bottom:.7rem; }
.dot { color:var(--red); }
.ft-brand p { font-size:.8rem; color:var(--muted); line-height:1.7; }
.fb-badge { display:inline-flex; align-items:center; gap:.45rem; margin-top:1rem; font-size:.7rem; color:var(--muted); background:var(--card); border:1px solid var(--card-b); padding:.26rem .75rem; border-radius:100px; }
.fbb-dot { width:5px; height:5px; border-radius:50%; background:#4ADE80; animation:p 2s infinite; flex-shrink:0; }
@keyframes p { 0%,100%{opacity:1} 50%{opacity:.35} }

.ft-nav { display:flex; gap:3rem; flex-wrap:wrap; }
.fn-col { display:flex; flex-direction:column; gap:.55rem; }
.fn-head { font-size:.63rem; font-weight:700; text-transform:uppercase; letter-spacing:.16em; color:var(--muted); margin-bottom:.35rem; }
.fn-col a { font-size:.82rem; color:var(--muted2); text-decoration:none; transition:color .18s; cursor:pointer; }
.fn-col a:hover { color:var(--text); }

.ft-email-block { margin-bottom:2.5rem; }
.feb-label { display:block; font-size:.62rem; color:var(--muted); text-transform:uppercase; letter-spacing:.18em; margin-bottom:.55rem; }
.feb-email { display:inline-flex; align-items:center; gap:.7rem; font-family:'Outfit',sans-serif; font-size:clamp(1rem,2.5vw,2rem); font-weight:800; color:var(--text); text-decoration:none; letter-spacing:-.03em; border-bottom:1px solid var(--card-b); padding-bottom:.2rem; transition:color .2s,border-color .2s,gap .2s; }
.feb-email:hover { color:var(--red); border-color:var(--red); gap:1rem; }
.feb-email svg { transition:transform .2s; flex-shrink:0; }
.feb-email:hover svg { transform:translate(3px,-3px); }

.ft-hr { height:1px; background:var(--card-b); margin-bottom:1.5rem; position:relative; overflow:hidden; }
.ft-hr::after { content:''; position:absolute; inset-block:0; left:0; width:22%; background:linear-gradient(90deg,var(--red),transparent); }

.ft-bottom { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.8rem; font-size:.74rem; color:var(--muted); }
.ft-icons { display:flex; gap:.45rem; }
.ft-icons a { display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:var(--card); border:1px solid var(--card-b); color:var(--muted2); text-decoration:none; transition:color .2s,border-color .2s; }
.ft-icons a:hover { color:var(--text); border-color:var(--red); }
.ft-made { opacity:.38; }

/* Responsive */
@media (max-width:680px) {
  .ft-top  { flex-direction:column; gap:2rem; }
  .ft-brand { max-width:100%; }
  .ft-nav  { gap:2rem; }
  .feb-email { font-size:clamp(.95rem,5vw,1.4rem); word-break:break-all; }
  .ft-bottom { flex-direction:column; align-items:flex-start; gap:.6rem; }
}

@media (max-width:400px) {
  .fi { padding:3rem 4vw 1.5rem; }
  .fn-col { gap:.45rem; }
}
</style>