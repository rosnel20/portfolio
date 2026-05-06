<template>
  <footer class="footer" :class="dark ? 'dark' : 'light'" role="contentinfo">
    <div class="f-inner">

      <!-- Brand -->
      <div class="f-brand">
        <Link href="/" class="f-logo" aria-label="Rosnel Pacely — Home">
          <span class="fl-r">R</span>osnel<span class="fl-dot">.</span>
        </Link>
        <p class="f-tagline">
          Full-Stack Engineer · Laravel · Vue.js · React<br>
          <span class="f-location">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Yaoundé, Cameroon — Remote worldwide
          </span>
        </p>
        <div class="f-avail">
          <span class="fa-dot"></span>
          Open to opportunities · 2026
        </div>
      </div>

      <!-- Navigation -->
      <nav class="f-nav" aria-label="Footer navigation">
        <div class="fn-col">
          <div class="fn-head">Navigation</div>
          <ul>
            <li><Link href="/">Home</Link></li>
            <li><Link href="/about">About</Link></li>
            <li><Link href="/blog">Blog</Link></li>
            <li><Link href="/contact">Contact</Link></li>
          </ul>
        </div>
        <div class="fn-col">
          <div class="fn-head">Projects</div>
          <ul>
            <li><Link href="/projets/taskflow">TaskFlow</Link></li>
          </ul>
        </div>
        <div class="fn-col">
          <div class="fn-head">Connect</div>
          <ul>
            <li>
              <a href="https://github.com/rosnel20" target="_blank" rel="noopener">
                GitHub
                <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
              </a>
            </li>
            <li>
              <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener">
                LinkedIn
                <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
              </a>
            </li>
            <li>
              <a href="mailto:mrrosnel6@gmail.com">
                Email
              </a>
            </li>
          </ul>
        </div>
      </nav>

    </div>

    <!-- Bottom bar -->
    <div class="f-bottom">
      <div class="f-bottom-inner">
        <span class="f-copy">
          © {{ year }} Mabong Anaba Rosnel Pacely — All rights reserved.
        </span>
        <div class="f-bottom-links">
          <a href="/sitemap.xml" target="_blank" rel="noopener">Sitemap</a>
          <a href="/robots.txt"  target="_blank" rel="noopener">Robots</a>
        </div>
        <span class="f-made">
          Built with
          <a href="https://laravel.com" target="_blank" rel="noopener">Laravel</a>
          ·
          <a href="https://vuejs.org" target="_blank" rel="noopener">Vue 3</a>
          ·
          <a href="https://inertiajs.com" target="_blank" rel="noopener">Inertia.js</a>
        </span>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ dark: { type: Boolean, default: true } })
const year = new Date().getFullYear()
</script>

<style scoped>
.footer {
  font-family: 'Outfit', sans-serif;
  border-top: 1px solid;
  transition: background .4s, color .4s;
}
.footer.dark  { background: #080808; color: #F0F0F0; border-color: rgba(255,255,255,.07); --muted: #444; --muted2: #666; --card-b: rgba(255,255,255,.07); --red: #E53E3E; }
.footer.light { background: #F0F0F0; color: #0A0A0A; border-color: rgba(0,0,0,.08);    --muted: #bbb; --muted2: #999; --card-b: rgba(0,0,0,.08); --red: #C53030; }

.f-inner {
  display: grid;
  grid-template-columns: 1.6fr 1fr 1fr 1fr;
  gap: 3rem;
  max-width: 1200px; margin: 0 auto;
  padding: 3.5rem 5vw 2.5rem;
}

/* Brand */
.f-logo {
  display: inline-flex; align-items: baseline;
  font-size: 1.15rem; font-weight: 900; letter-spacing: -.04em;
  color: inherit; text-decoration: none; margin-bottom: .75rem;
}
.fl-r, .fl-dot { color: var(--red); }
.f-tagline {
  font-size: .78rem; color: var(--muted2); line-height: 1.8;
  margin-bottom: .9rem;
}
.f-location { display: flex; align-items: center; gap: .3rem; color: var(--muted2); }
.f-avail {
  display: inline-flex; align-items: center; gap: .45rem;
  font-size: .7rem; color: var(--muted2);
  background: rgba(229,62,62,.07); border: 1px solid rgba(229,62,62,.15);
  padding: .3rem .8rem; border-radius: 100px;
}
.fa-dot { width: 6px; height: 6px; border-radius: 50%; background: #4ADE80; animation: bl 2s infinite; flex-shrink: 0; }
@keyframes bl { 0%,100%{opacity:1} 50%{opacity:.3} }

/* Nav */
.fn-head {
  font-family: 'JetBrains Mono', monospace;
  font-size: .6rem; color: var(--muted); letter-spacing: .18em;
  text-transform: uppercase; margin-bottom: .9rem;
}
.fn-col ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: .5rem; }
.fn-col a {
  display: inline-flex; align-items: center; gap: .3rem;
  font-size: .82rem; color: var(--muted2); text-decoration: none;
  transition: color .2s;
}
.fn-col a:hover { color: var(--red); }

/* Bottom */
.f-bottom { border-top: 1px solid var(--card-b); }
.f-bottom-inner {
  max-width: 1200px; margin: 0 auto;
  padding: 1rem 5vw;
  display: flex; align-items: center; justify-content: space-between;
  flex-wrap: wrap; gap: .6rem;
}
.f-copy  { font-size: .72rem; color: var(--muted2); }
.f-bottom-links { display: flex; gap: 1rem; }
.f-bottom-links a { font-size: .7rem; color: var(--muted); text-decoration: none; transition: color .2s; }
.f-bottom-links a:hover { color: var(--red); }
.f-made { font-size: .7rem; color: var(--muted); }
.f-made a { color: var(--muted2); text-decoration: none; transition: color .2s; }
.f-made a:hover { color: var(--red); }

/* Responsive */
@media (max-width: 900px) {
  .f-inner { grid-template-columns: 1fr 1fr; gap: 2rem; }
  .f-brand { grid-column: 1 / -1; }
  .f-nav   { display: contents; }
}
@media (max-width: 560px) {
  .f-inner { grid-template-columns: 1fr 1fr; padding: 2.5rem 5vw 1.5rem; }
  .f-bottom-inner { flex-direction: column; align-items: flex-start; gap: .4rem; }
  .f-made { order: -1; }
}
@media (max-width: 380px) {
  .f-inner { grid-template-columns: 1fr; }
  .f-bottom-inner { padding: .9rem 4vw; }
}
</style>
