<template>
  <div class="bpage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />

    <main>
      <!-- HERO -->
      <section class="bh">
        <div class="bh-bg">
          <div class="bh-grid"></div>
          <div class="bh-orb o1"></div>
          <div class="bh-orb o2"></div>
        </div>
        <div class="bh-inner">
          <div class="bh-crumb">
            <Link href="/" class="bhc-back">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Accueil
            </Link>
            <span class="bhc-sep">/</span>
            <span class="bhc-cur">Blog</span>
          </div>
          <div class="bh-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
            Articles techniques
          </div>
          <h1 class="bh-title">Mes réflexions<br><em>techniques</em></h1>
          <p class="bh-sub">
            Partage d'expériences, bonnes pratiques et solutions concrètes
            sur Laravel, Vue.js et le développement full-stack.
          </p>
          <div class="bh-filters">
            <button
              v-for="cat in categories" :key="cat"
              class="bhf" :class="{ active: activeCategory === cat }"
              @click="activeCategory = cat"
            >{{ cat }}</button>
          </div>
        </div>
        <div class="bh-scroll"><div class="bhs-bar"></div><span>Scroll</span></div>
      </section>

      <!-- CORPS -->
      <section class="bc">
        <div class="bc-inner">

          <div v-if="filteredPosts.length" class="bc-featured">
            <Link :href="'/blog/' + filteredPosts[0].slug" class="bcf-card">
              <div class="bcf-visual" :style="{ background: `linear-gradient(135deg, ${filteredPosts[0].color}20, ${filteredPosts[0].color}06)` }">
                <img
                  v-if="filteredPosts[0].image"
                  :src="filteredPosts[0].image"
                  :alt="filteredPosts[0].title"
                  class="bcf-img"
                />
                <div v-else class="bcf-letter" :style="{ color: filteredPosts[0].color }">{{ filteredPosts[0].title.charAt(0) }}</div>
                <div class="bcf-overlay">
                  <span>Lire l'article →</span>
                </div>
              </div>
              <div class="bcf-body">
                <div class="bcf-top">
                  <span class="bcf-cat" :style="{ color: filteredPosts[0].color, background: filteredPosts[0].color+'14', borderColor: filteredPosts[0].color+'30' }">{{ filteredPosts[0].category }}</span>
                  <span class="bcf-featured-badge">⭐ À la une</span>
                  <span class="bcf-date">{{ filteredPosts[0].date }}</span>
                </div>
                <h2 class="bcf-title">{{ filteredPosts[0].title }}</h2>
                <p class="bcf-excerpt">{{ filteredPosts[0].excerpt }}</p>
                <div class="bcf-footer">
                  <div class="bcf-meta">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ filteredPosts[0].readTime }} min de lecture
                  </div>
                  <span class="bcf-read" :style="{ color: filteredPosts[0].color }">
                    Lire l'article
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                  </span>
                </div>
              </div>
            </Link>
          </div>

          <div v-if="filteredPosts.length > 1" class="bc-grid-label">
            <span>Tous les articles</span>
            <span class="bcgl-count">{{ filteredPosts.length - 1 }} article{{ filteredPosts.length - 1 > 1 ? 's' : '' }}</span>
          </div>

          <div class="bc-grid">
            <Link
              v-for="post in filteredPosts.slice(1)"
              :key="post.slug"
              :href="'/blog/' + post.slug"
              class="bc-card"
            >
              <div class="bcc-visual" :style="{ background: post.color+'12' }">
                <img v-if="post.image" :src="post.image" :alt="post.title" class="bcc-img"/>
                <div v-else class="bcc-ph-letter" :style="{ color: post.color }">{{ post.title.charAt(0) }}</div>
              </div>
              <div class="bcc-body">
                <div class="bcc-top">
                  <span class="bcc-cat" :style="{ color: post.color, background: post.color+'14', borderColor: post.color+'30' }">{{ post.category }}</span>
                  <span class="bcc-date">{{ post.date }}</span>
                </div>
                <h3 class="bcc-title">{{ post.title }}</h3>
                <p class="bcc-excerpt">{{ post.excerpt }}</p>
                <div class="bcc-footer">
                  <div class="bcc-meta">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ post.readTime }} min
                  </div>
                  <span class="bcc-read" :style="{ color: post.color }">Lire →</span>
                </div>
              </div>
            </Link>
          </div>

          <div v-if="!filteredPosts.length" class="bc-empty">
            <div class="bce-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <p class="bce-t">Aucun article dans cette catégorie</p>
            <button class="bce-reset" @click="activeCategory = 'Tous'">Voir tous les articles</button>
          </div>

        </div>
      </section>

      <AppFooter />
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'

