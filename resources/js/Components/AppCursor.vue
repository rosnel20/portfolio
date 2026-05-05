<template>
  <div v-if="visible" class="cursor-dot" :style="{ left: x + 'px', top: y + 'px', transform: `translate(-50%, -50%) scale(${clicking ? 0.6 : hovering ? 2.2 : 1})`, opacity: hovering ? 0.5 : 1 }"></div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const x        = ref(0)
const y        = ref(0)
const clicking = ref(false)
const hovering = ref(false)
const visible  = ref(false)

function onMove(e) {
  x.value = e.clientX
  y.value = e.clientY
  if (!visible.value) visible.value = true
}
function onDown()   { clicking.value = true  }
function onUp()     { clicking.value = false }
function onOver(e)  { hovering.value = !!(e.target.closest('a, button, [role=button], .pc, .oc, .feat-card, .tl-card')) }

onMounted(() => {
  window.addEventListener('mousemove', onMove, { passive: true })
  window.addEventListener('mousedown', onDown)
  window.addEventListener('mouseup',   onUp)
  window.addEventListener('mouseover', onOver)
})
onUnmounted(() => {
  window.removeEventListener('mousemove', onMove)
  window.removeEventListener('mousedown', onDown)
  window.removeEventListener('mouseup',   onUp)
  window.removeEventListener('mouseover', onOver)
})
</script>

<style scoped>
.cursor-dot {
  position: fixed;
  width: 8px;
  height: 8px;
  background: #E53E3E;
  border-radius: 50%;
  pointer-events: none;
  z-index: 99999;
  transition: transform 0.15s ease, opacity 0.15s ease;
  mix-blend-mode: difference;
}

/* Masqué sur mobile / touch */
@media (hover: none) {
  .cursor-dot { display: none; }
}
</style>
