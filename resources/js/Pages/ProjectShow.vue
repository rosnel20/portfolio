<template>
  <div class="ppage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />

    <main>
      <!-- ══════════════════ HERO ══════════════════ -->
      <section class="ph">
        <div class="ph-bg">
          <div class="ph-grid"></div>
          <div class="ph-orb" :style="{ background: project.color }"></div>
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
            <span v-for="t in project.tags" :key="t" class="pht"
              :style="{ color: project.color, background: project.color+'14', borderColor: project.color+'30' }">
              {{ t }}
            </span>
            <span class="ph-yr">{{ project.year }}</span>
          </div>

          <h1 class="ph-title">{{ project.title }}</h1>
          <p  class="ph-sub">{{ project.tagline }}</p>

          <div class="ph-btns">
            <a v-if="project.demo" :href="project.demo" target="_blank" rel="noopener"
               class="phb-main" :style="{ background: project.color }">
              Voir en ligne
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
            <a v-if="project.github" :href="project.github" target="_blank" rel="noopener" class="phb-ghost">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
              Code source
            </a>
          </div>
        </div>

        <!-- ── Browser screenshot hero ── -->
        <div class="ph-screen">
          <div class="phs-browser">
            <!-- Barre navigateur factice -->
            <div class="phs-bar">
              <div class="phs-dots-browser">
                <span class="db r"></span><span class="db y"></span><span class="db g"></span>
              </div>
              <div class="phs-url">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                {{ project.demo || 'rosnel.dev/projets/' + project.slug }}
              </div>
              <div v-if="screenshots.length > 1" class="phs-counter">
                <span :style="{ color: project.color }">{{ currentIndex + 1 }}</span>
                <span class="phs-counter-sep">/</span>
                <span>{{ screenshots.length }}</span>
              </div>
            </div>

            <!-- Zone image principale -->
            <div class="phs-stage" :style="{ background: `linear-gradient(135deg, ${project.color}12, ${project.color}04)` }">

              <!-- Skeleton pendant chargement -->
              <div v-if="heroLoading" class="phs-skeleton">
                <div class="sk-shine"></div>
              </div>

              <!-- Image principale avec transition -->
              <Transition :name="slideDir" mode="out-in">
                <img
                  v-if="screenshots.length && !heroLoading"
                  :key="currentIndex"
                  :src="screenshots[currentIndex]"
                  :alt="`${project.title} — capture ${currentIndex + 1}`"
                  class="phs-img"
                  @click="openLightbox(currentIndex)"
                />
                <div v-else-if="!screenshots.length && !heroLoading" class="phs-empty-hero" :style="{ color: project.color }">
                  <span class="phs-letter">{{ project.title.charAt(0) }}</span>
                </div>
              </Transition>

              <!-- Flèches nav -->
              <template v-if="screenshots.length > 1">
                <button class="phs-nav prev" @click="prev" aria-label="Précédent">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="phs-nav next" @click="next" aria-label="Suivant">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
              </template>

              <!-- Bouton zoom -->
              <button v-if="screenshots.length" class="phs-zoom" @click="openLightbox(currentIndex)" aria-label="Agrandir">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
              </button>
            </div>

            <!-- Indicateurs pill -->
            <div v-if="screenshots.length > 1" class="phs-pills">
              <button
                v-for="(_, i) in screenshots" :key="i"
                class="phs-pill"
                :class="{ active: i === currentIndex }"
                :style="i === currentIndex ? { background: project.color } : {}"
                @click="goTo(i)"
                :aria-label="`Capture ${i + 1}`"
              ></button>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════════ STATS ══════════════════ -->
      <div v-if="project.stats?.length" class="stats-row">
        <div class="sr-inner">
          <div v-for="s in project.stats" :key="s.label" class="sr-item">
            <span class="sri-v" :style="{ color: project.color }">{{ s.val }}</span>
            <span class="sri-l">{{ s.label }}</span>
          </div>
        </div>
      </div>

      <!-- ══════════════════ BODY ══════════════════ -->
      <section class="pbody">
        <div class="pb-inner">

          <!-- Onglets -->
          <div class="tabs">
            <button
              v-for="tab in allTabs" :key="tab.id"
              class="tab" :class="{ active: activeTab === tab.id }"
              :style="activeTab === tab.id ? { color: project.color, borderColor: project.color } : {}"
              @click="activeTab = tab.id"
            >
              {{ tab.label }}
              <span v-if="tab.id === 'photos' && screenshots.length" class="tab-count">{{ screenshots.length }}</span>
            </button>
          </div>

          <!-- ── Tab : Présentation ── -->
          <div v-if="activeTab === 'desc'" class="tc-desc">
            <div class="tcd-main">
              <div class="blk-label">Le projet</div>
              <div class="blk-text" v-html="project.description"></div>

              <div v-if="project.features?.length" class="feat-grid">
                <div v-for="f in project.features" :key="f.title" class="feat-card">
                  <div class="fc-ico" :style="{ color: project.color, background: project.color + '14' }">
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
                <a v-if="project.demo"   :href="project.demo"   target="_blank" rel="noopener" class="al-btn main" :style="{ background: project.color }">Voir en ligne ↗</a>
                <a v-if="project.github" :href="project.github" target="_blank" rel="noopener" class="al-btn ghost">GitHub ↗</a>
              </div>
            </aside>
          </div>

          <!-- ── Tab : Galerie photos ── -->
          <div v-if="activeTab === 'photos'" class="tc-photos">

            <template v-if="screenshots.length">
              <!-- Vue principale + vignettes -->
              <div class="gallery">

                <!-- Aperçu grand format -->
                <div class="gallery-main">
                  <div class="gm-stage" @click="openLightbox(currentIndex)">

                    <!-- Skeleton -->
                    <div v-if="galleryLoading[currentIndex]" class="gm-skeleton">
                      <div class="sk-shine"></div>
                    </div>

                    <Transition :name="slideDir" mode="out-in">
                      <img
                        :key="currentIndex"
                        :src="screenshots[currentIndex]"
                        :alt="`${project.title} — ${currentIndex + 1}`"
                        class="gm-img"
                        :class="{ loaded: !galleryLoading[currentIndex] }"
                        @load="galleryLoading[currentIndex] = false"
                      />
                    </Transition>

                    <!-- Overlay hover -->
                    <div class="gm-overlay">
                      <div class="gmo-inner">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                        <span>Agrandir</span>
                      </div>
                    </div>

                    <!-- Flèches -->
                    <button v-if="screenshots.length > 1" class="gm-nav prev" @click.stop="prev">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button v-if="screenshots.length > 1" class="gm-nav next" @click.stop="next">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>

                    <!-- Badge numéro -->
                    <div class="gm-badge" :style="{ background: project.color }">
                      {{ currentIndex + 1 }} <span class="gm-badge-sep">/</span> {{ screenshots.length }}
                    </div>
                  </div>

                  <!-- Dots mobiles -->
                  <div class="gm-dots">
                    <span
                      v-for="(_, i) in screenshots" :key="i"
                      class="gmd"
                      :class="{ active: i === currentIndex }"
                      :style="i === currentIndex ? { background: project.color, width: '20px' } : {}"
                      @click="goTo(i)"
                    ></span>
                  </div>
                </div>

                <!-- Grille de vignettes -->
                <div class="gallery-thumbs">
                  <div
                    v-for="(sc, i) in screenshots" :key="i"
                    class="gt-item"
                    :class="{ active: i === currentIndex }"
                    :style="i === currentIndex ? { borderColor: project.color, boxShadow: `0 0 0 2px ${project.color}35` } : {}"
                    @click="goTo(i)"
                  >
                    <!-- Skeleton vignette -->
                    <div v-if="thumbLoading[i]" class="gt-skeleton">
                      <div class="sk-shine"></div>
                    </div>

                    <img
                      :src="sc"
                      :alt="`Vignette ${i + 1}`"
                      loading="lazy"
                      :class="{ loaded: !thumbLoading[i] }"
                      @load="thumbLoading[i] = false"
                      @error="thumbLoading[i] = false"
                    />

                    <!-- Overlay vignette active -->
                    <div class="gt-active-badge" v-if="i === currentIndex" :style="{ background: project.color }">
                      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>

                    <!-- Numéro -->
                    <span class="gt-num">{{ i + 1 }}</span>
                  </div>
                </div>
              </div>
            </template>

            <!-- État vide -->
            <div v-else class="photos-empty">
              <div class="pe-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              </div>
              <p class="pe-title">Aucune capture disponible</p>
              <p class="pe-sub">Les screenshots seront ajoutés prochainement.</p>
            </div>
          </div>

        </div>
      </section>

      <!-- ══════════════════ AUTRES PROJETS ══════════════════ -->
      <section v-if="otherProjects?.length" class="other">
        <div class="o-inner">
          <div class="o-head">
            <span class="o-label">Autres projets</span>
          </div>
          <div class="o-grid">
            <Link
              v-for="p in otherProjects" :key="p.slug"
              :href="'/projets/' + p.slug"
              class="oc" :style="{ '--c': p.color }"
            >
              <div class="oc-band" :style="{ background: p.color }"></div>
              <div class="oc-body">
                <div class="oc-tags">
                  <span v-for="t in p.tags.slice(0, 2)" :key="t">{{ t }}</span>
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

    <!-- ══════════════════ LIGHTBOX ══════════════════ -->
    <Transition name="lb">
      <div v-if="lightboxOpen" class="lightbox" @click="closeLightbox">

        <!-- Fermer -->
        <button class="lb-close" @click="closeLightbox" aria-label="Fermer">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>

        <!-- Navigation gauche -->
        <button v-if="screenshots.length > 1" class="lb-nav prev" @click.stop="lbPrev" aria-label="Précédent">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>

        <!-- Image -->
        <div class="lb-img-wrap" @click.stop>
          <Transition name="lb-slide" mode="out-in">
            <img
              :key="lbIndex"
              :src="screenshots[lbIndex]"
              :alt="`${project.title} — ${lbIndex + 1}`"
              class="lb-img"
            />
          </Transition>
          <!-- Caption -->
          <div class="lb-caption">
            <span class="lb-title">{{ project.title }}</span>
            <span class="lb-pos" :style="{ color: project.color }">{{ lbIndex + 1 }} / {{ screenshots.length }}</span>
          </div>
        </div>

        <!-- Navigation droite -->
        <button v-if="screenshots.length > 1" class="lb-nav next" @click.stop="lbNext" aria-label="Suivant">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
        </button>

        <!-- Strips de vignettes en bas -->
        <div v-if="screenshots.length > 1" class="lb-strip">
          <button
            v-for="(sc, i) in screenshots" :key="i"
            class="lb-strip-item"
            :class="{ active: i === lbIndex }"
            :style="i === lbIndex ? { borderColor: project.color } : {}"
            @click.stop="lbIndex = i"
          >
            <img :src="sc" loading="lazy"/>
          </button>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, computed, reactive, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'

