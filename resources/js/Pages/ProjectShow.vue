<template>
  <div class="ppage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />

    <main>
      <!-- HERO PROJET -->
      <section class="ph">
        <div class="ph-bg">
          <div class="ph-orb" :style="{ background: project.color }"></div>
          <div class="ph-grid"></div>
        </div>
        <div class="ph-inner">

          <!-- Breadcrumb -->
          <div class="ph-crumb">
            <Link href="/" class="pc-back">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Retour
            </Link>
            <span class="pc-sep">/</span>
            <span class="pc-cur">{{ project.title }}</span>
          </div>

          <div class="ph-tags">
            <span v-for="t in project.tags" :key="t" class="pht" :style="{ color:project.color, background:project.color+'14', borderColor:project.color+'30' }">{{ t }}</span>
            <span class="ph-yr">{{ project.year }}</span>
          </div>

          <h1 class="ph-title">{{ project.title }}</h1>
          <p  class="ph-sub">{{ project.tagline }}</p>

          <div class="ph-btns">
            <a v-if="project.demo" :href="project.demo" target="_blank" rel="noopener" class="phb-main" :style="{ background:project.color }">
              Voir en ligne
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
            <a v-if="project.github" :href="project.github" target="_blank" rel="noopener" class="phb-ghost">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
              Code source
            </a>
          </div>
        </div>

        <!-- Screenshot hero avec barre browser -->
        <div class="ph-screen">
          <div class="phs-browser">
            <div class="phs-bar">
              <span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
              <div class="phs-url">{{ project.demo || 'rosnel.dev' }}</div>
            </div>
            <div class="phs-img" :style="{ background: `linear-gradient(135deg, ${project.color}18, ${project.color}06)` }">
              <img v-if="project.screenshots && project.screenshots[0]" :src="project.screenshots[0]" :alt="project.title"/>
              <div v-else class="phs-ph" :style="{ color: project.color }">
                <span class="phs-ph-l">{{ project.title.charAt(0) }}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- STATS -->
      <div v-if="project.stats && project.stats.length" class="stats-row">
        <div class="sr-inner">
          <div v-for="s in project.stats" :key="s.label" class="sr-item">
            <span class="sri-v" :style="{ color:project.color }">{{ s.val }}</span>
            <span class="sri-l">{{ s.label }}</span>
          </div>
        </div>
      </div>

      <!-- BODY -->
      <section class="pbody">
        <div class="pb-inner">

          <!-- Onglets -->
          <div class="tabs">
            <button
              v-for="tab in availableTabs" :key="tab.id"
              class="tab" :class="{ active: activeTab === tab.id }"
              @click="activeTab = tab.id"
            >{{ tab.label }}</button>
          </div>

          <!-- Contenu onglets -->
          <div class="tab-content">

            <!-- Onglet : Présentation -->
            <div v-if="activeTab === 'desc'" class="tc-desc">
              <div class="tcd-main">
                <div class="blk-label">Le projet</div>
                <div class="blk-text" v-html="project.description"></div>

                <div v-if="project.features && project.features.length" class="feat-grid">
                  <div v-for="f in project.features" :key="f.title" class="feat-card">
                    <div class="fc-ico" :style="{ color:project.color, background:project.color+'14' }">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" v-html="f.icon"></svg>
                    </div>
                    <div>
                      <div class="fc-t">{{ f.title }}</div>
                      <div class="fc-d">{{ f.desc }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <aside class="tcd-aside">
                <div class="aside-card">
                  <div class="ac-head">Stack technique</div>
                  <div class="ac-stack">
                    <div v-for="s in project.stack" :key="s.name" class="acs-row">
                      <img :src="s.logo" :alt="s.name" width="18" height="18"/>
                      <span class="acs-name">{{ s.name }}</span>
                      <span class="acs-role">{{ s.role }}</span>
                    </div>
                  </div>
                </div>
                <div class="aside-card">
                  <div class="ac-head">Informations</div>
                  <div class="ac-info">
                    <div class="aci-row"><span>Année</span><span>{{ project.year }}</span></div>
                    <div v-if="project.client"   class="aci-row"><span>Client</span><span>{{ project.client }}</span></div>
                    <div v-if="project.duration" class="aci-row"><span>Durée</span><span>{{ project.duration }}</span></div>
                    <div v-if="project.role"     class="aci-row"><span>Rôle</span><span>{{ project.role }}</span></div>
                  </div>
                </div>
                <div class="aside-links">
                  <a v-if="project.demo"   :href="project.demo"   target="_blank" rel="noopener" class="al-btn main" :style="{ background:project.color }">Voir en ligne ↗</a>
                  <a v-if="project.github" :href="project.github" target="_blank" rel="noopener" class="al-btn ghost">GitHub ↗</a>
                </div>
              </aside>
            </div>

            <!-- Onglet : Photos -->
            <div v-if="activeTab === 'photos'" class="tc-photos">
              <div v-if="project.screenshots && project.screenshots.length" class="photos-grid">
                <div
                  v-for="(sc, i) in project.screenshots" :key="i"
                  class="photo-item"
                  @click="lightbox = sc"
                >
                  <img :src="sc" :alt="`${project.title} - capture ${i+1}`"/>
                  <div class="pi-overlay">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                  </div>
                </div>
              </div>
              <div v-else class="photos-empty">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <p>Aucune capture d'écran disponible</p>
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- AUTRES PROJETS -->
      <section v-if="otherProjects && otherProjects.length" class="other">
        <div class="o-inner">
          <div class="o-head">Autres projets</div>
          <div class="o-grid">
            <Link
              v-for="p in otherProjects" :key="p.slug"
              :href="'/projets/'+p.slug"
              class="oc" :style="{ '--c': p.color }"
            >
              <div class="oc-band" :style="{ background:p.color }"></div>
              <div class="oc-body">
                <div class="oc-tags">
                  <span v-for="t in p.tags.slice(0,2)" :key="t">{{ t }}</span>
                </div>
                <div class="oc-title">{{ p.title }}</div>
                <div class="oc-sub">{{ p.tagline }}</div>
              </div>
              <svg class="oc-arr" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </Link>
          </div>
        </div>
      </section>

      <AppFooter />
    </main>

    <!-- Lightbox -->
    <Transition name="lb">
      <div v-if="lightbox" class="lightbox" @click="lightbox=null">
        <button class="lb-x" @click="lightbox=null">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <img :src="lightbox" @click.stop/>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'

const props = defineProps({ project: Object, otherProjects: Array })

const theme     = ref(localStorage.getItem('theme') || 'dark')
const lightbox  = ref(null)
const activeTab = ref('desc')

function toggleTheme() {
  theme.value = theme.value === 'dark' ? 'light' : 'dark'
  localStorage.setItem('theme', theme.value)
}

const allTabs = [
  { id: 'desc',   label: 'Présentation' },
  { id: 'photos', label: 'Photos / Captures' },
]
const availableTabs = computed(() => allTabs)
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap');

/* ── THÈME ── */
.ppage.dark {
  --bg:       #0A0A0A; --bg2: #111111; --footer-bg: #080808;
  --card:     rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text:     #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg:   rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red:      #E53E3E; --red-soft: rgba(229,62,62,.1); --blue: #3B82F6;
  --lbl:      rgba(255,255,255,.18);
}
.ppage.light {
  --bg:       #F8F8F8; --bg2: #FFFFFF; --footer-bg: #EFEFEF;
  --card:     rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text:     #0A0A0A; --muted: #888; --muted2: #AAA;
  --nav-bg:   rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red:      #C53030; --red-soft: rgba(197,48,48,.08); --blue: #2563EB;
  --lbl:      rgba(0,0,0,.2);
}

* { box-sizing:border-box; margin:0; padding:0; }
.ppage { font-family:'Outfit',sans-serif; background:var(--bg); color:var(--text); overflow-x:hidden; transition:background .4s,color .4s; }

/* HERO */
.ph { position:relative; padding:8rem 5vw 0; overflow:hidden; }
.ph-bg { position:absolute; inset:0; pointer-events:none; }
.ph-orb { position:absolute; width:560px; height:560px; border-radius:50%; top:-160px; right:-80px; opacity:.06; filter:blur(110px); }
.ph-grid { position:absolute; inset:0; background-image:linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px); background-size:50px 50px; -webkit-mask-image:radial-gradient(ellipse 65% 55% at 50% 40%,black 30%,transparent); mask-image:radial-gradient(ellipse 65% 55% at 50% 40%,black 30%,transparent); }

