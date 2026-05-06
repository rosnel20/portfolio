<template>
  <nav class="nav" :class="[dark ? 'dark' : 'light', { scrolled }]" role="navigation" aria-label="Main navigation">
    <div class="nav-inner">

      <!-- Logo -->
      <Link href="/" class="nav-logo" aria-label="Rosnel Pacely — Home">
        <span class="logo-r">R</span>
        <span class="logo-name">osnel<span class="logo-dot">.</span></span>
      </Link>

      <!-- Desktop links -->
      <ul class="nav-links" role="list">
        <li v-for="item in links" :key="item.href">
          <Link
            :href="item.href"
            class="nav-link"
            :class="{ active: isActive(item.href) }"
          >{{ item.label }}</Link>
        </li>
      </ul>

      <!-- Actions -->
      <div class="nav-actions">
        <!-- Theme toggle -->
        <button
          class="nav-theme"
          :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
          @click="$emit('toggle-theme')"
        >
          <svg v-if="dark" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1"  x2="12" y2="3"/>
            <line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22"  x2="5.64" y2="5.64"/>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1"  y1="12" x2="3"  y2="12"/>
            <line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22"  y1="19.78" x2="5.64"  y2="18.36"/>
            <line x1="18.36" y1="5.64"  x2="19.78" y2="4.22"/>
          </svg>
          <svg v-else width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
        </button>

        <!-- CTA -->
        <Link href="/contact" class="nav-cta">
          Hire me
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <line x1="5" y1="12" x2="19" y2="12"/>
            <polyline points="12 5 19 12 12 19"/>
          </svg>
        </Link>

        <!-- Burger mobile -->
        <button
          class="nav-burger"
          :class="{ open: menuOpen }"
          :aria-expanded="menuOpen.toString()"
          aria-label="Toggle menu"
          @click="menuOpen = !menuOpen"
        >
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>

    <!-- Mobile menu -->
    <Transition name="menu">
      <div v-if="menuOpen" class="nav-mobile" role="dialog" aria-modal="true" aria-label="Mobile navigation">
        <ul role="list">
          <li v-for="item in links" :key="item.href">
            <Link
              :href="item.href"
              class="nm-link"
              :class="{ active: isActive(item.href) }"
              @click="menuOpen = false"
            >
              {{ item.label }}
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </Link>
          </li>
        </ul>
        <Link href="/contact" class="nm-cta" @click="menuOpen = false">
          Hire me →
        </Link>
        <div class="nm-locale">
          <span>🇫🇷 FR</span>
          <span class="nm-sep">·</span>
          <span>🇬🇧 EN</span>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'

defineProps({ dark: Boolean })
defineEmits(['toggle-theme'])

const menuOpen    = ref(false)
const scrolled    = ref(false)
const currentPath = ref('/')

const links = [
  { href: '/',        label: 'Home' },
  { href: '/about',   label: 'About' },
  { href: '/blog',    label: 'Blog' },
  { href: '/contact', label: 'Contact' },
]

function isActive(href) {
  if (href === '/') return currentPath.value === '/'
  return currentPath.value.startsWith(href)
}

function onScroll() { scrolled.value = window.scrollY > 40 }