const props = defineProps({ project: Object, otherProjects: Array })

/* ── Thème ── */
const theme = ref(localStorage.getItem('theme') || 'dark')
function toggleTheme() {
  theme.value = theme.value === 'dark' ? 'light' : 'dark'
  localStorage.setItem('theme', theme.value)
}

/* ── Screenshots raccourci ── */
const screenshots = computed(() => props.project.screenshots ?? [])

/* ── États de chargement ── */
const heroLoading    = ref(true)
const galleryLoading = reactive({})
const thumbLoading   = reactive({})

// Initialise les états loading pour chaque capture
onMounted(() => {
  screenshots.value.forEach((_, i) => {
    galleryLoading[i] = true
    thumbLoading[i]   = true
  })
  // Précharge la 1ère image hero
  if (screenshots.value.length) {
    const img = new Image()
    img.onload  = () => { heroLoading.value = false }
    img.onerror = () => { heroLoading.value = false }
    img.src = screenshots.value[0]
  } else {
    heroLoading.value = false
  }
})

/* ── Carrousel ── */
const currentIndex = ref(0)
const slideDir     = ref('slide-left')

function prev() {
  const n = screenshots.value.length; if (!n) return
  slideDir.value = 'slide-right'
  currentIndex.value = (currentIndex.value - 1 + n) % n
  preloadAdjacent()
}
function next() {
  const n = screenshots.value.length; if (!n) return
  slideDir.value = 'slide-left'
  currentIndex.value = (currentIndex.value + 1) % n
  preloadAdjacent()
}
function goTo(i) {
  slideDir.value = i > currentIndex.value ? 'slide-left' : 'slide-right'
  currentIndex.value = i
  preloadAdjacent()
}

