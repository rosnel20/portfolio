<template>
  <div class="apage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />
    <AppCursor />

    <main>
      <!-- ══ HERO ABOUT ══ -->
      <section class="ah-section">
        <div class="ah-bg">
          <div class="orb o1"></div>
          <div class="orb o2"></div>
          <div class="ah-grid"></div>
        </div>
        <div class="ah-inner">
          <div class="ah-left reveal">
            <div class="sec-label">À propos</div>
            <h1 class="ah-h1">
              Ingénieur de<br>
              formation, bâtisseur<br>
              <em>par vocation</em>
            </h1>
            <p class="ah-lead">
              Je suis <strong>Rosnel Pacely</strong>, ingénieur Full-Stack basé à Yaoundé, Cameroun.
              Je conçois et développe des systèmes web robustes, maintenables et scalables —
              pour des clients en Afrique et dans le monde entier.
            </p>
            <div class="ah-badges reveal" data-delay="120">
              <span class="badge-item">
                <span class="bi-dot green"></span>
                Disponible · Remote · 2026
              </span>
              <span class="badge-item">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Yaoundé, Cameroun (UTC+1)
              </span>
              <span class="badge-item">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                Ouvert aux opportunités mondiales
              </span>
            </div>
            <div class="ah-ctas reveal" data-delay="180">
              <Link href="/contact" class="btn-red">
                Me contacter
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </Link>
              <a href="/cv-rosnel-pacely.pdf" download class="btn-outline">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Télécharger le CV
              </a>
            </div>
          </div>
          <div class="ah-right reveal" data-delay="80">
            <div class="photo-frame">
              <div class="pf-ring"></div>
              <div class="pf-img">
                <img v-if="showPhoto" :src="photoUrl" alt="Rosnel Pacely — Full-Stack Engineer"
                     loading="eager" decoding="async" width="280" height="280"
                     @error="showPhoto=false"/>
                <div v-else class="pf-ph">
                  <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                </div>
              </div>
              <div class="pf-badge">
                <span class="pb-dot"></span>
                Ingénieur Full-Stack
              </div>
            </div>
            <!-- Stats rapides -->
            <div class="quick-stats">
              <div v-for="s in quickStats" :key="s.label" class="qs-item">
                <span class="qs-n">{{ s.val }}</span>
                <span class="qs-l">{{ s.label }}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══ HISTOIRE ══ -->
      <section class="story-section">
        <div class="st-inner">
          <div class="st-label-col">
            <div class="sec-label reveal">01 · Mon histoire</div>
          </div>
          <div class="st-content">
            <h2 class="sec-h2 reveal">Du Cameroun<br><em>au monde entier</em></h2>
            <div class="st-body">
              <p class="reveal" data-delay="60">
                J'ai commencé à coder pendant mes études de DTS à l'<strong>IAI</strong> (Institut Africain d'Informatique, Yaoundé),
                où j'ai découvert la puissance de construire des systèmes qui résolvent de vrais problèmes.
                Ce qui a commencé comme une curiosité académique est vite devenu une vocation professionnelle.
              </p>
              <p class="reveal" data-delay="120">
                Après avoir obtenu mon <strong>diplôme d'ingénieur en informatique</strong> en 2025,
                j'ai approfondi mon expertise grâce à une formation intensive full-stack à
                <strong>Mercy Innovation Lab</strong>, axée exclusivement sur l'écosystème Laravel —
                de la conception d'API au déploiement, de la modélisation des bases de données à l'architecture frontend Vue.js.
              </p>
              <p class="reveal" data-delay="180">
                Aujourd'hui, je développe des applications web pour des clients à travers l'Afrique et je collabore avec des équipes en Europe
                et au-delà. Mon positionnement est clair : <strong>remote-first, qualité avant tout</strong>.
                La géographie n'est pas une contrainte — c'est un avantage. J'apporte une perspective unique,
                forgée en résolvant des problèmes concrets dans des environnements avec peu de ressources,
                ce qui aiguise mon instinct pour la performance et la fiabilité.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- ══ VALEURS ══ -->
      <section class="values-section">
        <div class="v-inner">
          <div class="v-head">
            <div class="sec-label reveal">02 · Mes valeurs</div>
            <h2 class="sec-h2 reveal" data-delay="60">Comment je travaille<br><em>&amp; pourquoi ça compte</em></h2>
          </div>
          <div class="v-grid">
            <div v-for="(v, i) in values" :key="v.title" class="v-card reveal" :data-delay="i * 80">
              <div class="vc-ico" :style="{ color: v.color, background: v.color + '16' }">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" v-html="v.svg"></svg>
              </div>
              <h3 class="vc-title">{{ v.title }}</h3>
              <p class="vc-desc">{{ v.desc }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- ══ FORMATION ══ -->
      <section class="edu-section">
        <div class="edu-inner">
          <div class="edu-head">
            <div class="sec-label reveal">03 · Formation & Parcours</div>
            <h2 class="sec-h2 reveal" data-delay="60">Parcours<br><em>académique</em></h2>
          </div>
          <div class="edu-list">
            <div v-for="(e, i) in education" :key="i" class="edu-card reveal" :data-delay="i * 80">
              <div class="ec-year" :style="{ color: e.color }">{{ e.year }}</div>
              <div class="ec-body">
                <h3 class="ec-title">{{ e.title }}</h3>
                <div class="ec-org">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                  {{ e.org }}
                </div>
                <p class="ec-desc">{{ e.desc }}</p>
                <div class="ec-tags">
                  <span v-for="t in e.tags" :key="t">{{ t }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══ VISION INTERNATIONALE ══ -->
      <section class="vision-section">
        <div class="vi-bg"></div>
        <div class="vi-inner reveal">
          <div class="vi-content">
            <div class="sec-label light">04 · Vision mondiale</div>
            <h2 class="vi-h2">Construit en Afrique,<br><em>déployé partout</em></h2>
            <p>
              Travailler depuis le Cameroun n'est pas une limitation — c'est une affirmation.
              Les développeurs africains construisent des produits de classe mondiale qui servent des millions d'utilisateurs.
              Je crois que l'avenir du web est distribué, et que les meilleurs talents en ingénierie
              ne sont pas confinés à un seul fuseau horaire.
            </p>
            <p>
              Que vous soyez une startup à Paris, une scale-up à Londres, une entreprise à Douala
              ou un fondateur à Montréal — j'apporte le même engagement à chaque projet :
              une architecture propre, une livraison fiable et un vrai partenariat.
            </p>
            <div class="vi-flags">
              <span v-for="f in flags" :key="f.label" class="vi-flag-item">
                <span>{{ f.emoji }}</span>
                <span class="vf-label">{{ f.label }}</span>
              </span>
            </div>
          </div>
          <div class="vi-cta-col">
            <div class="vi-cta-card">
              <div class="vcc-dot-wrap"><span class="vcc-dot"></span></div>
              <div class="vcc-title">Prêt à collaborer ?</div>
              <div class="vcc-sub">Remote · Mondial · 2026</div>
              <Link href="/contact" class="vcc-btn">Démarrer une conversation →</Link>
              <div class="vcc-langs">
                <span>🇫🇷 Français</span>
                <span class="vcc-sep">·</span>
                <span>🇬🇧 Anglais</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <AppFooter />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'
import AppCursor from '../Components/AppCursor.vue'
import { useTheme }        from '../Composables/useTheme'
import { useScrollReveal } from '../Composables/useScrollReveal'

const { theme, toggleTheme } = useTheme()
useScrollReveal()

const showPhoto = ref(true)
const photoUrl  = '/images/profil.png'

const quickStats = [
  { val: '3+',  label: "Années d'expérience" },
  { val: '12+', label: 'Projets livrés' },
  { val: '2',   label: 'Langues parlées' },
  { val: '24h', label: 'Temps de réponse' },
]

const values = [
  {
    title: "Architecture d'abord",
    desc:  "Je conçois avant de coder. Une architecture bien pensée réduit les bugs, simplifie la maintenance et facilite le passage à l'échelle. Prendre 2 jours pour concevoir économise 2 semaines de refactorisation.",
    color: '#E53E3E',
    svg:   '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>',
  },
  {
    title: 'Code propre et lisible',
    desc:  "Le code est lu bien plus souvent qu'il n'est écrit. Chaque fonction, variable et classe que j'écris est nommée avec clarté. Je traite le code comme un actif à long terme, pas comme une livraison rapide.",
    color: '#3B82F6',
    svg:   '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
  },
  {
    title: 'Livraison fiable',
    desc:  "Les délais sont des engagements. Je communique de manière proactive, signale les blocages tôt et livre toujours un logiciel fonctionnel. Mes clients savent à quoi s'attendre — et ils l'obtiennent.",
    color: '#10B981',
    svg:   '<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>',
  },
  {
    title: 'Apprentissage continu',
    desc:  "La technologie évolue vite. J'investis du temps chaque semaine pour approfondir mes connaissances — lire la documentation, construire des projets personnels et rester à jour avec les écosystèmes Laravel et Vue.js.",
    color: '#F59E0B',
    svg:   '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
  },
  {
    title: 'Approche centrée utilisateur',
    desc:  "Je construis pour de vrais utilisateurs, pas pour des démos. La performance, l'accessibilité et l'UX ne sont pas des réflexions après coup — elles sont intégrées dès le premier commit.",
    color: '#8B5CF6',
    svg:   '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
  },
  {
    title: 'Partenariat transparent',
    desc:  "Je travaille comme un partenaire, pas comme un simple prestataire. Je pose des questions, challenge les exigences si nécessaire et partage mon point de vue — car le meilleur résultat vient d'une vraie collaboration.",
    color: '#EC4899',
    svg:   '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
  },
]

const education = [
  {
    year:  '2025',
    color: '#E53E3E',
    title: "Diplôme d'Ingénieur des Travaux Informatiques",
    org:   "IAI — Institut Africain d'Informatique · Yaoundé, Cameroun",
    desc:  "Formation d'ingénieur en informatique couvrant l'architecture logicielle, les bases de données avancées, la conception de systèmes, la gestion de projet et l'assurance qualité logicielle. Projet de fin d'études : application web full-stack avec Laravel.",
    tags:  ['Génie Logiciel', 'Architecture Système', 'Gestion de Projet', 'MySQL', 'Java', 'Laravel'],
  },
  {
    year:  '2025–2026',
    color: '#10B981',
    title: 'Formation Professionnelle — Développement Full-Stack Laravel',
    org:   'Mercy Innovation Lab · Yaoundé, Cameroun',
    desc:  "Programme intensif de 5 mois couvrant la stack Laravel complète : architecture MVC, Eloquent ORM, APIs RESTful, Inertia.js + Vue 3, tests automatisés avec PHPUnit, déploiement avec Laravel Forge et pipelines CI/CD.",
    tags:  ['Laravel', 'Vue.js', 'Inertia.js', 'REST API', 'MySQL', 'PHPUnit', 'TailwindCSS'],
  },
  {
    year:  '2024',
    color: '#3B82F6',
    title: 'DTS — Diplôme de Technicien Supérieur en Informatique',
    org:   "IAI — Institut Africain d'Informatique · Yaoundé, Cameroun",
    desc:  "Formation de deux ans couvrant les fondamentaux de la programmation, les algorithmes, la POO, le développement web (HTML/CSS/JS/PHP), l'administration de bases de données et les bases des réseaux.",
    tags:  ['PHP', 'JavaScript', 'HTML/CSS', 'MySQL', 'Java', 'POO', 'Algorithmique'],
  },
]

const flags = [
  { emoji: '🇨🇲', label: 'Cameroon' },
  { emoji: '🇫🇷', label: 'France' },
  { emoji: '🇬🇧', label: 'UK' },
  { emoji: '🇨🇦', label: 'Canada' },
  { emoji: '🇧🇪', label: 'Belgium' },
  { emoji: '🇨🇭', label: 'Switzerland' },
  { emoji: '🌍', label: 'Africa' },
  { emoji: '🌐', label: 'Remote' },
]
</script>

<style scoped>
/* Thème */
.apage.dark {
  --bg: #0A0A0A; --bg2: #111111;
  --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text: #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg: rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red: #E53E3E; --red-soft: rgba(229,62,62,.1);
  --footer-bg: #080808;
}
.apage.light {
  --bg: #F8F8F8; --bg2: #FFFFFF;
  --card: rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text: #0A0A0A; --muted: #888; --muted2: #AAA;
  --nav-bg: rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red: #C53030; --red-soft: rgba(197,48,48,.08);
  --footer-bg: #EFEFEF;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
.apage { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); transition: background .4s, color .4s; }

.sec-label { font-family: 'JetBrains Mono', monospace; font-size: .67rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1rem; display: flex; align-items: center; gap: .6rem; }
.sec-label::before { content: ''; display: block; width: 18px; height: 1px; background: var(--red); }
.sec-label.light { color: rgba(255,255,255,.3); }
.sec-label.light::before { background: rgba(255,255,255,.4); }
.sec-h2  { font-size: clamp(1.9rem, 4.5vw, 3.2rem); font-weight: 900; line-height: 1.05; letter-spacing: -.05em; color: var(--text); }
.sec-h2 em { font-style: italic; color: var(--red); }

/* Hero */
.ah-section { position: relative; min-height: 100vh; padding: 7rem 5vw 5rem; overflow: hidden; display: flex; align-items: center; }
.ah-bg { position: absolute; inset: 0; pointer-events: none; }
.orb { position: absolute; border-radius: 50%; filter: blur(100px); }
.o1  { width: 520px; height: 520px; background: var(--red); opacity: .06; top: -120px; right: -60px; animation: orb 12s ease-in-out infinite; }
.o2  { width: 380px; height: 380px; background: #3B82F6; opacity: .04; bottom: -50px; left: 5%; animation: orb 18s ease-in-out infinite reverse; }
@keyframes orb { 0%,100%{transform:translate(0,0)} 50%{transform:translate(26px,-20px)} }
.ah-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,.022) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.022) 1px,transparent 1px); background-size: 50px 50px; -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%,black 30%,transparent); mask-image: radial-gradient(ellipse 70% 70% at 50% 50%,black 30%,transparent); }

