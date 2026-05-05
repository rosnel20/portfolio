<template>
  <Teleport to="body">
    <Transition name="cv-modal">
      <div v-if="modelValue" class="cvm-backdrop" @click.self="close" @keydown.esc="close">

        <!-- ══ PANEL ══ -->
        <div class="cvm-panel" role="dialog" aria-modal="true" aria-label="CV — Rosnel Pacely">

          <!-- HEADER -->
          <div class="cvm-header">
            <div class="cvm-header-left">
              <div class="cvm-dot-row">
                <span class="cvm-dot d-red"   @click="close"></span>
                <span class="cvm-dot d-amber"></span>
                <span class="cvm-dot d-green"></span>
              </div>
              <div class="cvm-title">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                cv-rosnel-pacely.pdf
              </div>
            </div>
            <div class="cvm-header-right">
              <button class="cvm-btn-dl" @click="download">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Télécharger
              </button>
              <button class="cvm-btn-close" @click="close" aria-label="Fermer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </div>
          </div>

          <!-- BODY : visionneuse PDF -->
          <div class="cvm-body">

            <!-- État chargement -->
            <Transition name="fade">
              <div v-if="loading" class="cvm-loading">
                <div class="cvm-spinner">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </div>
                <span>Chargement du CV…</span>
              </div>
            </Transition>

            <!-- État erreur (CV absent) -->
            <Transition name="fade">
              <div v-if="!loading && error" class="cvm-error">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
                <p>Le CV n'est pas encore disponible.</p>
                <span>Il sera mis en ligne très prochainement.</span>
              </div>
            </Transition>

            <!-- iframe PDF (méthode principale) -->
            <iframe
              v-show="!loading && !error && iframeMethod"
              ref="iframeRef"
              :src="pdfSrc + '#toolbar=0&navpanes=0&scrollbar=1&view=FitH'"
              class="cvm-iframe"
              title="CV Rosnel Pacely"
              @load="onIframeLoad"
              @error="onIframeError"
            ></iframe>

            <!-- Fallback : embed (Safari / Firefox) -->
            <embed
              v-show="!loading && !error && !iframeMethod"
              :src="pdfSrc"
              type="application/pdf"
              class="cvm-iframe"
            />

          </div>

          <!-- FOOTER -->
          <div class="cvm-footer" v-if="!loading && !error">
            <span class="cvm-footer-hint">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              Utilisez la molette pour zoomer · Appuyez sur Échap pour fermer
            </span>
            <button class="cvm-btn-dl cvm-btn-dl--footer" @click="download">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Télécharger le CV
            </button>
          </div>

        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  modelValue: { type: Boolean, default: false },
  pdfPath:    { type: String, default: '/cv-rosnel-pacely.pdf' },
  filename:   { type: String, default: 'CV-Rosnel-Pacely.pdf' },
})
const emit = defineEmits(['update:modelValue'])

const loading     = ref(true)
const error       = ref(false)
const iframeMethod = ref(true)
const iframeRef   = ref(null)
const pdfSrc      = ref('')

/* ── Ouvre / ferme ── */
function close() { emit('update:modelValue', false) }

/* ── Vérifie la présence du PDF puis initialise ── */
async function initPdf() {
  loading.value = true
  error.value   = false
  try {
    const r = await fetch(props.pdfPath, { method: 'HEAD' })
    if (!r.ok) throw new Error('not found')
    pdfSrc.value = props.pdfPath + '?v=' + Date.now()
    // Petit délai pour que l'iframe apparaisse proprement
    setTimeout(() => { loading.value = false }, 400)
  } catch {
    loading.value = false
    error.value   = true
  }
}

function onIframeLoad()  { loading.value = false }
function onIframeError() { iframeMethod.value = false }

/* ── Téléchargement forcé ── */
function download() {
  const a = document.createElement('a')
  a.href     = props.pdfPath
  a.download = props.filename
  document.body.appendChild(a)
  a.click()
  document.body.removeChild(a)
}

/* ── Watch ouverture ── */
watch(() => props.modelValue, (v) => {
  if (v) {
    initPdf()
    document.body.style.overflow = 'hidden'
  } else {
    document.body.style.overflow = ''
    // Reset pour la prochaine ouverture
    setTimeout(() => {
      loading.value      = true
      error.value        = false
      iframeMethod.value = true
      pdfSrc.value       = ''
    }, 350)
  }
})

/* ── Escape global ── */
function onKey(e) { if (e.key === 'Escape' && props.modelValue) close() }
onMounted(() => document.addEventListener('keydown', onKey))
onUnmounted(() => {
  document.removeEventListener('keydown', onKey)
  document.body.style.overflow = ''
})
</script>

<style scoped>
/* ══ BACKDROP ══ */
.cvm-backdrop {
  position: fixed; inset: 0; z-index: 9000;
  background: rgba(0, 0, 0, .82);
  backdrop-filter: blur(8px);
  display: flex; align-items: center; justify-content: center;
  padding: 1.5rem;
}

/* ══ PANEL ══ */
.cvm-panel {
  width: 100%; max-width: 860px;
  height: min(92vh, 1000px);
  background: #111;
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 18px;
  display: flex; flex-direction: column;
  overflow: hidden;
  box-shadow: 0 32px 80px rgba(0,0,0,.7), 0 0 0 1px rgba(255,255,255,.05);
}