// Précharge la suivante et la précédente
function preloadAdjacent() {
  const n = screenshots.value.length; if (!n) return
  const indices = [
    (currentIndex.value + 1) % n,
    (currentIndex.value - 1 + n) % n,
  ]
  indices.forEach(i => {
    if (galleryLoading[i]) {
      const img = new Image()
      img.onload  = () => { galleryLoading[i] = false; thumbLoading[i] = false }
      img.onerror = () => { galleryLoading[i] = false; thumbLoading[i] = false }
      img.src = screenshots.value[i]
    }
  })
}

/* ── Onglets ── */
const activeTab = ref('desc')
const allTabs   = [
  { id: 'desc',   label: 'Présentation' },
  { id: 'photos', label: 'Captures' },
]

/* ── Lightbox ── */
const lightboxOpen = ref(false)
const lbIndex      = ref(0)

function openLightbox(i) {
  lbIndex.value      = i
  lightboxOpen.value = true
  document.body.style.overflow = 'hidden'
}
function closeLightbox() {
  lightboxOpen.value = false
  document.body.style.overflow = ''
}
function lbPrev() {
  const n = screenshots.value.length
  lbIndex.value = (lbIndex.value - 1 + n) % n
}
function lbNext() {
  const n = screenshots.value.length
  lbIndex.value = (lbIndex.value + 1) % n
}

/* ── Clavier ── */
function onKey(e) {
  if (lightboxOpen.value) {
    if (e.key === 'ArrowLeft')  lbPrev()
    if (e.key === 'ArrowRight') lbNext()
    if (e.key === 'Escape')     closeLightbox()
  } else {
    if (e.key === 'ArrowLeft')  prev()
    if (e.key === 'ArrowRight') next()
  }
}
onMounted(() => window.addEventListener('keydown', onKey))
onUnmounted(() => { window.removeEventListener('keydown', onKey); document.body.style.overflow = '' })
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap');

/* ── THÈME ── */
.ppage.dark {
  --bg: #0A0A0A; --bg2: #111111; --footer-bg: #080808;
  --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text: #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg: rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red: #E53E3E; --red-soft: rgba(229,62,62,.1); --blue: #3B82F6;
  --lbl: rgba(255,255,255,.18); --sk: rgba(255,255,255,.06);
}
.ppage.light {
  --bg: #F8F8F8; --bg2: #FFFFFF; --footer-bg: #EFEFEF;
  --card: rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text: #0A0A0A; --muted: #888; --muted2: #AAA;
  --nav-bg: rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red: #C53030; --red-soft: rgba(197,48,48,.08); --blue: #2563EB;
  --lbl: rgba(0,0,0,.2); --sk: rgba(0,0,0,.07);
}

* { box-sizing: border-box; margin: 0; padding: 0; }
.ppage { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; transition: background .4s, color .4s; }

