<template>
  <div>
    <!-- Barre de progression Inertia -->
    <div class="npb" :class="{ show: active }">
      <div class="npb-bar" :style="{ width: pct + '%' }"></div>
      <div class="npb-glow"></div>
    </div>

    <!-- Transition de page (fondu) -->
    <Transition name="page-fade">
      <div v-if="transitioning" class="page-veil"></div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'

/* ── NProgress ── */
const active = ref(false)
const pct    = ref(0)
let   timer  = null

function start() {
  active.value = true
  pct.value = 0
  let n = 0
  clearInterval(timer)
  timer = setInterval(() => {
    n += Math.random() * 10 * (1 - n / 100)
    if (n > 90) n = 90
    pct.value = n
  }, 120)
}

function done() {
  clearInterval(timer)
  pct.value = 100
  setTimeout(() => { active.value = false; pct.value = 0 }, 380)
}

/* ── Transition de page (fondu) ── */
const transitioning = ref(false)

function onStart()  { start(); transitioning.value = true }
function onFinish() { done(); setTimeout(() => { transitioning.value = false }, 350) }

onMounted(() => {
  router.on('start',  onStart)
  router.on('finish', onFinish)
  router.on('error',  onFinish)
})

onUnmounted(() => clearInterval(timer))
</script>

<style scoped>
/* ── Barre NProgress ── */
.npb {
  position: fixed; top: 0; left: 0; right: 0;
  height: 2px; z-index: 9999; pointer-events: none;
  opacity: 0; transition: opacity .2s;
}
.npb.show { opacity: 1; }
.npb-bar {
  height: 100%;
  background: linear-gradient(90deg, #E53E3E, #FC8181);
  transition: width .14s linear;
  border-radius: 0 1px 1px 0;
}
.npb-glow {
  position: absolute; top: -2px; right: 0;
  width: 60px; height: 6px;
  background: radial-gradient(ellipse at right, rgba(229,62,62,.75), transparent 70%);
  filter: blur(3px);
}

/* ── Voile de transition de page ── */
.page-veil {
  position: fixed; inset: 0; z-index: 8000;
  background: var(--bg, #0A0A0A);
  pointer-events: none;
}

.page-fade-enter-active { transition: opacity 0.18s ease; }
.page-fade-leave-active { transition: opacity 0.28s ease; }
.page-fade-enter-from   { opacity: 0.7; }
.page-fade-leave-to     { opacity: 0; }
</style>