<template>
  <div class="site" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />

    <main>
      <!-- ══════════════ HERO ══════════════ -->
      <section id="hero" class="hero">
        <div class="h-bg">
          <div class="orb o1"></div>
          <div class="orb o2"></div>
          <div class="h-grid"></div>
        </div>
        <div class="h-inner">
          <div class="h-left">
            <div class="avail-bar">
              <span class="av-dot"></span>
              <span>Disponible · Cameroun · <strong>2026</strong></span>
            </div>
            <h1 class="h1">
              <span class="h1-sm">Mabong Anaba</span>
              <span class="h1-lg">Rosnel<br>Pacely</span>
            </h1>
            <div class="role">
              <span class="rbar"></span>
              Ingénieur Informaticien · Full-Stack Developer
            </div>
            <p class="hdesc">
              Je conçois des systèmes web robustes, des interfaces qui marquent
              les esprits et des APIs qui tiennent la charge.
              Code propre · Architecture réfléchie · Livraison rapide.
            </p>
            <div class="hbtns">
              <a href="#projects" class="btn-red" @click.prevent="go('projects')">
                Voir mes projets
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
              <Link href="/contact" class="btn-outline">Contactez-moi</Link>
              <a href="/cv-rosnel-pacely.pdf" download class="btn-cv">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Mon CV
              </a>
            </div>
            <div class="stats" ref="statsRef">
              <div class="st">
                <span class="st-n">{{ counters.projects }}<span class="st-plus">+</span></span>
                <span class="st-l">Projets</span>
              </div>
              <div class="st-sep"></div>
              <div class="st">
                <span class="st-n">{{ counters.years }}<span class="st-plus">+</span></span>
                <span class="st-l">Années</span>
              </div>
              <div class="st-sep"></div>
              <div class="st">
                <span class="st-n">{{ counters.tech }}</span>
                <span class="st-l">Technos</span>
              </div>
            </div>
          </div>
          <div class="h-right">
            <div class="photo-frame">
              <div class="pf-ring"></div>
              <div class="pf-img">
                <img v-if="showPhoto" :src="photoUrl" alt="Rosnel" @error="showPhoto=false"/>
                <div v-else class="pf-ph">
                  <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  <span>Votre photo</span>
                </div>
              </div>
              <div class="pf-card">
                <span class="pfc-dot"></span>
                <div>
                  <div class="pfc-t">Full-Stack Dev</div>
                  <div class="pfc-s">Laravel · Vue · React</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="scroll-ind"><div class="si-bar"></div><span>Scroll</span></div>
      </section>

      <!-- ══════════════ ABOUT ══════════════ -->
      <section id="about" class="about">
        <div class="a-inner">
          <div class="a-left">
            <div class="sec-label">01 · À propos</div>
            <h2 class="sec-h2">L'ingénieur<br><em>derrière le code</em></h2>
            <p>Ingénieur Informaticien diplômé de l'IAI (Institut Africain d'Informatique), je me suis spécialisé dans le développement full-stack Laravel avec un focus sur la performance, la maintenabilité et l'expérience utilisateur.</p>
            <p>Mon approche : architecture d'abord, implémentation ensuite. Chaque projet que je livre est pensé pour durer et évoluer facilement.</p>
            <div class="chips">
              <span v-for="c in chips" :key="c">{{ c }}</span>
            </div>
            <a href="/cv-rosnel-pacely.pdf" download class="about-cv">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Télécharger mon CV
            </a>
          </div>
          <div class="a-right">
            <div class="sk-head">Compétences</div>
            <div class="sk-list">
              <div v-for="s in skills" :key="s.name" class="sk-row">
                <div class="skr-top">
                  <div class="skr-ico" :style="{ color:s.color, background:s.color+'16' }">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" v-html="s.svg"></svg>
                  </div>
                  <span class="skr-name">{{ s.name }}</span>
                  <span class="skr-pct" :style="{ color:s.color }">{{ s.lvl }}%</span>
                </div>
                <div class="skr-track"><div class="skr-fill" :style="{ width:s.lvl+'%', background:s.color }"></div></div>
              </div>
            </div>
          </div>
        </div>
        <div class="tools-row">
          <div class="tr-label">Stack technique</div>
          <div class="tr-wrap">
            <div class="tr-track">
              <div v-for="(t,i) in [...tools,...tools]" :key="i" class="tr-chip">
                <img :src="t.logo" :alt="t.name" width="15" height="15"/>
                <span>{{ t.name }}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════ TIMELINE ══════════════ -->
      <section id="timeline" class="timeline-sec">
        <div class="tl-inner">
          <div class="tl-head">
            <div class="sec-label">02 · Parcours</div>
            <h2 class="sec-h2">Formations &<br><em>expériences</em></h2>
          </div>
          <div class="tl-track">
            <div v-for="(item, i) in timeline" :key="i" class="tl-item">
              <div class="tl-left-col">
                <div class="tl-dot" :style="{ background: item.color }">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" v-html="item.icon"></svg>
                </div>
                <div class="tl-line" v-if="i < timeline.length - 1"></div>
              </div>
              <div class="tl-card">
                <div class="tlc-meta">
                  <span class="tlc-year" :style="{ color: item.color }">{{ item.year }}</span>
                  <span class="tlc-badge" :style="{ color: item.color, background: item.color+'16', borderColor: item.color+'30' }">
                    {{ item.type === 'edu' ? 'Formation' : 'Expérience' }}
                  </span>
                </div>
                <div class="tlc-title">{{ item.title }}</div>
                <div class="tlc-org">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                  {{ item.org }}
                </div>
                <p class="tlc-desc">{{ item.desc }}</p>
                <div v-if="item.tags" class="tlc-tags">
                  <span v-for="t in item.tags" :key="t">{{ t }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════ PROJETS ══════════════ -->
      <section id="projects" class="projects">
        <div class="p-inner">
          <div class="p-head">
            <div class="sec-label">03 · Projets</div>
            <h2 class="sec-h2">Ce que j'ai<br><em>construit</em></h2>
          </div>
          <div class="p-grid">
            <article v-for="(p,i) in projects" :key="p.slug" class="pc" :style="{ '--c': p.color }">
              <Link :href="'/projets/'+p.slug" class="pc-visual">
                <img v-if="p.image" :src="p.image" :alt="p.title" class="pc-img"/>
                <div v-else class="pc-visual-ph">
                  <div class="pcvph-num">{{ String(i+1).padStart(2,'0') }}</div>
                  <div class="pcvph-stack">
                    <img v-for="logo in p.logos" :key="logo" :src="logo" width="24" height="24" style="object-fit:contain"/>
                  </div>
                </div>
                <div class="pc-overlay"><span>Voir le projet →</span></div>
              </Link>
              <div class="pc-body">
                <div class="pc-head-row">
                  <div class="pc-tags"><span v-for="t in p.tags" :key="t">{{ t }}</span></div>
                  <span class="pc-yr">{{ p.year }}</span>
                </div>
                <h3 class="pc-title">{{ p.title }}</h3>
                <p class="pc-desc">{{ p.desc }}</p>
                <div class="pc-actions">
                  <Link :href="'/projets/'+p.slug" class="pca-main">
                    Voir le projet
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                  </Link>
                  <a v-if="p.github" :href="p.github" target="_blank" rel="noopener" class="pca-gh">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
                    GitHub
                  </a>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- ══════════════ CONTACT ══════════════ -->
      <section id="contact" class="contact">
        <div class="c-bg"></div>
        <div class="c-inner">
          <div class="sec-label light">04 · Contact</div>
          <h2 class="c-h2">Démarrons un<br><em>projet ensemble</em></h2>
          <p class="c-p">Mission freelance, CDI, collaboration — écrivez-moi, je réponds sous 24h.</p>
          <Link href="/contact" class="c-btn">
            Ouvrir le formulaire
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </Link>
          <div class="c-or">ou directement</div>
          <a href="mailto:mrrosnel6@gmail.com" class="c-email">
            mrrosnel6@gmail.com
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
          <div class="c-links">
            <a href="https://github.com/rosnel20" target="_blank" rel="noopener" class="cl">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
              github.com/rosnel20
            </a>
            <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener" class="cl">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
              LinkedIn
            </a>
          </div>
        </div>
      </section>

      <AppFooter />
    </main>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'

const theme = ref(localStorage.getItem('theme') || 'dark')
function toggleTheme() {
  theme.value = theme.value === 'dark' ? 'light' : 'dark'
  localStorage.setItem('theme', theme.value)
}
function go(id) {
  const el = document.getElementById(id)
  if (el) window.scrollTo({ top: el.offsetTop - 90, behavior: 'smooth' })
}

const showPhoto = ref(false)
const photoUrl  = '/images/photo.jpg'

/* ── Compteurs animés ── */
const statsRef = ref(null)
const counters = reactive({ projects: 0, years: 0, tech: 0 })
const targets  = { projects: 12, years: 3, tech: 14 }
let animated   = false

function animateCounters() {
  if (animated) return
  animated = true
  const duration = 1400
  const start = performance.now()
  function step(now) {
    const t = Math.min((now - start) / duration, 1)
    const ease = 1 - Math.pow(1 - t, 3)
    counters.projects = Math.round(ease * targets.projects)
    counters.years    = Math.round(ease * targets.years)
    counters.tech     = Math.round(ease * targets.tech)
    if (t < 1) requestAnimationFrame(step)
  }
  requestAnimationFrame(step)
}

let observer
onMounted(() => {
  observer = new IntersectionObserver(
    ([e]) => { if (e.isIntersecting) animateCounters() },
    { threshold: 0.3 }
  )
  if (statsRef.value) observer.observe(statsRef.value)
})
onUnmounted(() => observer?.disconnect())

/* ── Data ── */
const chips = ['Laravel', 'Vue.js', 'React', 'MySQL', 'Python', 'Tailwind', 'Bootstrap', 'Git']

const skills = [
  { name: 'Backend · Laravel / PHP',      lvl: 88, color: '#E53E3E', svg: '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>' },
  { name: 'Frontend · Vue.js / React',    lvl: 82, color: '#3B82F6', svg: '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>' },
  { name: 'Base de données · SQL',        lvl: 80, color: '#60A5FA', svg: '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>' },
  { name: 'UI/UX · Tailwind / Bootstrap', lvl: 75, color: '#FC8181', svg: '<path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>' },
  { name: 'Python & Scripting',           lvl: 70, color: '#93C5FD', svg: '<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>' },
  { name: 'Git & DevOps',                 lvl: 72, color: '#FBBF24', svg: '<circle cx="18" cy="18" r="3"/><circle cx="6" cy="6" r="3"/><path d="M13 6h3a2 2 0 0 1 2 2v7"/><line x1="6" y1="9" x2="6" y2="21"/>' },
]

const tools = [
  { name: 'Laravel',    logo: 'https://cdn.simpleicons.org/laravel/FF2D20' },
  { name: 'Vue.js',     logo: 'https://cdn.simpleicons.org/vuedotjs/42B883' },
  { name: 'React',      logo: 'https://cdn.simpleicons.org/react/61DAFB' },
  { name: 'Inertia.js', logo: 'https://cdn.simpleicons.org/inertia/9553E9' },
  { name: 'Tailwind',   logo: 'https://cdn.simpleicons.org/tailwindcss/06B6D4' },
  { name: 'Bootstrap',  logo: 'https://cdn.simpleicons.org/bootstrap/7952B3' },
  { name: 'JavaScript', logo: 'https://cdn.simpleicons.org/javascript/F7DF1E' },
  { name: 'Python',     logo: 'https://cdn.simpleicons.org/python/3776AB' },
  { name: 'HTML5',      logo: 'https://cdn.simpleicons.org/html5/E34F26' },
  { name: 'CSS3',       logo: 'https://cdn.simpleicons.org/css3/1572B6' },
  { name: 'MySQL',      logo: 'https://cdn.simpleicons.org/mysql/4479A1' },
  { name: 'SQLite',     logo: 'https://cdn.simpleicons.org/sqlite/003B57' },
  { name: 'PHP',        logo: 'https://cdn.simpleicons.org/php/8892BF' },
  { name: 'Git',        logo: 'https://cdn.simpleicons.org/git/F05032' },
]

/* ── Timeline ── */
const timeline = [
  {
    year:  '2025',
    type:  'edu',
    color: '#E53E3E',
    title: "Diplôme d'Ingénieur Informaticien",
    org:   'IAI — Institut Africain d\'Informatique · Cameroun',
    desc:  "Diplôme d'ingénieur en informatique, spécialité développement logiciel et systèmes d'information. Formation orientée architecture, bases de données avancées et gestion de projets.",
    tags:  ['Génie Logiciel', 'Architecture SI', 'Bases de données', 'Gestion de projet'],
    icon:  '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
  },
  {
    year:  '2025 – 2026',
    type:  'work',
    color: '#10B981',
    title: 'Formation professionnelle — Développement Laravel Full-Stack',
    org:   'Mercy Innovation Lab · Cameroun',
    desc:  "Formation intensive de 5 mois entièrement dédiée au développement d'applications avec Laravel pour les développeurs full-stack. Conception d'APIs RESTful, architecture MVC, Eloquent ORM, tests automatisés et déploiement.",
    tags:  ['Laravel', 'PHP', 'MySQL', 'REST API', 'Vue.js', 'Inertia.js'],
    icon:  '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
  },
  {
    year:  '2024',
    type:  'edu',
    color: '#3B82F6',
    title: 'DTS Informatique',
    org:   'IAI — Institut Africain d\'Informatique · Cameroun',
    desc:  "Diplôme de Technicien Supérieur en informatique. Formation aux fondamentaux du développement logiciel, algorithmique, programmation orientée objet, développement web et administration de bases de données.",
    tags:  ['HTML/CSS', 'PHP', 'JavaScript', 'MySQL', 'Java', 'POO'],
    icon:  '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
  },
]

/* ── Projets ── */
const projects = [
  {
    slug:   'taskflow',
    title:  'TaskFlow',
    desc:   'Plateforme complète de gestion de projets informatiques pour ingénieurs ITI. Développée avec Laravel et Blade.',
    year:   '2025',
    tags:   ['Laravel', 'Blade', 'MySQL', 'Bootstrap'],
    color:  '#E53E3E',
    github: 'https://github.com/rosnel20/app_formation',
    image:  '/images/taskflow.png',
    logos:  [
      'https://cdn.simpleicons.org/laravel/FF2D20',
      'https://cdn.simpleicons.org/mysql/4479A1',
      'https://cdn.simpleicons.org/bootstrap/7952B3',
    ],
  },
]
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap');

/* ══ THÈME ══ */
.site.dark {
  --bg: #0A0A0A; --bg2: #111111; --footer-bg: #080808;
  --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text: #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg: rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red: #E53E3E; --red-soft: rgba(229,62,62,.1); --blue: #3B82F6;
}
.site.light {
  --bg: #F8F8F8; --bg2: #FFFFFF; --footer-bg: #EFEFEF;
  --card: rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text: #0A0A0A; --muted: #888; --muted2: #AAA;
  --nav-bg: rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red: #C53030; --red-soft: rgba(197,48,48,.08); --blue: #2563EB;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
.site { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; transition: background .4s, color .4s; }

.sec-label { font-family: 'JetBrains Mono', monospace; font-size: .67rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1rem; display: flex; align-items: center; gap: .6rem; }
.sec-label::before { content: ''; display: block; width: 18px; height: 1px; background: var(--red); }
.sec-label.light { color: rgba(255,255,255,.3); }
.sec-label.light::before { background: rgba(255,255,255,.4); }
.sec-h2 { font-size: clamp(1.9rem, 4.5vw, 3.2rem); font-weight: 900; line-height: 1.05; letter-spacing: -.05em; color: var(--text); }
.sec-h2 em { font-style: italic; color: var(--red); }

/* ══ HERO ══ */
.hero { position: relative; min-height: 100vh; display: flex; align-items: center; padding: 7rem 5vw 5rem; overflow: hidden; }
.h-bg { position: absolute; inset: 0; pointer-events: none; }
.orb  { position: absolute; border-radius: 50%; filter: blur(100px); }
.o1   { width: 580px; height: 580px; background: var(--red); opacity: .06; top: -140px; right: -80px; animation: orb 12s ease-in-out infinite; }
.o2   { width: 400px; height: 400px; background: var(--blue); opacity: .05; bottom: -60px; left: 5%; animation: orb 16s ease-in-out infinite reverse; }
@keyframes orb { 0%,100%{transform:translate(0,0)} 50%{transform:translate(28px,-22px)} }
.h-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px); background-size: 50px 50px; -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%,black 30%,transparent); mask-image: radial-gradient(ellipse 70% 70% at 50% 50%,black 30%,transparent); }