/* ═══════════════════════════ HERO ═══════════════════════════ */
.ph { position: relative; padding: 8rem 5vw 0; overflow: hidden; }
.ph-bg { position: absolute; inset: 0; pointer-events: none; }
.ph-grid {
  position: absolute; inset: 0;
  background-image: linear-gradient(rgba(229,62,62,.07) 1px, transparent 1px), linear-gradient(90deg, rgba(229,62,62,.07) 1px, transparent 1px);
  background-size: 48px 48px;
  -webkit-mask-image: radial-gradient(ellipse 80% 70% at 50% 30%, black 20%, transparent 80%);
  mask-image: radial-gradient(ellipse 80% 70% at 50% 30%, black 20%, transparent 80%);
}
.ph-orb { position: absolute; width: 560px; height: 560px; border-radius: 50%; top: -160px; right: -80px; opacity: .07; filter: blur(110px); }

.ph-inner { position: relative; z-index: 2; max-width: 1100px; margin: 0 auto; }
.ph-crumb { display: flex; align-items: center; gap: .55rem; font-size: .78rem; color: var(--muted); margin-bottom: 2rem; }
.pc-back { display: inline-flex; align-items: center; gap: .4rem; color: var(--muted); text-decoration: none; transition: color .2s; }
.pc-sep  { opacity: .4; }
.pc-cur  { color: var(--muted2); }
.ph-tags { display: flex; flex-wrap: wrap; align-items: center; gap: .45rem; margin-bottom: 1.3rem; }
.pht { font-family: 'JetBrains Mono', monospace; font-size: .66rem; letter-spacing: .07em; padding: .2rem .68rem; border-radius: 5px; border: 1px solid; }
.ph-yr  { font-family: 'JetBrains Mono', monospace; font-size: .66rem; color: var(--muted); letter-spacing: .1em; margin-left: .3rem; }
.ph-title { font-size: clamp(2.2rem, 5.5vw, 4.2rem); font-weight: 900; letter-spacing: -.05em; line-height: 1.0; color: var(--text); margin-bottom: .9rem; }
.ph-sub   { font-size: 1rem; color: var(--muted2); line-height: 1.75; max-width: 540px; margin-bottom: 2rem; }
.ph-btns  { display: flex; gap: .9rem; flex-wrap: wrap; margin-bottom: 3.5rem; }
.phb-main { display: inline-flex; align-items: center; gap: .5rem; color: #fff; padding: .76rem 1.7rem; border-radius: 10px; font-weight: 700; font-size: .88rem; text-decoration: none; transition: transform .2s, opacity .2s; }
.phb-ghost { display: inline-flex; align-items: center; gap: .5rem; background: transparent; color: var(--text); border: 1px solid var(--card-b); padding: .76rem 1.7rem; border-radius: 10px; font-size: .88rem; text-decoration: none; transition: border-color .2s, background .2s; }

/* ── Screenshot hero browser ── */
.ph-screen { max-width: 1100px; margin: 0 auto; position: relative; z-index: 2; }
.phs-browser { border-radius: 14px 14px 0 0; overflow: hidden; border: 1px solid var(--card-b); border-bottom: none; box-shadow: 0 -8px 48px rgba(0,0,0,.22); }
.phs-bar { background: var(--bg2); padding: .62rem 1rem; display: flex; align-items: center; gap: .7rem; border-bottom: 1px solid var(--card-b); }
.phs-dots-browser { display: flex; gap: .36rem; flex-shrink: 0; }
.db { width: 10px; height: 10px; border-radius: 50%; }
.db.r { background: #FF5F57; }
.db.y { background: #FFBD2E; }
.db.g { background: #28CA41; }
.phs-url {
  flex: 1; max-width: 280px; margin: 0 auto;
  background: var(--card); border: 1px solid var(--card-b); border-radius: 6px;
  padding: .22rem .75rem; font-family: 'JetBrains Mono', monospace; font-size: .68rem;
  color: var(--muted); text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  display: flex; align-items: center; gap: .4rem; justify-content: center;
}
.phs-counter { font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--muted); white-space: nowrap; flex-shrink: 0; }
.phs-counter-sep { margin: 0 .15rem; opacity: .4; }

/* Stage = zone image — contient l'image entière, centrée, fond neutre assorti */
.phs-stage {
  aspect-ratio: 16/9;
  min-height: 300px;
  overflow: hidden;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: zoom-in;
  background: #f2f2f2;
}
.ppage.dark .phs-stage {
  background: #181818;
}

.phs-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center top;
  display: block;
  transition: transform .5s ease;
}
.phs-empty-hero { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; }
.phs-letter { font-size: 9rem; font-weight: 900; opacity: .1; letter-spacing: -.06em; line-height: 1; }

/* Skeleton */
.phs-skeleton, .gm-skeleton, .gt-skeleton {
  position: absolute; inset: 0; background: var(--sk); overflow: hidden; z-index: 3;
}
.sk-shine {
  position: absolute; inset: 0; top: 0; left: -100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.05) 50%, transparent);
  animation: shine 1.6s ease-in-out infinite;
}
@keyframes shine { to { left: 100%; } }

/* Boutons nav hero */
.phs-nav {
  position: absolute; top: 50%; transform: translateY(-50%); z-index: 4;
  width: 38px; height: 38px; border-radius: 50%;
  background: rgba(0,0,0,.55); border: 1px solid rgba(255,255,255,.14);
  color: #fff; display: flex; align-items: center; justify-content: center;
  cursor: pointer; backdrop-filter: blur(6px);
  transition: background .2s, scale .15s;
  opacity: 0;
}
.phs-nav.prev { left: .9rem; }
.phs-nav.next { right: .9rem; }