.ph-inner { position:relative; z-index:2; max-width:1100px; margin:0 auto; }

.ph-crumb { display:flex; align-items:center; gap:.55rem; font-size:.78rem; color:var(--muted); margin-bottom:2rem; }
.pc-back { display:inline-flex; align-items:center; gap:.4rem; color:var(--muted); text-decoration:none; transition:color .2s; }
.pc-back:hover { color:var(--text); }
.pc-sep { opacity:.4; }
.pc-cur { color:var(--muted2); }

.ph-tags { display:flex; flex-wrap:wrap; align-items:center; gap:.45rem; margin-bottom:1.3rem; }
.pht { font-family:'JetBrains Mono',monospace; font-size:.66rem; letter-spacing:.07em; padding:.2rem .68rem; border-radius:5px; border:1px solid; }
.ph-yr { font-family:'JetBrains Mono',monospace; font-size:.66rem; color:var(--muted); letter-spacing:.1em; margin-left:.3rem; }

.ph-title { font-family:'Outfit',sans-serif; font-size:clamp(2.2rem,5.5vw,4.2rem); font-weight:900; letter-spacing:-.05em; line-height:1.0; color:var(--text); margin-bottom:.9rem; }
.ph-sub { font-size:1rem; color:var(--muted2); line-height:1.75; max-width:540px; margin-bottom:2rem; }