.h-inner { position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 4rem; max-width: 1200px; margin: 0 auto; width: 100%; }
.h-left  { flex: 1; min-width: 0; }

/* ── Disponibilité ── */
.avail-bar {
  display: inline-flex; align-items: center; gap: .6rem;
  background: rgba(229,62,62,.08);
  border: 1px solid rgba(229,62,62,.25);
  padding: .35rem 1rem; border-radius: 100px;
  margin-bottom: 1.8rem; font-size: .75rem;
  color: rgba(229,62,62,.9);
  letter-spacing: .08em; text-transform: uppercase;
}
.av-dot {
  width: 7px; height: 7px; border-radius: 50%;
  background: #4ADE80;
  animation: bl 2s infinite; flex-shrink: 0;
}
.avail-bar strong { color: var(--red); }
@keyframes bl { 0%,100%{opacity:1} 50%{opacity:.3} }

.h1    { display: flex; flex-direction: column; font-weight: 900; letter-spacing: -.05em; margin-bottom: 1.1rem; }
.h1-sm { font-size: clamp(1rem, 2vw, 1.6rem); color: var(--muted2); font-weight: 400; letter-spacing: -.02em; }
.h1-lg { font-size: clamp(3rem, 7.5vw, 6.5rem); line-height: .92; background: linear-gradient(135deg, var(--text) 50%, var(--red)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.role  { display: flex; align-items: center; gap: .8rem; font-family: 'JetBrains Mono', monospace; font-size: clamp(.63rem, .9vw, .76rem); color: var(--muted2); letter-spacing: .05em; margin-bottom: 1.4rem; }
.rbar  { width: 26px; height: 1px; background: var(--red); flex-shrink: 0; }
.hdesc { font-size: clamp(.85rem, 1.1vw, .97rem); line-height: 1.85; color: var(--muted2); max-width: 480px; margin-bottom: 2.2rem; }

.hbtns { display: flex; align-items: center; gap: .85rem; flex-wrap: wrap; margin-bottom: 2.8rem; }
.btn-red { display: inline-flex; align-items: center; gap: .5rem; background: var(--red); color: #fff; padding: .82rem 1.7rem; border-radius: 10px; font-weight: 700; font-size: .88rem; text-decoration: none; cursor: pointer; box-shadow: 0 6px 24px rgba(229,62,62,.28); transition: transform .2s, opacity .2s; }
.btn-outline { display: inline-flex; align-items: center; background: transparent; color: var(--text); border: 1px solid var(--card-b); padding: .82rem 1.7rem; border-radius: 10px; font-size: .88rem; text-decoration: none; transition: border-color .2s, background .2s; }
.btn-cv { display: inline-flex; align-items: center; gap: .45rem; background: var(--card); border: 1px solid var(--card-b); color: var(--text); padding: .82rem 1.2rem; border-radius: 10px; font-size: .84rem; font-weight: 600; text-decoration: none; transition: border-color .2s, background .2s, color .2s; }

/* Compteurs */
.stats { display: flex; align-items: center; gap: 2rem; flex-wrap: wrap; }
.st-n  { display: block; font-size: clamp(1.6rem, 3vw, 2rem); font-weight: 900; letter-spacing: -.04em; color: var(--text); line-height: 1; }
.st-plus { font-size: .7em; color: var(--red); }
.st-l  { font-size: .65rem; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; }
.st-sep { width: 1px; height: 36px; background: var(--card-b); }

/* Photo */
.h-right { flex-shrink: 0; }
.photo-frame { position: relative; width: clamp(200px, 22vw, 290px); height: clamp(200px, 22vw, 290px); display: flex; align-items: center; justify-content: center; }
.pf-ring { position: absolute; inset: -12px; border-radius: 50%; border: 1.5px solid transparent; background: linear-gradient(135deg, var(--red), var(--blue)) border-box; -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; animation: spin 12s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.pf-img { width: 85%; height: 85%; border-radius: 50%; overflow: hidden; background: var(--card); border: 1px solid var(--card-b); }
.pf-img img { width: 100%; height: 100%; object-fit: cover; }
.pf-ph  { width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .6rem; color: var(--muted); font-size: .76rem; }
.pf-card { position: absolute; bottom: 10px; right: -10px; display: flex; align-items: center; gap: .6rem; background: var(--bg2); border: 1px solid rgba(229,62,62,.22); padding: .48rem .95rem; border-radius: 12px; backdrop-filter: blur(12px); white-space: nowrap; }
.pfc-dot { width: 7px; height: 7px; border-radius: 50%; background: #4ADE80; animation: bl 2s infinite; }
.pfc-t  { font-size: .75rem; font-weight: 700; color: var(--text); }
.pfc-s  { font-size: .62rem; color: var(--muted2); }
.scroll-ind { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: .4rem; font-family: 'JetBrains Mono', monospace; font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: var(--muted); }
.si-bar { width: 1px; height: 38px; background: var(--card-b); overflow: hidden; position: relative; }
.si-bar::after { content: ''; position: absolute; inset-inline: 0; top: 0; height: 50%; background: var(--red); animation: sb 2.4s ease-in-out infinite; }
@keyframes sb { 0%{transform:translateY(-100%);opacity:0} 30%{opacity:1} 100%{transform:translateY(200%);opacity:0} }

/* ══ ABOUT ══ */
.about { background: var(--bg2); padding: 6rem 5vw; }
.a-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; max-width: 1200px; margin: 0 auto 4rem; align-items: start; }
.a-left p { font-size: .92rem; color: var(--muted2); line-height: 1.9; margin-bottom: 1rem; }
.chips { display: flex; flex-wrap: wrap; gap: .4rem; margin-top: 1.5rem; margin-bottom: 1.5rem; }
.chips span { font-family: 'JetBrains Mono', monospace; font-size: .66rem; color: var(--red); background: var(--red-soft); border: 1px solid rgba(229,62,62,.15); padding: .2rem .68rem; border-radius: 5px; }
.about-cv { display: inline-flex; align-items: center; gap: .5rem; font-size: .82rem; font-weight: 700; color: var(--red); border: 1px solid rgba(229,62,62,.25); background: var(--red-soft); padding: .5rem 1.1rem; border-radius: 8px; text-decoration: none; transition: background .2s, border-color .2s; }
.sk-head { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1.2rem; }
.sk-list { display: flex; flex-direction: column; gap: .8rem; }
.skr-top { display: flex; align-items: center; gap: .6rem; margin-bottom: .4rem; }
.skr-ico { width: 28px; height: 28px; border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.skr-name { font-size: .82rem; font-weight: 600; color: var(--text); flex: 1; min-width: 0; }
.skr-pct { font-family: 'JetBrains Mono', monospace; font-size: .72rem; font-weight: 700; }
.skr-track { height: 2px; background: var(--card-b); border-radius: 1px; overflow: hidden; }
.skr-fill  { height: 100%; border-radius: 1px; }
.tools-row { max-width: 1200px; margin: 0 auto; }
.tr-label  { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; margin-bottom: .9rem; }
.tr-wrap   { overflow: hidden; -webkit-mask-image: linear-gradient(to right,transparent,black 6%,black 94%,transparent); mask-image: linear-gradient(to right,transparent,black 6%,black 94%,transparent); }
.tr-track  { display: flex; gap: .7rem; width: max-content; animation: sl 28s linear infinite; }
@keyframes sl { to { transform: translateX(-50%); } }
.tr-chip { display: flex; align-items: center; gap: .48rem; background: var(--card); border: 1px solid var(--card-b); padding: .4rem .9rem; border-radius: 100px; font-size: .78rem; font-weight: 500; color: var(--muted2); white-space: nowrap; }
.tr-chip img { object-fit: contain; }

/* ══ TIMELINE ══ */
.timeline-sec { background: var(--bg); padding: 6rem 5vw; }
.tl-inner { max-width: 860px; margin: 0 auto; }
.tl-head  { margin-bottom: 3.5rem; }
.tl-track { display: flex; flex-direction: column; }
.tl-item { display: grid; grid-template-columns: 48px 1fr; gap: 0 1.5rem; }
.tl-left-col { display: flex; flex-direction: column; align-items: center; }
.tl-dot  { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; z-index: 1; box-shadow: 0 0 0 6px var(--bg); }
.tl-line { width: 2px; flex: 1; background: var(--card-b); margin: 6px 0; min-height: 32px; }
.tl-card { background: var(--card); border: 1px solid var(--card-b); border-radius: 16px; padding: 1.5rem 1.8rem; margin-bottom: 2rem; transition: border-color .2s, box-shadow .2s; }
.tlc-meta  { display: flex; align-items: center; gap: .7rem; margin-bottom: .8rem; flex-wrap: wrap; }
.tlc-year  { font-family: 'JetBrains Mono', monospace; font-size: .72rem; font-weight: 700; letter-spacing: .08em; }
.tlc-badge { font-family: 'JetBrains Mono', monospace; font-size: .6rem; letter-spacing: .1em; text-transform: uppercase; padding: .14rem .6rem; border-radius: 5px; border: 1px solid; }
.tlc-title { font-size: 1.05rem; font-weight: 800; color: var(--text); margin-bottom: .45rem; letter-spacing: -.02em; line-height: 1.25; }
.tlc-org   { display: flex; align-items: center; gap: .45rem; font-size: .8rem; color: var(--muted2); margin-bottom: .75rem; }
.tlc-desc  { font-size: .85rem; color: var(--muted); line-height: 1.75; margin-bottom: .9rem; }
.tlc-tags  { display: flex; flex-wrap: wrap; gap: .32rem; }
.tlc-tags span { font-family: 'JetBrains Mono', monospace; font-size: .6rem; color: var(--muted2); background: var(--card); border: 1px solid var(--card-b); padding: .12rem .5rem; border-radius: 4px; }

/* ══ PROJETS ══ */
.projects { background: var(--bg2); padding: 6rem 5vw; }
.p-inner  { max-width: 1200px; margin: 0 auto; }
.p-head   { margin-bottom: 3rem; }
.p-grid   { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.2rem; }
.pc { background: var(--card); border: 1px solid var(--card-b); border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: transform .25s, border-color .25s, box-shadow .25s; }
.pc-visual { display: block; position: relative; overflow: hidden; height: 180px; flex-shrink: 0; text-decoration: none; background: color-mix(in srgb, var(--c) 14%, var(--bg)); }
.pc-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: top; display: block; transition: transform .35s; }
.pc-visual-ph { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .9rem; }
.pcvph-num { font-size: 4rem; font-weight: 900; color: var(--c); opacity: .16; letter-spacing: -.06em; line-height: 1; }
.pcvph-stack { display: flex; gap: .6rem; align-items: center; }
.pc-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.58); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .25s; z-index: 2; }
.pc-overlay span { color: #fff; font-weight: 700; font-size: .88rem; border: 1px solid rgba(255,255,255,.55); padding: .5rem 1.3rem; border-radius: 8px; backdrop-filter: blur(4px); }
.pc-body { padding: 1.3rem; flex: 1; display: flex; flex-direction: column; }
.pc-head-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: .85rem; gap: .5rem; }
.pc-tags { display: flex; flex-wrap: wrap; gap: .28rem; }
.pc-tags span { font-family: 'JetBrains Mono', monospace; font-size: .58rem; color: var(--c); background: color-mix(in srgb, var(--c) 12%, transparent); border: 1px solid color-mix(in srgb, var(--c) 24%, transparent); padding: .12rem .48rem; border-radius: 4px; }
.pc-yr    { font-family: 'JetBrains Mono', monospace; font-size: .58rem; color: var(--muted); white-space: nowrap; }
.pc-title { font-size: 1.04rem; font-weight: 800; color: var(--text); margin-bottom: .48rem; letter-spacing: -.02em; }
.pc-desc  { font-size: .79rem; color: var(--muted); line-height: 1.7; flex: 1; margin-bottom: 1.2rem; }
.pc-actions { display: flex; align-items: center; gap: .6rem; margin-top: auto; }
.pca-main { display: inline-flex; align-items: center; gap: .4rem; font-size: .78rem; font-weight: 700; color: var(--c); text-decoration: none; transition: gap .2s; }
.pca-gh { display: inline-flex; align-items: center; gap: .35rem; font-size: .72rem; color: var(--muted2); text-decoration: none; border: 1px solid var(--card-b); padding: .25rem .65rem; border-radius: 6px; margin-left: auto; transition: color .2s, border-color .2s; }

/* ══ CONTACT ══ */
.contact { position: relative; overflow: hidden; background: #080808; padding: 8rem 5vw; text-align: center; }
.c-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 55% 45% at 50% -5%,rgba(229,62,62,.1),transparent 60%),radial-gradient(ellipse 45% 55% at 80% 100%,rgba(59,130,246,.06),transparent 60%); pointer-events: none; }
.c-inner { position: relative; z-index: 2; max-width: 660px; margin: 0 auto; }
.c-h2 { font-size: clamp(2rem, 5.5vw, 4.2rem); font-weight: 900; color: #fff; letter-spacing: -.06em; line-height: .95; margin-bottom: 1.2rem; }
.c-h2 em { font-style: italic; color: var(--red); }
.c-p  { font-size: .93rem; color: rgba(255,255,255,.35); line-height: 1.85; margin-bottom: 2.5rem; }
.c-btn { display: inline-flex; align-items: center; gap: .6rem; background: var(--red); color: #fff; padding: .9rem 2rem; border-radius: 12px; font-weight: 700; font-size: .92rem; text-decoration: none; box-shadow: 0 6px 24px rgba(229,62,62,.3); transition: transform .2s, opacity .2s; margin-bottom: 1.5rem; }
.c-or { font-size: .72rem; color: rgba(255,255,255,.2); text-transform: uppercase; letter-spacing: .15em; margin-bottom: 1.5rem; }
.c-email { display: inline-flex; align-items: center; gap: .75rem; font-size: clamp(.95rem, 2.8vw, 1.8rem); font-weight: 800; color: #fff; text-decoration: none; letter-spacing: -.03em; border-bottom: 1px solid rgba(255,255,255,.15); padding-bottom: .22rem; margin-bottom: 2.5rem; transition: color .2s, border-color .2s, gap .2s; }
.c-links { display: flex; align-items: center; justify-content: center; gap: 1.2rem; flex-wrap: wrap; }
.cl { display: inline-flex; align-items: center; gap: .42rem; font-size: .84rem; color: rgba(255,255,255,.35); text-decoration: none; transition: color .2s; }

/* ══ HOVER : uniquement sur les vrais dispositifs pointeurs ══ */
@media (hover: hover) and (pointer: fine) {
  .pc:hover { transform: translateY(-6px); border-color: var(--c); box-shadow: 0 16px 48px rgba(0,0,0,.22); }
  .pc:hover .pc-img { transform: scale(1.05); }
  .pc:hover .pc-overlay { opacity: 1; }
  .btn-red:hover { transform: translateY(-2px); opacity: .9; }
  .btn-outline:hover { border-color: var(--red); background: var(--red-soft); }
  .btn-cv:hover { border-color: var(--red); background: var(--red-soft); color: var(--red); }
  .tl-card:hover { border-color: rgba(229,62,62,.2); box-shadow: 0 4px 24px rgba(0,0,0,.1); }
  .c-btn:hover { transform: translateY(-2px); opacity: .9; }
  .c-email:hover { color: var(--red); border-color: var(--red); gap: 1.1rem; }
  .cl:hover { color: #fff; }
  .pca-main:hover { gap: .7rem; }
  .pca-gh:hover { color: var(--text); border-color: var(--c); }
  .about-cv:hover { background: rgba(229,62,62,.18); border-color: var(--red); }
}

/* Sur mobile : overlay projet toujours visible en bas (indicateur fixe) */
@media (hover: none) {
  .pc-overlay {
    opacity: 1;
    background: linear-gradient(to top, rgba(0,0,0,.65) 0%, transparent 60%);
    align-items: flex-end;
    padding-bottom: .75rem;
  }
  .pc-overlay span {
    font-size: .75rem;
    padding: .35rem 1rem;
    border-radius: 6px;
  }
}

/* ══ RESPONSIVE ══ */
@media (max-width: 1024px) {
  .p-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 860px) {
  .h-inner  { flex-direction: column-reverse; text-align: center; gap: 2rem; }
  .h-left   { display: flex; flex-direction: column; align-items: center; width: 100%; }
  .hdesc    { text-align: left; max-width: 100%; }
  .role     { justify-content: center; }
  .hbtns    { justify-content: center; }
  .stats    { justify-content: center; }
  .h-right  { width: 100%; display: flex; justify-content: center; }
  .photo-frame { width: 200px; height: 200px; }
  .pf-card  { right: -5px; bottom: 5px; }
  .a-inner  { grid-template-columns: 1fr; gap: 2.5rem; }
  .scroll-ind { display: none; }
}

@media (max-width: 680px) {
  .hero     { padding: 5.5rem 5vw 4rem; min-height: auto; }
  .about, .timeline-sec, .projects { padding: 4.5rem 5vw; }
  .contact  { padding: 5rem 5vw; }
  .p-grid   { grid-template-columns: 1fr; }
  .hbtns    { flex-direction: column; align-items: stretch; width: 100%; max-width: 320px; }
  .btn-red, .btn-outline, .btn-cv { justify-content: center; }
  .tl-item  { grid-template-columns: 36px 1fr; gap: 0 1rem; }
  .tl-dot   { width: 36px; height: 36px; }
  .pc-visual { height: 160px; }
  .pc-body  { padding: 1.1rem; }
  .pc-title { font-size: .96rem; }
}

@media (max-width: 480px) {
  .hero     { padding: 5rem 4vw 3.5rem; }
  .about, .timeline-sec, .projects, .contact { padding: 4rem 4vw; }
  .h1-lg    { font-size: clamp(2.4rem, 11vw, 3.2rem); }
  .stats    { gap: 1.2rem; }
  .pf-card  { display: none; }
  .c-email  { font-size: 1rem; word-break: break-all; }
  .c-btn    { width: 100%; justify-content: center; }
  .tl-card  { padding: 1.1rem 1.2rem; }
  .tl-item  { grid-template-columns: 30px 1fr; gap: 0 .75rem; }
  .tl-dot   { width: 30px; height: 30px; }
  .sec-h2   { font-size: clamp(1.7rem, 7vw, 2.4rem); }
  .avail-bar { font-size: .68rem; padding: .3rem .85rem; }
  .hbtns    { max-width: 100%; }
  .btn-red, .btn-outline, .btn-cv { font-size: .84rem; padding: .78rem 1.3rem; }
  .chips span { font-size: .62rem; }
  .pc-tags span { font-size: .55rem; }
}

@media (max-width: 360px) {
  .stats { gap: .9rem; }
  .st-n  { font-size: 1.4rem; }
  .st-sep { height: 28px; }
  .h1-lg { font-size: 2.2rem; }
  .c-links { gap: .8rem; }
  .cl    { font-size: .78rem; }
}
</style>