/* Zoom */
.phs-zoom {
  position: absolute; bottom: .8rem; right: .8rem; z-index: 4;
  width: 30px; height: 30px; border-radius: 7px;
  background: rgba(0,0,0,.5); border: 1px solid rgba(255,255,255,.14);
  color: #fff; display: flex; align-items: center; justify-content: center;
  cursor: pointer; backdrop-filter: blur(6px); transition: background .2s;
  opacity: 0;
}

/* Pills indicateurs */
.phs-pills {
  background: var(--bg2); border-top: 1px solid var(--card-b);
  display: flex; justify-content: center; gap: .45rem; padding: .65rem 1rem;
}
.phs-pill {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--card-b); border: none; cursor: pointer;
  transition: all .22s ease;
}
.phs-pill.active { width: 22px; border-radius: 3px; }

/* ═══════════════════════════ STATS ═══════════════════════════ */
.stats-row { background: var(--bg2); border-bottom: 1px solid var(--card-b); }
.sr-inner { max-width: 1100px; margin: 0 auto; padding: 2.2rem 5vw; display: flex; flex-wrap: wrap; }
.sr-item { flex: 1; text-align: center; padding: .8rem 1.5rem; border-right: 1px solid var(--card-b); }
.sr-item:last-child { border-right: none; }
.sri-v { display: block; font-size: 1.9rem; font-weight: 900; letter-spacing: -.04em; line-height: 1; margin-bottom: .3rem; }
.sri-l { font-size: .72rem; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; }

/* ═══════════════════════════ BODY ═══════════════════════════ */
.pbody { background: var(--bg2); padding: 4rem 5vw 5rem; }
.pb-inner { max-width: 1100px; margin: 0 auto; }

/* Onglets */
.tabs { display: flex; gap: .4rem; margin-bottom: 2.5rem; border-bottom: 1px solid var(--card-b); }
.tab {
  background: none; border: none; cursor: pointer;
  font-family: 'Outfit', sans-serif; font-size: .85rem; font-weight: 600;
  color: var(--muted); padding: .65rem 1.2rem;
  border-bottom: 2px solid transparent; margin-bottom: -1px;
  transition: color .2s, border-color .2s;
  display: flex; align-items: center; gap: .45rem;
}
.tab-count {
  font-family: 'JetBrains Mono', monospace; font-size: .58rem;
  background: var(--card); border: 1px solid var(--card-b);
  padding: .1rem .4rem; border-radius: 4px; color: var(--muted);
}

/* ── Tab desc ── */
.tc-desc { display: grid; grid-template-columns: 1fr 300px; gap: 3.5rem; align-items: start; }
.blk-label {
  font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--lbl);
  letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1.1rem;
  display: flex; align-items: center; gap: .55rem;
}
.blk-label::before { content: ''; display: block; width: 16px; height: 1px; background: var(--red); }
.blk-text { font-size: .93rem; color: var(--muted2); line-height: 1.9; margin-bottom: 2.5rem; }
.blk-text :deep(p) { margin-bottom: .9rem; }
.blk-text :deep(strong) { color: var(--text); font-weight: 600; }
.feat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .9rem; }
.feat-card { display: flex; gap: .85rem; align-items: flex-start; background: var(--card); border: 1px solid var(--card-b); border-radius: 12px; padding: 1rem; transition: border-color .2s; }
.fc-ico { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.fc-t { font-size: .85rem; font-weight: 700; color: var(--text); margin-bottom: .25rem; }
.fc-d { font-size: .76rem; color: var(--muted); line-height: 1.55; }

/* Aside */
.tcd-aside { display: flex; flex-direction: column; gap: 1.1rem; position: sticky; top: 6rem; }
.aside-card { background: var(--card); border: 1px solid var(--card-b); border-radius: 14px; padding: 1.2rem; }
.ac-head { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--lbl); letter-spacing: .18em; text-transform: uppercase; margin-bottom: 1.1rem; }
.ac-stack { display: flex; flex-direction: column; gap: .65rem; }
.acs-row  { display: flex; align-items: center; gap: .65rem; }
.acs-row img { object-fit: contain; flex-shrink: 0; }
.acs-name { font-size: .83rem; font-weight: 600; color: var(--text); flex: 1; }
.acs-role { font-size: .7rem; color: var(--muted); font-family: 'JetBrains Mono', monospace; }
.ac-info  { display: flex; flex-direction: column; gap: .55rem; }
.aci-row  { display: flex; justify-content: space-between; align-items: center; font-size: .8rem; }
.aci-row span:first-child { color: var(--muted); }
.aci-row span:last-child  { color: var(--text); font-weight: 600; }
.aside-links { display: flex; flex-direction: column; gap: .55rem; }
.al-btn { display: flex; align-items: center; justify-content: center; padding: .7rem; border-radius: 10px; font-size: .84rem; font-weight: 700; text-decoration: none; transition: transform .2s, opacity .2s; }
.al-btn.main { color: #fff; }
.al-btn.ghost { background: var(--card); border: 1px solid var(--card-b); color: var(--text); }

/* ═══════════════════════════ GALERIE PHOTOS ═══════════════════════════ */
.tc-photos {}

.gallery { display: grid; grid-template-columns: 1fr 200px; gap: 1.2rem; align-items: start; }

/* Aperçu principal galerie */
.gallery-main {}
.gm-stage {
  position: relative; aspect-ratio: 16/9; border-radius: 14px; overflow: hidden;
  border: 1px solid var(--card-b);
  cursor: zoom-in; margin-bottom: .8rem;
  display: flex; align-items: center; justify-content: center;
  background: #f2f2f2;
}
.ppage.dark .gm-stage {
  background: #181818;
}

.gm-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center top;
  display: block;
  opacity: 0; transition: opacity .35s ease, transform .5s ease;
}
.gm-img.loaded { opacity: 1; }