const theme = ref(localStorage.getItem('theme') || 'dark')
function toggleTheme() {
  theme.value = theme.value === 'dark' ? 'light' : 'dark'
  localStorage.setItem('theme', theme.value)
}

const posts = [
  {
    slug:     'application-web-vs-site-web',
    title:    'Application web vs site web : quelle est vraiment la différence ?',
    excerpt:  "On entend souvent les deux termes utilisés de façon interchangeable. Pourtant, il existe une distinction fondamentale que tout développeur devrait maîtriser avant de se lancer.",
    category: 'Développement web',
    color:    '#E53E3E',
    date:     'Mars 2026',
    readTime: 7,
    image:    'https://images.unsplash.com/photo-1547658719-da2b51169166?w=800&auto=format&fit=crop&q=80',
  },
  {
    slug:     'mobile-vs-web',
    title:    'Développement mobile vs développement web : comment choisir ?',
    excerpt:  "Application native, web ou hybride ? Ce choix stratégique conditionne votre budget, votre audience et votre délai de mise sur le marché. Voici comment décider.",
    category: 'Mobile & Web',
    color:    '#3B82F6',
    date:     'Fév. 2026',
    readTime: 8,
    image:    'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&auto=format&fit=crop&q=80',
  },
  {
    slug:     'pourquoi-choisir-le-web',
    title:    'Pourquoi choisir le web pour votre projet en 2026 ?',
    excerpt:  "Accessibilité universelle, coûts réduits, mises à jour instantanées... Le web offre des avantages concurrentiels décisifs que beaucoup de porteurs de projets sous-estiment.",
    category: 'Stratégie',
    color:    '#10B981',
    date:     'Jan. 2026',
    readTime: 6,
    image:    'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
  },
]

const activeCategory = ref('Tous')
const categories = computed(() => {
  const cats = ['Tous', ...new Set(posts.map(p => p.category))]
  return cats
})
const filteredPosts = computed(() =>
  activeCategory.value === 'Tous'
    ? posts
    : posts.filter(p => p.category === activeCategory.value)
)
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap');

.bpage.dark {
  --bg: #0A0A0A; --bg2: #111111; --footer-bg: #080808;
  --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text: #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg: rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red: #E53E3E; --red-soft: rgba(229,62,62,.1); --blue: #3B82F6;
}
.bpage.light {
  --bg: #F8F8F8; --bg2: #FFFFFF; --footer-bg: #EFEFEF;
  --card: rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text: #0A0A0A; --muted: #888; --muted2: #AAA;
  --nav-bg: rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red: #C53030; --red-soft: rgba(197,48,48,.08); --blue: #2563EB;
  --footer-bg: #EFEFEF;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
.bpage { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; transition: background .4s, color .4s; min-height: 100vh; }

.bh {
  position: relative; min-height: 72vh;
  display: flex; align-items: center;
  padding: 9rem 5vw 5rem; overflow: hidden;
}
.bh-bg { position: absolute; inset: 0; pointer-events: none; }
.bh-grid {
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(229,62,62,.07) 1px, transparent 1px),
    linear-gradient(90deg, rgba(229,62,62,.07) 1px, transparent 1px);
  background-size: 48px 48px;
  -webkit-mask-image: radial-gradient(ellipse 90% 80% at 50% 50%, black 20%, transparent 80%);
  mask-image: radial-gradient(ellipse 90% 80% at 50% 50%, black 20%, transparent 80%);
}
.bh-orb { position: absolute; border-radius: 50%; filter: blur(110px); pointer-events: none; }
.bh-orb.o1 { width: 600px; height: 600px; background: var(--red); opacity: .07; top: -180px; right: -100px; animation: orb 14s ease-in-out infinite; }
.bh-orb.o2 { width: 360px; height: 360px; background: var(--blue); opacity: .05; bottom: -60px; left: 8%; animation: orb 18s ease-in-out infinite reverse; }
@keyframes orb { 0%,100%{transform:translate(0,0)} 50%{transform:translate(30px,-24px)} }

