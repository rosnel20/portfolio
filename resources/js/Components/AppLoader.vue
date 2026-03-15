<template>
  <div class="npb" :class="{ show: active }">
    <div class="npb-bar" :style="{ width: pct + '%' }"></div>
    <div class="npb-glow"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'

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

onMounted(() => {
  router.on('start',  start)
  router.on('finish', done)
  router.on('error',  done)
})
onUnmounted(() => clearInterval(timer))
</script>

<style scoped>
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
</style>