/* Overlay hover */
.gm-overlay {
  position: absolute; inset: 0; background: rgba(0,0,0,.45);
  display: flex; align-items: center; justify-content: center;
  opacity: 0; transition: opacity .25s;
}
.gmo-inner { display: flex; flex-direction: column; align-items: center; gap: .5rem; color: #fff; font-size: .8rem; font-weight: 600; }

/* Boutons nav galerie */
.gm-nav {
  position: absolute; top: 50%; transform: translateY(-50%); z-index: 4;
  width: 42px; height: 42px; border-radius: 50%;
  background: rgba(0,0,0,.6); border: 1px solid rgba(255,255,255,.18);
  color: #fff; display: flex; align-items: center; justify-content: center;
  cursor: pointer; backdrop-filter: blur(8px);
  transition: background .2s, scale .15s; opacity: 0;
}
.gm-nav.prev { left: 1rem; }
.gm-nav.next { right: 1rem; }

/* Badge numéro */
.gm-badge {
  position: absolute; bottom: .85rem; left: 50%; transform: translateX(-50%);
  font-family: 'JetBrains Mono', monospace; font-size: .66rem; font-weight: 700;
  color: #fff; padding: .22rem .8rem; border-radius: 100px;
  display: flex; align-items: center; gap: .2rem; opacity: .92;
}
.gm-badge-sep { opacity: .6; margin: 0 .15rem; }

/* Dots mobiles */
.gm-dots { display: none; justify-content: center; gap: .45rem; }
.gmd {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--card-b); cursor: pointer; transition: all .22s; border: none;
}
.gmd.active { border-radius: 3px; }

/* ── Grille vignettes ── */
.gallery-thumbs {
  display: flex; flex-direction: column; gap: .55rem;
  max-height: calc((100vw * .14 + .55rem) * 6);
  overflow-y: auto; padding-right: .2rem;
  scrollbar-width: thin;
}
.gallery-thumbs::-webkit-scrollbar { width: 3px; }
.gallery-thumbs::-webkit-scrollbar-track { background: transparent; }
.gallery-thumbs::-webkit-scrollbar-thumb { background: var(--card-b); border-radius: 2px; }