/* ══ HEADER ══ */
.cvm-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: .75rem 1.1rem .75rem 1rem;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: #161616;
  flex-shrink: 0;
  gap: 1rem;
}
.cvm-header-left  { display: flex; align-items: center; gap: 1rem; min-width: 0; }
.cvm-header-right { display: flex; align-items: center; gap: .55rem; flex-shrink: 0; }

/* macOS-style dots */
.cvm-dot-row { display: flex; gap: 6px; flex-shrink: 0; }
.cvm-dot {
  width: 12px; height: 12px; border-radius: 50%; cursor: pointer;
  transition: opacity .15s, filter .15s;
}
.d-red   { background: #FF5F57; }
.d-amber { background: #FEBC2E; cursor: default; }
.d-green { background: #28C840; cursor: default; }
.cvm-dot:hover { filter: brightness(1.15); }

.cvm-title {
  display: flex; align-items: center; gap: .45rem;
  font-family: 'JetBrains Mono', monospace;
  font-size: .72rem; color: rgba(255,255,255,.45);
  letter-spacing: .04em;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

/* Bouton télécharger header */
.cvm-btn-dl {
  display: inline-flex; align-items: center; gap: .42rem;
  background: #E53E3E; color: #fff;
  border: none; cursor: pointer;
  padding: .44rem 1rem; border-radius: 8px;
  font-size: .78rem; font-weight: 700;
  font-family: inherit;
  transition: opacity .2s, transform .15s;
  white-space: nowrap;
  box-shadow: 0 3px 12px rgba(229,62,62,.3);
}
.cvm-btn-dl:hover { opacity: .88; transform: translateY(-1px); }
.cvm-btn-dl:active { transform: translateY(0); }

/* Bouton fermer */
.cvm-btn-close {
  display: flex; align-items: center; justify-content: center;
  width: 30px; height: 30px; border-radius: 8px;
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.08);
  color: rgba(255,255,255,.5); cursor: pointer;
  transition: background .15s, color .15s;
  flex-shrink: 0;
}
.cvm-btn-close:hover { background: rgba(255,255,255,.12); color: #fff; }

/* ══ BODY ══ */
.cvm-body {
  flex: 1; position: relative; overflow: hidden;
  background: #1a1a1a;
}

/* iframe PDF */
.cvm-iframe {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  border: none; display: block;
  background: #fff;
}

/* Chargement */
.cvm-loading {
  position: absolute; inset: 0;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  gap: 1rem; color: rgba(255,255,255,.4);
  font-size: .83rem; letter-spacing: .03em;
  background: #1a1a1a; z-index: 2;
}
.cvm-spinner svg {
  animation: spin 1s linear infinite;
  color: #E53E3E;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* Erreur */
.cvm-error {
  position: absolute; inset: 0;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  gap: .6rem; color: rgba(255,255,255,.3);
  background: #1a1a1a; z-index: 2; text-align: center;
  padding: 2rem;
}
.cvm-error svg  { color: rgba(255,255,255,.15); margin-bottom: .4rem; }
.cvm-error p    { font-size: .95rem; font-weight: 600; color: rgba(255,255,255,.55); }
.cvm-error span { font-size: .78rem; }

/* ══ FOOTER ══ */
.cvm-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding: .6rem 1.1rem;
  border-top: 1px solid rgba(255,255,255,.07);
  background: #161616;
  flex-shrink: 0; gap: 1rem; flex-wrap: wrap;
}
.cvm-footer-hint {
  display: flex; align-items: center; gap: .4rem;
  font-family: 'JetBrains Mono', monospace;
  font-size: .62rem; color: rgba(255,255,255,.2);
  letter-spacing: .04em;
}
.cvm-btn-dl--footer {
  background: transparent;
  border: 1px solid rgba(229,62,62,.35);
  color: #E53E3E;
  box-shadow: none;
  font-size: .76rem; padding: .36rem .85rem;
}
.cvm-btn-dl--footer:hover { background: rgba(229,62,62,.1); opacity: 1; }

/* ══ TRANSITIONS ══ */
.cv-modal-enter-active { transition: opacity .28s ease, transform .28s cubic-bezier(.22,.68,0,1.2); }
.cv-modal-leave-active { transition: opacity .22s ease, transform .22s ease; }
.cv-modal-enter-from  { opacity: 0; }
.cv-modal-leave-to    { opacity: 0; }
.cv-modal-enter-from .cvm-panel { transform: scale(.94) translateY(12px); }
.cv-modal-leave-to   .cvm-panel { transform: scale(.96) translateY(8px); }

.fade-enter-active, .fade-leave-active { transition: opacity .2s; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

/* ══ RESPONSIVE ══ */
@media (max-width: 600px) {
  .cvm-backdrop { padding: 0; }
  .cvm-panel    { border-radius: 0; height: 100dvh; max-width: 100%; border: none; }
  .cvm-footer-hint { display: none; }
  .cvm-btn-dl--footer { margin-left: auto; }
}
@media (max-width: 400px) {
  .cvm-title    { display: none; }
  .cvm-btn-dl   { font-size: .72rem; padding: .38rem .8rem; }
}
</style>