.bh-inner { position: relative; z-index: 2; max-width: 1100px; margin: 0 auto; width: 100%; }

.bh-crumb { display: flex; align-items: center; gap: .55rem; font-size: .78rem; color: var(--muted); margin-bottom: 2.5rem; }
.bhc-back { display: inline-flex; align-items: center; gap: .4rem; color: var(--muted); text-decoration: none; transition: color .2s; }
.bhc-back:hover { color: var(--text); }
.bhc-sep { opacity: .4; }
.bhc-cur { color: var(--muted2); }

.bh-badge {
  display: inline-flex; align-items: center; gap: .5rem;
  font-family: 'JetBrains Mono', monospace; font-size: .68rem; letter-spacing: .12em; text-transform: uppercase;
  color: var(--red); background: var(--red-soft); border: 1px solid rgba(229,62,62,.22);
  padding: .33rem .95rem; border-radius: 100px; margin-bottom: 2rem;
}
.bh-title {
  font-size: clamp(2.6rem, 7vw, 5rem); font-weight: 900;
  letter-spacing: -.05em; line-height: 1.0; color: var(--text); margin-bottom: 1.4rem;
}
.bh-title em { font-style: italic; color: var(--red); background: linear-gradient(135deg, var(--red), #FC8181); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.bh-sub { font-size: 1rem; color: var(--muted2); line-height: 1.85; max-width: 540px; margin-bottom: 2.8rem; }

.bh-filters { display: flex; flex-wrap: wrap; gap: .5rem; }
.bhf {
  background: var(--card); border: 1px solid var(--card-b);
  color: var(--muted2); font-size: .78rem; font-family: 'Outfit', sans-serif; font-weight: 500;
  padding: .4rem 1rem; border-radius: 100px; cursor: pointer;
  transition: all .18s; white-space: nowrap;
}
.bhf:hover  { color: var(--text); border-color: rgba(229,62,62,.3); background: var(--red-soft); }
.bhf.active { color: var(--red); border-color: var(--red); background: var(--red-soft); font-weight: 700; }

.bh-scroll { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: .4rem; font-family: 'JetBrains Mono', monospace; font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: var(--muted); }
.bhs-bar { width: 1px; height: 38px; background: var(--card-b); overflow: hidden; position: relative; }
.bhs-bar::after { content: ''; position: absolute; inset-inline: 0; top: 0; height: 50%; background: var(--red); animation: sb 2.4s ease-in-out infinite; }
@keyframes sb { 0%{transform:translateY(-100%);opacity:0} 30%{opacity:1} 100%{transform:translateY(200%);opacity:0} }

.bc { background: var(--bg2); padding: 6rem 5vw 7rem; }
.bc-inner { max-width: 1100px; margin: 0 auto; }

.bc-featured { margin-bottom: 3.5rem; }
/* ── Featured card ── */
.bcf-card {
  display: grid; grid-template-columns: 1fr 1.2fr; gap: 0;
  background: var(--card); border: 1px solid var(--card-b);
  border-radius: 20px; overflow: hidden; text-decoration: none; color: var(--text);
  transition: border-color .25s, transform .25s, box-shadow .25s;
  position: relative;
}
.bcf-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #E53E3E, #FC8181); z-index: 1; }

.bcf-visual {
  position: relative; min-height: 280px;
  display: flex; align-items: center; justify-content: center;
  overflow: hidden;
}
.bcf-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; transition: transform .5s ease; }
.bcf-letter { font-size: 8rem; font-weight: 900; opacity: .15; letter-spacing: -.06em; line-height: 1; transition: transform .4s; }
.bcf-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.45); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .25s; }
.bcf-overlay span { color: #fff; font-weight: 700; font-size: .9rem; border: 1px solid rgba(255,255,255,.5); padding: .55rem 1.4rem; border-radius: 8px; backdrop-filter: blur(4px); }

.bcf-body { padding: 2.2rem 2.4rem; display: flex; flex-direction: column; gap: 1rem; justify-content: center; }
.bcf-top  { display: flex; align-items: center; gap: .65rem; flex-wrap: wrap; }
.bcf-cat  { font-family: 'JetBrains Mono', monospace; font-size: .64rem; letter-spacing: .08em; padding: .22rem .65rem; border-radius: 6px; border: 1px solid; }
.bcf-featured-badge { font-family: 'JetBrains Mono', monospace; font-size: .6rem; color: var(--muted); letter-spacing: .08em; }
.bcf-date { font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--muted); margin-left: auto; }
.bcf-title { font-size: clamp(1.1rem, 2vw, 1.5rem); font-weight: 900; color: var(--text); line-height: 1.25; letter-spacing: -.03em; }
.bcf-excerpt { font-size: .9rem; color: var(--muted2); line-height: 1.82; flex: 1; }
.bcf-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid var(--card-b); margin-top: auto; }
.bcf-meta { display: flex; align-items: center; gap: .4rem; font-size: .74rem; color: var(--muted); font-family: 'JetBrains Mono', monospace; }
.bcf-read { display: inline-flex; align-items: center; gap: .4rem; font-size: .84rem; font-weight: 700; text-decoration: none; transition: gap .2s; }