.gt-item {
  position: relative; aspect-ratio: 16/9; border-radius: 9px; overflow: hidden;
  border: 2px solid var(--card-b); cursor: pointer;
  transition: border-color .2s, box-shadow .2s, opacity .2s;
  background: #f2f2f2;
  display: flex; align-items: center; justify-content: center;
}
.ppage.dark .gt-item { background: #181818; }
.gt-item:not(.active) { opacity: .5; }
.gt-item.active { opacity: 1; }
.gt-item img {
  width: 100%; height: 100%;
  object-fit: contain;
  object-position: center top;
  display: block;
  opacity: 0; transition: opacity .3s ease;
}
.gt-item img.loaded { opacity: 1; }

/* Active badge vignette */
.gt-active-badge {
  position: absolute; top: .35rem; right: .35rem;
  width: 18px; height: 18px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
}
/* Numéro vignette */
.gt-num {
  position: absolute; bottom: .3rem; left: .4rem;
  font-family: 'JetBrains Mono', monospace; font-size: .58rem;
  color: rgba(255,255,255,.7); text-shadow: 0 1px 3px rgba(0,0,0,.6);
  line-height: 1;
}

/* État vide */
.photos-empty { text-align: center; padding: 5rem 2rem; display: flex; flex-direction: column; align-items: center; gap: .9rem; }
.pe-icon { width: 64px; height: 64px; border-radius: 16px; background: var(--card); border: 1px solid var(--card-b); display: flex; align-items: center; justify-content: center; color: var(--muted); }
.pe-title { font-size: 1rem; font-weight: 700; color: var(--text); }
.pe-sub   { font-size: .84rem; color: var(--muted); }

/* ═══════════════════════════ AUTRES PROJETS ═══════════════════════════ */
.other { background: var(--bg); padding: 5rem 5vw; }
.o-inner { max-width: 1100px; margin: 0 auto; }
.o-head  { margin-bottom: 1.5rem; }
.o-label { font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; }
.o-grid  { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1rem; }
.oc { display: flex; align-items: center; gap: 1rem; background: var(--card); border: 1px solid var(--card-b); border-radius: 13px; text-decoration: none; overflow: hidden; transition: transform .22s, border-color .22s; }
.oc-band  { width: 4px; height: 100%; min-height: 72px; flex-shrink: 0; }
.oc-body  { flex: 1; padding: .9rem .9rem .9rem 0; }
.oc-tags  { display: flex; gap: .3rem; margin-bottom: .3rem; }
.oc-tags span { font-size: .6rem; color: var(--muted); font-family: 'JetBrains Mono', monospace; letter-spacing: .05em; }
.oc-title { font-size: .9rem; font-weight: 700; color: var(--text); margin-bottom: .2rem; }
.oc-sub   { font-size: .74rem; color: var(--muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.oc-arr   { flex-shrink: 0; color: var(--muted); margin-right: .8rem; transition: transform .2s, color .2s; }

/* ═══════════════════════════ LIGHTBOX ═══════════════════════════ */
.lightbox {
  position: fixed; inset: 0; z-index: 9000;
  background: rgba(0,0,0,.94); backdrop-filter: blur(12px);
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: 1.2rem; cursor: pointer;
}

/* Image wrapper */
.lb-img-wrap {
  display: flex; flex-direction: column; align-items: center; gap: .8rem;
  cursor: default; max-width: 88vw;
}
.lb-img {
  max-width: 88vw; max-height: 74vh;
  width: auto; height: auto;
  object-fit: contain;
  border-radius: 10px; display: block;
  box-shadow: 0 28px 80px rgba(0,0,0,.55);
  cursor: default;
  background: transparent;
}
.lb-caption { display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 1rem; }
.lb-title { font-size: .82rem; color: rgba(255,255,255,.55); font-weight: 600; }
.lb-pos   { font-family: 'JetBrains Mono', monospace; font-size: .72rem; font-weight: 700; }

/* Fermer */
.lb-close {
  position: absolute; top: 1.2rem; right: 1.2rem;
  width: 36px; height: 36px; border-radius: 50%;
  background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
  color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center;
  transition: background .2s; z-index: 2;
}

/* Nav lightbox */
.lb-nav {
  position: absolute; top: 50%; transform: translateY(-50%);
  width: 50px; height: 50px; border-radius: 50%;
  background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
  color: #fff; display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: background .2s, scale .15s;
  backdrop-filter: blur(4px); z-index: 2;
}
.lb-nav.prev { left: 1.5rem; }
.lb-nav.next { right: 1.5rem; }

/* Strip vignettes lightbox */
.lb-strip {
  display: flex; gap: .5rem; overflow-x: auto; padding: .3rem .5rem;
  max-width: min(88vw, 700px); cursor: default;
  scrollbar-width: thin;
}
.lb-strip::-webkit-scrollbar { height: 3px; }
.lb-strip::-webkit-scrollbar-thumb { background: rgba(255,255,255,.2); border-radius: 2px; }
.lb-strip-item {
  flex-shrink: 0; width: 64px; aspect-ratio: 16/9; border-radius: 6px; overflow: hidden;
  border: 2px solid transparent; cursor: pointer; transition: border-color .2s, opacity .2s;
  opacity: .45; background: rgba(255,255,255,.08);
}
.lb-strip-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
.lb-strip-item.active { opacity: 1; }

/* ── TRANSITIONS ── */
.slide-left-enter-active, .slide-left-leave-active,
.slide-right-enter-active, .slide-right-leave-active {
  transition: opacity .2s ease, transform .2s ease;
}
.slide-left-enter-from  { opacity: 0; transform: translateX(24px); }
.slide-left-leave-to    { opacity: 0; transform: translateX(-24px); }
.slide-right-enter-from { opacity: 0; transform: translateX(-24px); }
.slide-right-leave-to   { opacity: 0; transform: translateX(24px); }

.lb-slide-enter-active, .lb-slide-leave-active { transition: opacity .18s ease; }
.lb-slide-enter-from, .lb-slide-leave-to { opacity: 0; }

.lb-enter-active, .lb-leave-active { transition: opacity .25s; }
.lb-enter-from, .lb-leave-to { opacity: 0; }

/* ══ HOVER : vrais pointeurs uniquement ══ */
@media (hover: hover) and (pointer: fine) {
  .pc-back:hover      { color: var(--text); }
  .phb-main:hover     { transform: translateY(-2px); opacity: .9; }
  .phb-ghost:hover    { border-color: var(--red); background: var(--red-soft); }
  .phs-stage:hover .phs-nav  { opacity: 1; }
  .phs-stage:hover .phs-zoom { opacity: 1; }
  .phs-stage:hover .phs-img  { transform: scale(1.03); transform-origin: center top; }
  .phs-nav:hover      { background: rgba(0,0,0,.78); scale: 1.08; }
  .phs-zoom:hover     { background: rgba(0,0,0,.76); }
  .feat-card:hover    { border-color: rgba(229,62,62,.2); }
  .tab:hover          { color: var(--text); }
  .al-btn.main:hover  { transform: translateY(-2px); opacity: .9; }
  .al-btn.ghost:hover { border-color: var(--red); background: var(--red-soft); }
  .gm-stage:hover .gm-overlay { opacity: 1; }
  .gm-stage:hover .gm-nav     { opacity: 1; }
  .gm-stage:hover .gm-img     { transform: scale(1.03); transform-origin: center top; }
  .gm-nav:hover       { background: rgba(0,0,0,.82); scale: 1.08; }
  .gt-item:not(.active):hover { opacity: .8; border-color: rgba(255,255,255,.2); }
  .oc:hover           { transform: translateY(-3px); border-color: var(--c); }
  .oc:hover .oc-arr   { transform: translateX(4px); color: var(--c); }
  .lb-close:hover     { background: rgba(255,255,255,.22); }
  .lb-nav:hover       { background: rgba(255,255,255,.22); scale: 1.05; }
  .lb-strip-item:not(.active):hover { opacity: .75; }
}

/* Mobile touch : flèches toujours visibles */
@media (hover: none) {
  .phs-nav { opacity: 1; }
  .gm-nav  { opacity: 1; }
}

/* ══ RESPONSIVE ══ */

@media (max-width: 900px) {
  .gallery { grid-template-columns: 1fr; }
  .gallery-thumbs {
    flex-direction: row; overflow-x: auto; overflow-y: hidden;
    max-height: none; padding-bottom: .3rem; gap: .5rem;
  }
  .gallery-thumbs::-webkit-scrollbar { height: 3px; }
  .gt-item  { flex-shrink: 0; width: 100px; }
  .gm-dots  { display: flex; }
  .phs-stage { aspect-ratio: auto; min-height: 360px; max-height: 520px; }
  .gm-stage  { aspect-ratio: auto; min-height: 320px; max-height: 480px; }
}

@media (max-width: 800px) {
  .tc-desc   { grid-template-columns: 1fr; }
  .tcd-aside { position: static; }
  .feat-grid { grid-template-columns: 1fr; }
  .sr-item   { flex: 1 1 50%; }
  .lb-nav.prev { left: .4rem; }
  .lb-nav.next { right: .4rem; }
}

@media (max-width: 680px) {
  .ph        { padding: 6.5rem 5vw 0; }
  .ph-title  { font-size: clamp(1.9rem, 7vw, 2.8rem); }
  .ph-sub    { font-size: .9rem; margin-bottom: 1.5rem; }
  .ph-btns   { gap: .7rem; margin-bottom: 2.5rem; }
  .phb-main, .phb-ghost { padding: .7rem 1.3rem; font-size: .84rem; }
  .pbody     { padding: 3rem 5vw 4rem; }
  .other     { padding: 3rem 5vw; }
  .tabs      { overflow-x: auto; padding-bottom: .1rem; gap: .2rem; }
  .tab       { font-size: .8rem; padding: .55rem .9rem; white-space: nowrap; }
}

@media (max-width: 600px) {
  /* Stage : contain + hauteur limitée, image toujours entière */
  .phs-stage {
    aspect-ratio: auto;
    min-height: unset;
    max-height: 60vh;
    padding: 0;
    align-items: center;
  }
  .phs-img {
    width: 100%;
    height: auto;
    max-height: 60vh;
    object-fit: contain;
    object-position: center top;
  }

  /* Barre browser compacte */
  .phs-bar    { padding: .45rem .75rem; }
  .phs-url    { font-size: .6rem; max-width: 160px; }
  .phs-counter { font-size: .58rem; }
  .db         { width: 8px; height: 8px; }

  /* Pills */
  .phs-pills  { padding: .45rem 1rem; gap: .4rem; }
  .phs-pill   { width: 5px; height: 5px; }
  .phs-pill.active { width: 16px; }

  /* Flèches + zoom */
  .phs-nav    { opacity: 1; width: 32px; height: 32px; }
  .phs-zoom   { display: none; }

  /* Galerie tab */
  .gm-stage {
    aspect-ratio: auto;
    min-height: unset;
    max-height: 55vh;
    padding: 0;
    align-items: center;
  }
  .gm-img {
    width: 100%;
    height: auto;
    max-height: 55vh;
    object-fit: contain;
    object-position: center top;
  }
  .gm-nav { opacity: 1; width: 32px; height: 32px; }
}

@media (max-width: 480px) {
  .ph        { padding: 5.5rem 4vw 0; }
  .ph-title  { font-size: 2rem; }
  .ph-btns   { flex-direction: column; align-items: stretch; }
  .phb-main, .phb-ghost { justify-content: center; }
  .ph-crumb  { font-size: .72rem; }
  .pbody     { padding: 2.5rem 4vw 3rem; }
  .other     { padding: 2.5rem 4vw; }
  .sr-item   { flex: 1 1 100%; border-right: none; border-bottom: 1px solid var(--card-b); }
  .sr-item:last-child { border-bottom: none; }
  .phs-stage { max-height: 52vh; }
  .phs-img   { max-height: 52vh; }
  .gm-stage  { max-height: 48vh; }
  .gm-img    { max-height: 48vh; }
  .lb-img    { max-height: 65vh; }
  .lb-strip  { display: none; }
  .lb-nav    { width: 38px; height: 38px; }
  .lb-nav.prev { left: .3rem; }
  .lb-nav.next { right: .3rem; }
  .feat-grid { grid-template-columns: 1fr; }
}

@media (max-width: 360px) {
  .ph-title  { font-size: 1.75rem; }
  .ph-tags   { gap: .3rem; }
  .pht       { font-size: .6rem; padding: .16rem .55rem; }
  .tabs      { gap: 0; }
  .tab       { font-size: .75rem; padding: .5rem .7rem; }
  .phs-stage { max-height: 44vh; }
  .phs-img   { max-height: 44vh; }
}

</style>