onMounted(() => {
  currentPath.value = window.location.pathname
  window.addEventListener('scroll', onScroll, { passive: true })
})
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<style scoped>
.nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
  font-family: 'Outfit', sans-serif;
  transition: background .3s, border-color .3s, backdrop-filter .3s;
  border-bottom: 1px solid transparent;
}
.nav.dark  { --bg: rgba(12,12,12,.0);  --text: #F0F0F0; --muted: #555; --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08); --red: #E53E3E; --mob-bg: #0E0E0E; }
.nav.light { --bg: rgba(248,248,248,.0); --text: #0A0A0A; --muted: #999; --card: rgba(0,0,0,.04); --card-b: rgba(0,0,0,.09); --red: #C53030; --mob-bg: #F5F5F5; }

.nav.scrolled {
  background: var(--bg);
  backdrop-filter: blur(18px) saturate(160%);
  -webkit-backdrop-filter: blur(18px) saturate(160%);
  border-bottom-color: var(--card-b);
}
.nav.dark.scrolled  { --bg: rgba(10,10,10,.88); }
.nav.light.scrolled { --bg: rgba(248,248,248,.92); }

.nav-inner {
  display: flex; align-items: center; justify-content: space-between;
  max-width: 1200px; margin: 0 auto;
  padding: .9rem 5vw;
  gap: 1rem;
}

.nav-logo {
  display: flex; align-items: baseline;
  text-decoration: none; font-weight: 900; font-size: 1.1rem;
  letter-spacing: -.04em; color: var(--text); flex-shrink: 0;
}
.logo-r, .logo-dot { color: var(--red); }

.nav-links {
  display: flex; align-items: center; gap: .2rem;
  list-style: none; margin: 0; padding: 0;
}
.nav-link {
  font-size: .84rem; font-weight: 500; color: var(--muted);
  text-decoration: none; padding: .4rem .75rem; border-radius: 8px;
  transition: color .2s, background .2s; white-space: nowrap;
}
.nav-link:hover { color: var(--text); background: var(--card); }
.nav-link.active { color: var(--red); background: var(--card); }

.nav-actions { display: flex; align-items: center; gap: .6rem; }

.nav-theme {
  width: 36px; height: 36px; border-radius: 9px;
  background: var(--card); border: 1px solid var(--card-b);
  color: var(--text); display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: background .2s, border-color .2s; flex-shrink: 0;
}
.nav-theme:hover { border-color: var(--red); background: rgba(229,62,62,.08); }

.nav-cta {
  display: inline-flex; align-items: center; gap: .4rem;
  background: var(--red); color: #fff;
  padding: .48rem 1.05rem; border-radius: 8px;
  font-size: .82rem; font-weight: 700; text-decoration: none; white-space: nowrap;
  box-shadow: 0 3px 12px rgba(229,62,62,.22);
  transition: opacity .2s, transform .2s;
}
.nav-cta:hover { opacity: .88; transform: translateY(-1px); }

.nav-burger {
  display: none; flex-direction: column; justify-content: center;
  gap: 5px; width: 36px; height: 36px; padding: 6px;
  background: var(--card); border: 1px solid var(--card-b);
  border-radius: 9px; cursor: pointer;
}
.nav-burger span {
  display: block; height: 1.5px; background: var(--text);
  border-radius: 2px; transition: transform .3s, opacity .3s;
  transform-origin: center;
}
.nav-burger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.nav-burger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-burger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

.nav-mobile {
  background: var(--mob-bg);
  border-top: 1px solid var(--card-b);
  padding: 1rem 5vw 1.4rem;
}
.nav-mobile ul { list-style: none; padding: 0; margin: 0 0 1rem; }
.nm-link {
  display: flex; align-items: center; justify-content: space-between;
  padding: .72rem .4rem; color: var(--muted); text-decoration: none;
  font-size: .92rem; font-weight: 500;
  border-bottom: 1px solid var(--card-b); transition: color .2s;
}
.nm-link:hover, .nm-link.active { color: var(--text); }
.nm-link.active { color: var(--red); }
.nm-cta {
  display: block; text-align: center; background: var(--red); color: #fff;
  padding: .82rem; border-radius: 10px; font-weight: 700; font-size: .9rem;
  text-decoration: none; margin-bottom: .9rem;
}
.nm-locale { display: flex; align-items: center; justify-content: center; gap: .5rem; font-size: .75rem; color: var(--muted); }
.nm-sep { opacity: .4; }

.menu-enter-active, .menu-leave-active { transition: opacity .22s, transform .22s; }
.menu-enter-from, .menu-leave-to { opacity: 0; transform: translateY(-8px); }

@media (max-width: 768px) {
  .nav-links, .nav-cta { display: none; }
  .nav-burger { display: flex; }
}
@media (max-width: 400px) {
  .nav-inner { padding: .8rem 4vw; }
}
</style>