<template>
  <nav class="nav" :class="{ lifted: scrolled }">
    <div class="pill">

      <Link href="/" class="logo">rosnel<span class="dot">.</span>dev</Link>

      <!-- Desktop links -->
      <ul class="links">
        <li v-for="l in visibleLinks" :key="l.id">
          <a
            v-if="l.anchor"
            class="lnk" :class="{ active: active === l.id }"
            :href="'#' + l.id"
            @click.prevent="go(l.id)"
          >{{ l.label }}</a>
          <Link
            v-else
            class="lnk" :class="{ active: isLinkActive(l.href) }"
            :href="l.href"
          >{{ l.label }}</Link>
        </li>
      </ul>

      <div class="end">
        <!-- Toggle thème -->
        <button class="icon-btn" @click="$emit('toggle-theme')" :title="dark ? 'Mode clair' : 'Mode sombre'">
          <svg v-if="dark" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
          </svg>
          <svg v-else width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
        </button>

        <!-- CTA Contact (masqué si déjà sur /contact) -->
        <Link v-if="!onContact" class="cta" href="/contact">Contact</Link>

        <button class="burger" :class="{ x: menu }" @click="menu = !menu" aria-label="Menu">
          <span></span><span></span>
        </button>
      </div>
    </div>

    <!-- Menu mobile -->
    <Transition name="mob">
      <div v-if="menu" class="mobile">
        <template v-for="l in visibleLinks" :key="l.id">
          <a
            v-if="l.anchor"
            class="mob-lnk"
            :href="'#' + l.id"
            @click.prevent="go(l.id); menu = false"
          >
            <span class="mob-n">{{ String(visibleLinks.indexOf(l) + 1).padStart(2, '0') }}</span>
            {{ l.label }}
          </a>
          <Link v-else :href="l.href" class="mob-lnk" @click="menu = false">
            <span class="mob-n">{{ String(visibleLinks.indexOf(l) + 1).padStart(2, '0') }}</span>
            {{ l.label }}
          </Link>
        </template>

        <!-- Contact mobile -->
        <Link v-if="!onContact" href="/contact" class="mob-contact" @click="menu = false">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          Contact
        </Link>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

defineProps({ dark: Boolean })
defineEmits(['toggle-theme'])

const page     = usePage()
const scrolled = ref(false)
const active   = ref('hero')
const menu     = ref(false)

const currentUrl = computed(() => page.url ?? window.location.pathname)
const onHome    = computed(() => currentUrl.value === '/' || currentUrl.value === '' || currentUrl.value.startsWith('/#'))
const onContact = computed(() => currentUrl.value.startsWith('/contact'))

/*
  Liens selon la page courante :
  ─────────────────────────────────────────────────────
  Home      → Accueil · À propos · Projets · Blog  (ancres + lien)
  /blog/*   → ← Retour  +  les liens Home
  /projets/ → ← Retour
  /contact  → ← Retour
  ─────────────────────────────────────────────────────
*/
const homeLinks = [
  { label: 'Accueil',  id: 'hero',     anchor: true },
  { label: 'À propos', id: 'about',    anchor: true },
  { label: 'Projets',  id: 'projects', anchor: true },
  { label: 'Blog',     id: 'blog',     anchor: false, href: '/blog' },
]

const backLinks = [
  { label: '← Retour', id: 'back', href: '/', anchor: false },
]

/* Sur /blog : on garde les liens home + le retour est implicite via le logo */
const blogLinks = [
  { label: 'Accueil',  id: 'home',     anchor: false, href: '/' },
  { label: 'Projets',  id: 'projects', anchor: false, href: '/#projects' },
  { label: 'Blog',     id: 'blog',     anchor: false, href: '/blog' },
]

const visibleLinks = computed(() => {
  const u = currentUrl.value
  if (onHome.value)            return homeLinks
  if (u.startsWith('/blog'))   return blogLinks
  return backLinks
})

function isLinkActive(href) {
  if (!href) return false
  return currentUrl.value === href || currentUrl.value.startsWith(href + '/')
}

function go(id) {
  if (id === 'back') { window.history.back(); return }
  const el = document.getElementById(id)
  if (el) {
    window.scrollTo({ top: el.offsetTop - 90, behavior: 'smooth' })
  } else {
    window.location.href = '/#' + id
  }
}

function onScroll() {
  scrolled.value = window.scrollY > 50
  if (!onHome.value) return
  for (const id of ['contact', 'projects', 'about', 'hero']) {
    const el = document.getElementById(id)
    if (el && window.scrollY >= el.offsetTop - 130) {
      active.value = id; break
    }
  }
}