/* ── Grid cards ── */
.bc-grid-label { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: .9rem; border-bottom: 1px solid var(--card-b); }
.bc-grid-label span:first-child { font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; }
.bcgl-count { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); background: var(--card); border: 1px solid var(--card-b); padding: .14rem .55rem; border-radius: 5px; }

.bc-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }
.bc-card {
  background: var(--card); border: 1px solid var(--card-b);
  border-radius: 16px; overflow: hidden;
  display: flex; flex-direction: column;
  text-decoration: none; color: var(--text);
  transition: border-color .22s, transform .22s, box-shadow .22s;
}

.bcc-visual { position: relative; height: 180px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.bcc-img { width: 100%; height: 100%; object-fit: cover; object-position: center; transition: transform .5s ease; }
.bcc-ph-letter { font-size: 5rem; font-weight: 900; opacity: .14; letter-spacing: -.06em; line-height: 1; }

.bcc-body { padding: 1.4rem; display: flex; flex-direction: column; gap: .8rem; flex: 1; }
.bcc-top   { display: flex; justify-content: space-between; align-items: center; gap: .5rem; }
.bcc-cat   { font-family: 'JetBrains Mono', monospace; font-size: .62rem; letter-spacing: .08em; padding: .18rem .58rem; border-radius: 5px; border: 1px solid; white-space: nowrap; }
.bcc-date  { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); white-space: nowrap; }
.bcc-title { font-size: .98rem; font-weight: 800; color: var(--text); line-height: 1.3; letter-spacing: -.02em; }
.bcc-excerpt { font-size: .82rem; color: var(--muted); line-height: 1.75; flex: 1; }
.bcc-footer { display: flex; justify-content: space-between; align-items: center; padding-top: .7rem; border-top: 1px solid var(--card-b); }
.bcc-meta { display: flex; align-items: center; gap: .38rem; font-size: .7rem; color: var(--muted); font-family: 'JetBrains Mono', monospace; }
.bcc-read { font-size: .78rem; font-weight: 700; text-decoration: none; transition: opacity .2s; }