.ah-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; max-width: 1200px; margin: 0 auto; width: 100%; align-items: center; }
.ah-h1 { font-size: clamp(2.4rem, 5.5vw, 4.8rem); font-weight: 900; line-height: .92; letter-spacing: -.06em; margin-bottom: 1.4rem; color: var(--text); }
.ah-h1 em { font-style: italic; color: var(--red); display: block; }
.ah-lead { font-size: .95rem; color: var(--muted2); line-height: 1.85; margin-bottom: 1.8rem; }
.ah-lead strong { color: var(--text); }

.ah-badges { display: flex; flex-wrap: wrap; gap: .5rem; margin-bottom: 2rem; }
.badge-item { display: inline-flex; align-items: center; gap: .4rem; background: var(--card); border: 1px solid var(--card-b); padding: .3rem .85rem; border-radius: 100px; font-size: .74rem; color: var(--muted2); }
.bi-dot { width: 7px; height: 7px; border-radius: 50%; }
.bi-dot.green { background: #4ADE80; animation: bl 2s infinite; }
@keyframes bl { 0%,100%{opacity:1} 50%{opacity:.35} }

.ah-ctas { display: flex; gap: .8rem; flex-wrap: wrap; }
.btn-red { display: inline-flex; align-items: center; gap: .5rem; background: var(--red); color: #fff; padding: .82rem 1.7rem; border-radius: 10px; font-weight: 700; font-size: .88rem; text-decoration: none; box-shadow: 0 6px 24px rgba(229,62,62,.28); transition: transform .2s, opacity .2s; }
.btn-outline { display: inline-flex; align-items: center; gap: .5rem; background: transparent; color: var(--text); border: 1px solid var(--card-b); padding: .82rem 1.5rem; border-radius: 10px; font-size: .88rem; text-decoration: none; font-weight: 600; transition: border-color .2s, background .2s; }

/* Photo */
.ah-right { display: flex; flex-direction: column; align-items: center; gap: 1.5rem; }
.photo-frame { position: relative; width: 280px; height: 280px; display: flex; align-items: center; justify-content: center; }
.pf-ring { position: absolute; inset: -12px; border-radius: 50%; border: 1.5px solid transparent; background: linear-gradient(135deg,var(--red),#3B82F6) border-box; -webkit-mask: linear-gradient(black 0 0) padding-box, linear-gradient(black 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; animation: spin 12s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.pf-img { width: 85%; height: 85%; border-radius: 50%; overflow: hidden; background: #0A0A0A; border: 1px solid var(--card-b); }
.pf-img img { width: 100%; height: 100%; object-fit: cover; object-position: top; }
.pf-ph  { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--muted); }
.pf-badge { position: absolute; bottom: 8px; right: -8px; display: flex; align-items: center; gap: .5rem; background: var(--bg2); border: 1px solid rgba(229,62,62,.22); padding: .4rem .9rem; border-radius: 10px; font-size: .72rem; font-weight: 700; color: var(--text); white-space: nowrap; backdrop-filter: blur(12px); }
.pb-dot { width: 6px; height: 6px; border-radius: 50%; background: #4ADE80; animation: bl 2s infinite; }

.quick-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: .6rem; width: 100%; max-width: 300px; }
.qs-item { background: var(--card); border: 1px solid var(--card-b); border-radius: 12px; padding: .9rem 1rem; text-align: center; }
.qs-n { display: block; font-size: 1.4rem; font-weight: 900; color: var(--text); letter-spacing: -.04em; }
.qs-l { font-size: .68rem; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }

/* Story */
.story-section { background: var(--bg2); padding: 6rem 5vw; }
.st-inner { display: grid; grid-template-columns: 200px 1fr; gap: 4rem; max-width: 1200px; margin: 0 auto; }
.st-content .sec-h2 { margin-bottom: 2rem; }
.st-body { display: flex; flex-direction: column; gap: 1.2rem; }
.st-body p { font-size: .95rem; color: var(--muted2); line-height: 1.9; }
.st-body strong { color: var(--text); font-weight: 700; }

/* Values */
.values-section { background: var(--bg); padding: 6rem 5vw; }
.v-inner  { max-width: 1200px; margin: 0 auto; }
.v-head   { margin-bottom: 3rem; }
.v-grid   { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; }
.v-card   { background: var(--card); border: 1px solid var(--card-b); border-radius: 16px; padding: 1.6rem 1.8rem; transition: border-color .2s, transform .2s; }
.vc-ico   { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.1rem; flex-shrink: 0; }
.vc-title { font-size: 1rem; font-weight: 800; color: var(--text); margin-bottom: .6rem; letter-spacing: -.02em; }
.vc-desc  { font-size: .83rem; color: var(--muted); line-height: 1.75; }

/* Education */
.edu-section { background: var(--bg2); padding: 6rem 5vw; }
.edu-inner   { max-width: 860px; margin: 0 auto; }
.edu-head    { margin-bottom: 3rem; }
.edu-list    { display: flex; flex-direction: column; gap: 1.2rem; }
.edu-card    { display: grid; grid-template-columns: 90px 1fr; gap: 1.5rem; background: var(--card); border: 1px solid var(--card-b); border-radius: 16px; padding: 1.6rem 1.8rem; }
.ec-year  { font-family: 'JetBrains Mono', monospace; font-size: .78rem; font-weight: 700; padding-top: .2rem; line-height: 1.4; }
.ec-title { font-size: 1rem; font-weight: 800; color: var(--text); margin-bottom: .4rem; letter-spacing: -.02em; line-height: 1.3; }
.ec-org   { display: flex; align-items: center; gap: .4rem; font-size: .78rem; color: var(--muted2); margin-bottom: .7rem; }
.ec-desc  { font-size: .84rem; color: var(--muted); line-height: 1.75; margin-bottom: .9rem; }
.ec-tags  { display: flex; flex-wrap: wrap; gap: .3rem; }
.ec-tags span { font-family: 'JetBrains Mono', monospace; font-size: .59rem; color: var(--muted2); background: var(--card); border: 1px solid var(--card-b); padding: .12rem .48rem; border-radius: 4px; }

/* Vision */
.vision-section { position: relative; overflow: hidden; background: #080808; padding: 7rem 5vw; }
.vi-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 55% 45% at 50% -5%,rgba(229,62,62,.08),transparent 60%); pointer-events: none; }
.vi-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 340px; gap: 4rem; max-width: 1200px; margin: 0 auto; align-items: center; }
.vi-h2 { font-size: clamp(2rem, 5vw, 3.8rem); font-weight: 900; color: #fff; letter-spacing: -.06em; line-height: .9; margin-bottom: 1.5rem; }
.vi-h2 em { font-style: italic; color: var(--red); display: block; }
.vi-content p { font-size: .9rem; color: rgba(255,255,255,.4); line-height: 1.9; margin-bottom: 1rem; }
.vi-content strong { color: rgba(255,255,255,.7); }
.vi-flags { display: flex; flex-wrap: wrap; gap: .6rem; margin-top: 1.8rem; }
.vi-flag-item { display: flex; align-items: center; gap: .35rem; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); padding: .3rem .8rem; border-radius: 100px; font-size: .75rem; color: rgba(255,255,255,.4); }
.vf-label { font-size: .7rem; }
.vi-cta-card { background: rgba(255,255,255,.04); border: 1px solid rgba(229,62,62,.2); border-radius: 20px; padding: 2rem; text-align: center; }
.vcc-dot-wrap { margin-bottom: 1rem; }
.vcc-dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #4ADE80; animation: bl 2s infinite; }
.vcc-title { font-size: 1.1rem; font-weight: 800; color: #fff; margin-bottom: .3rem; }
.vcc-sub { font-size: .75rem; color: rgba(255,255,255,.3); margin-bottom: 1.5rem; }
.vcc-btn { display: block; background: var(--red); color: #fff; padding: .82rem 1.4rem; border-radius: 10px; font-weight: 700; font-size: .88rem; text-decoration: none; margin-bottom: 1.2rem; transition: opacity .2s; }
.vcc-btn:hover { opacity: .9; }
.vcc-langs { display: flex; align-items: center; justify-content: center; gap: .5rem; font-size: .78rem; color: rgba(255,255,255,.3); }
.vcc-sep { opacity: .4; }

/* Hover */
@media (hover: hover) and (pointer: fine) {
  .btn-red:hover { transform: translateY(-2px); opacity: .9; }
  .btn-outline:hover { border-color: var(--red); background: var(--red-soft); }
  .v-card:hover { border-color: rgba(229,62,62,.2); transform: translateY(-3px); }
  .edu-card:hover { border-color: rgba(229,62,62,.15); }
}

/* Responsive */
@media (max-width: 1000px) {
  .vi-inner { grid-template-columns: 1fr; gap: 2.5rem; }
  .vi-cta-card { max-width: 380px; }
}
@media (max-width: 880px) {
  .ah-inner { grid-template-columns: 1fr; gap: 2.5rem; }
  .ah-right { width: 100%; }
  .quick-stats { max-width: 100%; }
  .st-inner { grid-template-columns: 1fr; gap: 1.5rem; }
  .st-label-col { margin-bottom: -.5rem; }
}
@media (max-width: 640px) {
  .ah-section, .story-section, .values-section, .edu-section, .vision-section { padding: 5rem 5vw 4rem; }
  .edu-card   { grid-template-columns: 1fr; gap: .8rem; }
  .ec-year    { font-size: .72rem; }
  .ah-h1      { font-size: clamp(2rem, 9vw, 3rem); }
  .photo-frame { width: 220px; height: 220px; }
  .ah-ctas    { flex-direction: column; }
  .btn-red, .btn-outline { justify-content: center; }
}
@media (max-width: 400px) {
  .ah-section { padding: 5rem 4vw 3.5rem; }
  .quick-stats { grid-template-columns: repeat(2, 1fr); }
  .vi-flags   { gap: .4rem; }
}
</style>