onMounted(() => { window.addEventListener('scroll', onScroll, { passive: true }); onScroll() })
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<style scoped>
.nav {
  position: fixed; top: .85rem; left: 50%;
  transform: translateX(-50%);
  z-index: 400;
  width: min(calc(100vw - 2rem), 960px);
}
.pill {
  display: flex; align-items: center; justify-content: space-between;
  gap: .5rem; padding: .68rem .9rem .68rem 1.4rem;
  background: var(--nav-bg); border: 1px solid var(--nav-b);
  border-radius: 100px;
  backdrop-filter: blur(28px); -webkit-backdrop-filter: blur(28px);
  transition: box-shadow .35s, border-color .35s;
}
.nav.lifted .pill { box-shadow: 0 8px 40px rgba(0,0,0,.32); border-color: rgba(229,62,62,.22); }
.logo { font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 1rem; color: var(--text); text-decoration: none; letter-spacing: -.04em; flex-shrink: 0; }
.dot  { color: var(--red); }

.links { display: flex; list-style: none; margin: 0; padding: 0; gap: 0; }
.lnk {
  display: block; color: var(--muted); text-decoration: none;
  font-size: .82rem; font-weight: 500;
  padding: .34rem .7rem; border-radius: 100px;
  transition: color .18s, background .18s;
  position: relative; cursor: pointer;
}
.lnk:hover { color: var(--text); background: rgba(255,255,255,.06); }
.lnk.active { color: var(--text); }
.lnk.active::after {
  content: ''; position: absolute; bottom: 2px; left: 50%;
  transform: translateX(-50%);
  width: 4px; height: 4px; border-radius: 50%; background: var(--red);
}

.end { display: flex; align-items: center; gap: .4rem; }
.icon-btn {
  width: 32px; height: 32px; border-radius: 50%;
  background: rgba(255,255,255,.06); border: 1px solid var(--nav-b);
  color: var(--muted); cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: color .2s, border-color .2s;
}
.icon-btn:hover { color: var(--text); border-color: var(--red); }
.cta {
  padding: .38rem 1.1rem; border-radius: 100px;
  background: var(--red); color: #fff; text-decoration: none;
  font-size: .8rem; font-weight: 700; white-space: nowrap;
  display: inline-flex; align-items: center;
  transition: opacity .2s, transform .2s;
}
.cta:hover { opacity: .85; transform: translateY(-1px); }

.burger {
  display: none; flex-direction: column; gap: 5px;
  background: none; border: none; cursor: pointer;
  width: 32px; height: 32px; align-items: center; justify-content: center;
}
.burger span { display: block; width: 16px; height: 1.5px; background: var(--text); border-radius: 2px; transition: all .28s; }
.burger.x span:first-child { transform: translateY(3.3px) rotate(45deg); }
.burger.x span:last-child  { transform: translateY(-3.3px) rotate(-45deg); }

.mobile {
  margin-top: .55rem;
  background: var(--nav-bg); border: 1px solid var(--nav-b);
  border-radius: 20px; padding: .7rem .9rem 1rem;
  backdrop-filter: blur(28px); -webkit-backdrop-filter: blur(28px);
}
.mob-lnk {
  display: flex; align-items: center; gap: .75rem;
  color: var(--text); text-decoration: none; font-size: .9rem; font-weight: 600;
  padding: .7rem .7rem; border-radius: 10px; transition: background .18s; cursor: pointer;
}
.mob-lnk:hover { background: rgba(255,255,255,.05); }
.mob-n { font-size: .65rem; color: var(--red); letter-spacing: .1em; min-width: 1.5rem; }
.mob-contact {
  display: flex; align-items: center; gap: .55rem;
  padding: .75rem .7rem; font-size: .85rem; font-weight: 700;
  color: var(--red); text-decoration: none;
  border-top: 1px solid var(--nav-b); margin-top: .5rem;
  border-radius: 10px; transition: background .18s;
}
.mob-contact:hover { background: var(--red-soft); }

.mob-enter-active, .mob-leave-active { transition: opacity .22s, transform .22s; }
.mob-enter-from { opacity: 0; transform: translateY(-8px); }
.mob-leave-to   { opacity: 0; transform: translateY(-8px); }

@media (max-width: 720px) {
  .links { display: none; }
  .cta   { display: none; }
  .burger { display: flex; }
}
</style>