.bc-empty { text-align: center; padding: 5rem 2rem; display: flex; flex-direction: column; align-items: center; gap: 1rem; }
.bce-icon { width: 64px; height: 64px; border-radius: 16px; background: var(--card); border: 1px solid var(--card-b); display: flex; align-items: center; justify-content: center; color: var(--muted); }
.bce-t { font-size: .95rem; color: var(--muted); }
.bce-reset { background: var(--red-soft); border: 1px solid rgba(229,62,62,.25); color: var(--red); padding: .55rem 1.3rem; border-radius: 8px; cursor: pointer; font-size: .84rem; font-family: 'Outfit', sans-serif; font-weight: 600; transition: background .2s; }

/* ══ HOVER : vrais dispositifs pointeurs seulement ══ */
@media (hover: hover) and (pointer: fine) {
  .bcf-card:hover { transform: translateY(-4px); border-color: rgba(229,62,62,.3); box-shadow: 0 20px 60px rgba(0,0,0,.16); }
  .bcf-card:hover .bcf-img { transform: scale(1.05); }
  .bcf-card:hover .bcf-letter { transform: scale(1.08); }
  .bcf-card:hover .bcf-overlay { opacity: 1; }
  .bcf-card:hover .bcf-read { gap: .65rem; }
  .bc-card:hover { transform: translateY(-4px); border-color: rgba(229,62,62,.25); box-shadow: 0 12px 36px rgba(0,0,0,.12); }
  .bc-card:hover .bcc-img { transform: scale(1.06); }
  .bcc-read:hover { opacity: .7; }
  .bce-reset:hover { background: rgba(229,62,62,.18); }
  .bhf:hover { color: var(--text); border-color: rgba(229,62,62,.3); background: var(--red-soft); }
  .bhc-back:hover { color: var(--text); }
}

/* Mobile touch : overlays permanents en bas de l'image */
@media (hover: none) {
  .bcf-overlay {
    opacity: 1;
    background: linear-gradient(to top, rgba(0,0,0,.62) 0%, transparent 55%);
    align-items: flex-end;
    padding-bottom: .8rem;
  }
  .bcf-overlay span { font-size: .78rem; padding: .35rem 1rem; }
}

/* ══ RESPONSIVE ══ */
@media (max-width: 900px) {
  .bcf-card { grid-template-columns: 1fr; }
  .bcf-visual { min-height: 220px; max-height: 260px; }
  .bcf-body { padding: 1.8rem 2rem; }
  .bc-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 680px) {
  .bh { padding: 6.5rem 5vw 3.5rem; min-height: auto; }
  .bc { padding: 4rem 5vw 5rem; }
  .bh-scroll { display: none; }
  .bc-grid { grid-template-columns: 1fr; }
  .bcf-body { padding: 1.4rem; }
  .bcf-excerpt { display: none; }
  .bcc-excerpt { display: none; }
  .bcf-visual { min-height: 180px; }
}

@media (max-width: 480px) {
  .bh { padding: 5.5rem 4vw 3rem; }
  .bc { padding: 3rem 4vw 4rem; }
  .bh-title { font-size: clamp(2rem, 9vw, 2.4rem); }
  .bh-sub { font-size: .88rem; }
  .bh-filters { gap: .4rem; }
  .bhf { font-size: .72rem; padding: .35rem .8rem; }
  .bc-grid { gap: .9rem; }
  .bcc-visual { height: 150px; }
  .bcc-body { padding: 1.1rem; gap: .6rem; }
  .bcc-title { font-size: .92rem; }
  .bc-featured { margin-bottom: 2.5rem; }
}

@media (max-width: 360px) {
  .bh-title { font-size: 1.85rem; }
  .bcf-title { font-size: 1rem; }
  .bcc-top { flex-direction: column; align-items: flex-start; gap: .3rem; }
}
</style>