.ph-btns { display:flex; gap:.9rem; flex-wrap:wrap; margin-bottom:3.5rem; }
.phb-main { display:inline-flex; align-items:center; gap:.5rem; color:#fff; padding:.76rem 1.7rem; border-radius:10px; font-weight:700; font-size:.88rem; text-decoration:none; transition:transform .2s,opacity .2s; }
.phb-main:hover { transform:translateY(-2px); opacity:.9; }
.phb-ghost { display:inline-flex; align-items:center; gap:.5rem; background:transparent; color:var(--text); border:1px solid var(--card-b); padding:.76rem 1.7rem; border-radius:10px; font-size:.88rem; text-decoration:none; transition:border-color .2s,background .2s; }
.phb-ghost:hover { border-color:var(--red); background:var(--red-soft); }

/* Screenshot */
.ph-screen { max-width:1100px; margin:0 auto; position:relative; z-index:2; }
.phs-browser { border-radius:14px 14px 0 0; overflow:hidden; border:1px solid var(--card-b); border-bottom:none; box-shadow:0 -6px 40px rgba(0,0,0,.2); }
.phs-bar { background:var(--bg2); padding:.65rem 1rem; display:flex; align-items:center; gap:.4rem; border-bottom:1px solid var(--card-b); }
.dot { width:10px; height:10px; border-radius:50%; }
.dot.r { background:#FF5F57; }
.dot.y { background:#FFBD2E; }
.dot.g { background:#28CA41; }
.phs-url { flex:1; max-width:260px; margin:0 auto; background:var(--card); border:1px solid var(--card-b); border-radius:5px; padding:.22rem .75rem; font-family:'JetBrains Mono',monospace; font-size:.7rem; color:var(--muted); text-align:center; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.phs-img { aspect-ratio:16/9; overflow:hidden; display:flex; align-items:center; justify-content:center; min-height:320px; }
.phs-img img { width:100%; height:100%; object-fit:cover; display:block; }
.phs-ph { display:flex; align-items:center; justify-content:center; width:100%; height:100%; }
.phs-ph-l { font-family:'Outfit',sans-serif; font-size:8rem; font-weight:900; opacity:.12; letter-spacing:-.06em; }

/* STATS */
.stats-row { background:var(--bg2); border-bottom:1px solid var(--card-b); }
.sr-inner { max-width:1100px; margin:0 auto; padding:2.2rem 5vw; display:flex; flex-wrap:wrap; }
.sr-item { flex:1; text-align:center; padding:.8rem 1.5rem; border-right:1px solid var(--card-b); }
.sr-item:last-child { border-right:none; }
.sri-v { display:block; font-family:'Outfit',sans-serif; font-size:1.9rem; font-weight:900; letter-spacing:-.04em; line-height:1; margin-bottom:.3rem; }
.sri-l { font-size:.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:.1em; }

/* BODY */
.pbody { background:var(--bg2); padding:4rem 5vw 5rem; }
.pb-inner { max-width:1100px; margin:0 auto; }

/* Onglets */
.tabs { display:flex; gap:.4rem; margin-bottom:2.5rem; border-bottom:1px solid var(--card-b); padding-bottom:0; }
.tab {
  background:none; border:none; cursor:pointer;
  font-family:'Outfit',sans-serif; font-size:.85rem; font-weight:600;
  color:var(--muted); padding:.65rem 1.2rem;
  border-bottom:2px solid transparent; margin-bottom:-1px;
  transition:color .2s, border-color .2s;
}
.tab:hover { color:var(--text); }
.tab.active { color:var(--red); border-color:var(--red); }

/* Tab: description */
.tc-desc { display:grid; grid-template-columns:1fr 300px; gap:3.5rem; align-items:start; }
.blk-label { font-family:'JetBrains Mono',monospace; font-size:.64rem; color:var(--lbl); letter-spacing:.2em; text-transform:uppercase; margin-bottom:1.1rem; display:flex; align-items:center; gap:.55rem; }
.blk-label::before { content:''; display:block; width:16px; height:1px; background:var(--red); }
.blk-text { font-size:.93rem; color:var(--muted2); line-height:1.9; margin-bottom:2.5rem; }
.blk-text :deep(p) { margin-bottom:.9rem; }
.blk-text :deep(strong) { color:var(--text); font-weight:600; }

.feat-grid { display:grid; grid-template-columns:1fr 1fr; gap:.9rem; }
.feat-card { display:flex; gap:.85rem; align-items:flex-start; background:var(--card); border:1px solid var(--card-b); border-radius:12px; padding:1rem; transition:border-color .2s; }
.feat-card:hover { border-color:rgba(229,62,62,.2); }
.fc-ico { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.fc-t { font-size:.85rem; font-weight:700; color:var(--text); margin-bottom:.25rem; }
.fc-d { font-size:.76rem; color:var(--muted); line-height:1.55; }

/* Aside */
.tcd-aside { display:flex; flex-direction:column; gap:1.1rem; position:sticky; top:6rem; }
.aside-card { background:var(--card); border:1px solid var(--card-b); border-radius:14px; padding:1.2rem; }
.ac-head { font-family:'JetBrains Mono',monospace; font-size:.62rem; color:var(--lbl); letter-spacing:.18em; text-transform:uppercase; margin-bottom:1.1rem; }
.ac-stack { display:flex; flex-direction:column; gap:.65rem; }
.acs-row { display:flex; align-items:center; gap:.65rem; }
.acs-row img { object-fit:contain; flex-shrink:0; }
.acs-name { font-size:.83rem; font-weight:600; color:var(--text); flex:1; }
.acs-role { font-size:.7rem; color:var(--muted); font-family:'JetBrains Mono',monospace; }
.ac-info { display:flex; flex-direction:column; gap:.55rem; }
.aci-row { display:flex; justify-content:space-between; align-items:center; font-size:.8rem; }
.aci-row span:first-child { color:var(--muted); }
.aci-row span:last-child  { color:var(--text); font-weight:600; }
.aside-links { display:flex; flex-direction:column; gap:.55rem; }
.al-btn { display:flex; align-items:center; justify-content:center; padding:.7rem; border-radius:10px; font-size:.84rem; font-weight:700; text-decoration:none; transition:transform .2s,opacity .2s; }
.al-btn.main { color:#fff; }
.al-btn.main:hover { transform:translateY(-2px); opacity:.9; }
.al-btn.ghost { background:var(--card); border:1px solid var(--card-b); color:var(--text); }
.al-btn.ghost:hover { border-color:var(--red); background:var(--red-soft); }

/* Tab: photos */
.tc-photos { }
.photos-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:.9rem; }
.photo-item { position:relative; border-radius:10px; overflow:hidden; aspect-ratio:16/10; cursor:pointer; border:1px solid var(--card-b); }
.photo-item img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .3s; }
.photo-item:hover img { transform:scale(1.04); }
.pi-overlay { position:absolute; inset:0; background:rgba(0,0,0,.5); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity .2s; }
.photo-item:hover .pi-overlay { opacity:1; }
.photos-empty { text-align:center; padding:4rem 2rem; color:var(--muted); display:flex; flex-direction:column; align-items:center; gap:1rem; }
.photos-empty p { font-size:.88rem; }

/* AUTRES PROJETS */
.other { background:var(--bg); padding:5rem 5vw; }
.o-inner { max-width:1100px; margin:0 auto; }
.o-head { font-family:'JetBrains Mono',monospace; font-size:.64rem; color:var(--muted); letter-spacing:.2em; text-transform:uppercase; margin-bottom:1.5rem; }
.o-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1rem; }
.oc { display:flex; align-items:center; gap:1rem; background:var(--card); border:1px solid var(--card-b); border-radius:13px; text-decoration:none; overflow:hidden; transition:transform .22s,border-color .22s; }
.oc:hover { transform:translateY(-3px); border-color:var(--c); }
.oc-band { width:4px; height:100%; min-height:72px; flex-shrink:0; }
.oc-body { flex:1; padding:.9rem .9rem .9rem 0; }
.oc-tags { display:flex; gap:.3rem; margin-bottom:.3rem; }
.oc-tags span { font-size:.6rem; color:var(--muted); font-family:'JetBrains Mono',monospace; letter-spacing:.05em; }
.oc-title { font-size:.9rem; font-weight:700; color:var(--text); margin-bottom:.2rem; }
.oc-sub { font-size:.74rem; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.oc-arr { flex-shrink:0; color:var(--muted); margin-right:.8rem; transition:transform .2s,color .2s; }
.oc:hover .oc-arr { transform:translateX(4px); color:var(--c); }

/* LIGHTBOX */
.lightbox { position:fixed; inset:0; z-index:9000; background:rgba(0,0,0,.9); backdrop-filter:blur(8px); display:flex; align-items:center; justify-content:center; cursor:pointer; }
.lightbox img { max-width:90vw; max-height:85vh; border-radius:10px; cursor:default; }
.lb-x { position:absolute; top:1.4rem; right:1.4rem; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); color:#fff; width:34px; height:34px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:background .2s; }
.lb-x:hover { background:rgba(255,255,255,.2); }
.lb-enter-active,.lb-leave-active { transition:opacity .22s; }
.lb-enter-from,.lb-leave-to { opacity:0; }

/* RESPONSIVE */
@media (max-width:800px) {
  .tc-desc { grid-template-columns:1fr; }
  .tcd-aside { position:static; }
  .feat-grid { grid-template-columns:1fr; }
  .sr-item { flex:1 1 50%; }
}
@media (max-width:480px) {
  .ph-title { font-size:2rem; }
  .sr-item { flex:1 1 100%; border-right:none; border-bottom:1px solid var(--card-b); }
}
</style>