<template>
  <div class="cpage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />
    <AppCursor />

    <main>
      <section class="contact-hero">
        <div class="ch-bg">
          <div class="orb o1"></div>
          <div class="orb o2"></div>
          <div class="ch-grid"></div>
        </div>

        <div class="ch-inner">
          <!-- ── Colonne gauche ── -->
          <div class="ch-left reveal">
            <div class="sec-label">Contact</div>
            <h1 class="ch-h1">Let's build<br><em>together</em></h1>
            <p class="ch-lead">
              Open to freelance missions, remote full-time positions and open collaborations — worldwide.
              I reply within <strong>24 hours</strong>.
            </p>

            <!-- Availability badge -->
            <div class="avail-block reveal" data-delay="80">
              <span class="ab-dot"></span>
              <div>
                <div class="ab-title">Available · Remote · <strong>2026</strong></div>
                <div class="ab-sub">Freelance &amp; Full-time · Africa · Europe · Worldwide</div>
              </div>
            </div>

            <!-- Infos de contact -->
            <div class="ci-list">
              <a href="mailto:mrrosnel6@gmail.com" class="ci-item reveal" data-delay="120">
                <div class="ci-ico">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div>
                  <div class="ci-label">Email</div>
                  <div class="ci-val">mrrosnel6@gmail.com</div>
                </div>
              </a>
              <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener" class="ci-item reveal" data-delay="160">
                <div class="ci-ico">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </div>
                <div>
                  <div class="ci-label">LinkedIn</div>
                  <div class="ci-val">linkedin.com/in/rosneldev</div>
                </div>
              </a>
              <a href="https://github.com/rosnel20" target="_blank" rel="noopener" class="ci-item reveal" data-delay="200">
                <div class="ci-ico">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
                </div>
                <div>
                  <div class="ci-label">GitHub</div>
                  <div class="ci-val">github.com/rosnel20</div>
                </div>
              </a>
            </div>

            <!-- Langues -->
            <div class="lang-block reveal" data-delay="240">
              <div class="lb-label">Languages / Langues</div>
              <div class="lb-items">
                <div class="lb-item"><span class="lb-flag">🇫🇷</span> French — Native</div>
                <div class="lb-item"><span class="lb-flag">🇬🇧</span> English — Professional</div>
              </div>
            </div>
          </div>

          <!-- ── Colonne droite : formulaire ── -->
          <div class="ch-right">
            <!-- Succès -->
            <Transition name="fade">
              <div v-if="success" class="form-success">
                <div class="fs-ico">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h3>Message sent!</h3>
                <p>Thank you <strong>{{ lastName }}</strong>. I'll reply within 24 hours.</p>
                <button class="fs-btn" @click="success = false">Send another message</button>
              </div>
            </Transition>

            <form v-if="!success" class="cform reveal" data-delay="60" @submit.prevent="submit">
              <div class="cf-head">
                <h2>Send me a message</h2>
                <p>Freelance · Mission · Job opportunity · Collaboration</p>
              </div>

              <!-- Erreur globale -->
              <div v-if="errors.global" class="cf-error-global">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ errors.global }}
              </div>

              <div class="cf-row">
                <div class="cf-field" :class="{ error: errors.name }">
                  <label>Full name *</label>
                  <input v-model="form.name" type="text" placeholder="Jane Smith" autocomplete="name" @input="clearError('name')"/>
                  <span v-if="errors.name" class="cf-err">{{ errors.name }}</span>
                </div>
                <div class="cf-field" :class="{ error: errors.email }">
                  <label>Email address *</label>
                  <input v-model="form.email" type="email" placeholder="jane@company.com" autocomplete="email" @input="clearError('email')"/>
                  <span v-if="errors.email" class="cf-err">{{ errors.email }}</span>
                </div>
              </div>

              <div class="cf-field" :class="{ error: errors.subject }">
                <label>Subject *</label>
                <input v-model="form.subject" type="text" placeholder="Laravel project · Remote mission · Job offer…" @input="clearError('subject')"/>
                <span v-if="errors.subject" class="cf-err">{{ errors.subject }}</span>
              </div>

              <div class="cf-field">
                <label>Budget / Rate (optional)</label>
                <select v-model="form.budget">
                  <option value="">Not specified</option>
                  <option>< 500 000 FCFA / < 800 €</option>
                  <option>500 000 – 1 500 000 FCFA / 800 – 2 500 €</option>
                  <option>1 500 000 – 5 000 000 FCFA / 2 500 – 8 000 €</option>
                  <option>> 5 000 000 FCFA / > 8 000 €</option>
                  <option>To discuss / À définir</option>
                </select>
              </div>

              <div class="cf-field" :class="{ error: errors.message }">
                <label>
                  Message *
                  <span class="cf-count" :class="{ warn: form.message.length > 1800 }">{{ form.message.length }}/2000</span>
                </label>
                <textarea
                  v-model="form.message"
                  rows="6"
                  placeholder="Tell me about your project, your stack, your timeline, your location…"
                  maxlength="2000"
                  @input="clearError('message')"
                ></textarea>
                <span v-if="errors.message" class="cf-err">{{ errors.message }}</span>
              </div>

              <button class="cf-submit" type="submit" :disabled="loading">
                <span v-if="!loading">
                  Send message
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
                <span v-else class="cf-spin">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-dashoffset="8"/></svg>
                  Sending…
                </span>
              </button>

              <p class="cf-note">* Required fields. No spam, no newsletter — your data is used only to respond to your message.</p>
            </form>
          </div>
        </div>
      </section>

      <AppFooter />
    </main>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'
import AppCursor from '../Components/AppCursor.vue'
import { useTheme }        from '../Composables/useTheme'
import { useScrollReveal } from '../Composables/useScrollReveal'

const { theme, toggleTheme } = useTheme()
useScrollReveal()

/* ── État formulaire ── */
const loading  = ref(false)
const success  = ref(false)
const lastName = ref('')
const errors   = reactive({})

const form = reactive({
  name: '', email: '', subject: '', budget: '', message: '',
})

function clearError(field) {
  delete errors[field]
  delete errors.global
}

function validate() {
  Object.keys(errors).forEach(k => delete errors[k])
  let ok = true
  if (!form.name.trim())                          { errors.name    = 'Name is required.'; ok = false }
  if (!form.email.trim())                         { errors.email   = 'Email is required.'; ok = false }
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) { errors.email = 'Invalid email address.'; ok = false }
  if (!form.subject.trim())                       { errors.subject = 'Subject is required.'; ok = false }
  if (form.message.trim().length < 10)            { errors.message = 'Message must be at least 10 characters.'; ok = false }
  return ok
}

function submit() {
  if (!validate()) return
  loading.value = true

  router.post('/contact', { ...form }, {
    preserveScroll: true,
    onSuccess: () => {
      lastName.value = form.name.split(' ')[0]
      success.value  = true
      loading.value  = false
      Object.assign(form, { name: '', email: '', subject: '', budget: '', message: '' })
    },
    onError: (errs) => {
      loading.value = false
      Object.assign(errors, errs)
    },
  })
}
</script>

<style scoped>
/* Thème */
.cpage.dark {
  --bg: #0A0A0A; --bg2: #111111;
  --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text: #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg: rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red: #E53E3E; --red-soft: rgba(229,62,62,.1);
  --input-bg: rgba(255,255,255,.04); --input-b: rgba(255,255,255,.08);
}
.cpage.light {
  --bg: #F8F8F8; --bg2: #FFFFFF;
  --card: rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text: #0A0A0A; --muted: #888; --muted2: #999;
  --nav-bg: rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red: #C53030; --red-soft: rgba(197,48,48,.08);
  --input-bg: rgba(0,0,0,.03); --input-b: rgba(0,0,0,.1);
}
* { box-sizing: border-box; margin: 0; padding: 0; }
.cpage { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; transition: background .4s, color .4s; }

.sec-label { font-family: 'JetBrains Mono', monospace; font-size: .67rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1rem; display: flex; align-items: center; gap: .6rem; }
.sec-label::before { content: ''; display: block; width: 18px; height: 1px; background: var(--red); }

/* Hero */
.contact-hero { position: relative; min-height: 100vh; padding: 7rem 5vw 5rem; overflow: hidden; }
.ch-bg { position: absolute; inset: 0; pointer-events: none; }
.orb   { position: absolute; border-radius: 50%; filter: blur(100px); }
.o1    { width: 480px; height: 480px; background: var(--red); opacity: .06; top: -100px; right: -60px; animation: orb 12s ease-in-out infinite; }
.o2    { width: 360px; height: 360px; background: #3B82F6; opacity: .04; bottom: -40px; left: 3%; animation: orb 18s ease-in-out infinite reverse; }
@keyframes orb { 0%,100%{transform:translate(0,0)} 50%{transform:translate(24px,-18px)} }
.ch-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,.022) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.022) 1px,transparent 1px); background-size: 50px 50px; -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%,black 30%,transparent); mask-image: radial-gradient(ellipse 70% 70% at 50% 50%,black 30%,transparent); }

.ch-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1.15fr; gap: 5rem; max-width: 1200px; margin: 0 auto; align-items: start; padding-top: 2rem; }

/* Colonne gauche */
.ch-h1 { font-size: clamp(2.4rem, 5.5vw, 4.8rem); font-weight: 900; line-height: .95; letter-spacing: -.06em; margin-bottom: 1.4rem; color: var(--text); }
.ch-h1 em { font-style: italic; color: var(--red); }
.ch-lead { font-size: .95rem; color: var(--muted2); line-height: 1.85; margin-bottom: 2rem; max-width: 420px; }
.ch-lead strong { color: var(--text); }

.avail-block { display: flex; align-items: center; gap: .9rem; background: rgba(229,62,62,.07); border: 1px solid rgba(229,62,62,.2); padding: .85rem 1.1rem; border-radius: 14px; margin-bottom: 2.2rem; }
.ab-dot  { width: 9px; height: 9px; border-radius: 50%; background: #4ADE80; animation: bl 2s infinite; flex-shrink: 0; }
@keyframes bl { 0%,100%{opacity:1} 50%{opacity:.35} }
.ab-title { font-size: .84rem; font-weight: 700; color: var(--text); }
.ab-title strong { color: var(--red); }
.ab-sub   { font-size: .74rem; color: var(--muted); margin-top: .2rem; }

.ci-list  { display: flex; flex-direction: column; gap: .6rem; margin-bottom: 2rem; }
.ci-item  { display: flex; align-items: center; gap: .9rem; background: var(--card); border: 1px solid var(--card-b); padding: .75rem 1rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: border-color .2s, background .2s; }
.ci-ico   { width: 36px; height: 36px; border-radius: 9px; background: var(--red-soft); border: 1px solid rgba(229,62,62,.15); color: var(--red); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.ci-label { font-size: .62rem; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; font-family: 'JetBrains Mono', monospace; margin-bottom: .2rem; }
.ci-val   { font-size: .83rem; font-weight: 600; }

.lang-block { background: var(--card); border: 1px solid var(--card-b); border-radius: 12px; padding: 1rem 1.1rem; }
.lb-label   { font-size: .62rem; color: var(--muted); text-transform: uppercase; letter-spacing: .14em; font-family: 'JetBrains Mono', monospace; margin-bottom: .7rem; }
.lb-items   { display: flex; gap: 1.2rem; flex-wrap: wrap; }
.lb-item    { display: flex; align-items: center; gap: .4rem; font-size: .82rem; color: var(--muted2); }
.lb-flag    { font-size: 1rem; }

/* Formulaire */
.cform { background: var(--card); border: 1px solid var(--card-b); border-radius: 20px; padding: 2rem 2.2rem; }
.cf-head { margin-bottom: 1.8rem; }
.cf-head h2 { font-size: 1.18rem; font-weight: 800; color: var(--text); letter-spacing: -.03em; margin-bottom: .3rem; }
.cf-head p  { font-size: .78rem; color: var(--muted); }

.cf-error-global { display: flex; align-items: center; gap: .5rem; background: rgba(229,62,62,.1); border: 1px solid rgba(229,62,62,.25); color: #E53E3E; padding: .7rem 1rem; border-radius: 10px; font-size: .82rem; margin-bottom: 1.2rem; }

.cf-row { display: grid; grid-template-columns: 1fr 1fr; gap: .9rem; }
.cf-field { display: flex; flex-direction: column; gap: .4rem; margin-bottom: .9rem; }
.cf-field label { font-size: .72rem; font-weight: 600; color: var(--muted2); display: flex; align-items: center; justify-content: space-between; letter-spacing: .03em; }
.cf-count { font-family: 'JetBrains Mono', monospace; font-size: .66rem; color: var(--muted); }
.cf-count.warn { color: #F59E0B; }
.cf-field input, .cf-field textarea, .cf-field select {
  background: var(--input-bg); border: 1px solid var(--input-b);
  color: var(--text); padding: .72rem .95rem; border-radius: 10px;
  font-size: .88rem; font-family: 'Outfit', sans-serif;
  transition: border-color .2s, box-shadow .2s; outline: none;
  width: 100%; appearance: none;
}
.cf-field input::placeholder,
.cf-field textarea::placeholder { color: var(--muted); }
.cf-field input:focus,
.cf-field textarea:focus,
.cf-field select:focus {
  border-color: rgba(229,62,62,.5);
  box-shadow: 0 0 0 3px rgba(229,62,62,.08);
}
.cf-field.error input, .cf-field.error textarea { border-color: rgba(229,62,62,.55); }
.cf-err { font-size: .72rem; color: var(--red); }
.cf-field textarea { resize: vertical; min-height: 130px; line-height: 1.65; }
.cf-field select { cursor: pointer; }

.cf-submit {
  width: 100%; display: flex; align-items: center; justify-content: center; gap: .55rem;
  background: var(--red); color: #fff;
  padding: .92rem 1.8rem; border-radius: 12px;
  font-size: .9rem; font-weight: 700; font-family: 'Outfit', sans-serif;
  border: none; cursor: pointer; margin-top: .4rem;
  box-shadow: 0 6px 20px rgba(229,62,62,.25);
  transition: opacity .2s, transform .2s;
}
.cf-submit:hover:not(:disabled) { opacity: .9; transform: translateY(-1px); }
.cf-submit:disabled { opacity: .6; cursor: not-allowed; }
.cf-spin { display: flex; align-items: center; gap: .5rem; }
.cf-spin svg { animation: spin 1s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

.cf-note { font-size: .68rem; color: var(--muted); text-align: center; margin-top: .9rem; line-height: 1.6; }

/* Succès */
.form-success { background: var(--card); border: 1px solid rgba(74,222,128,.2); border-radius: 20px; padding: 3rem 2rem; text-align: center; }
.fs-ico { width: 60px; height: 60px; border-radius: 50%; background: rgba(74,222,128,.12); border: 1px solid rgba(74,222,128,.25); color: #4ADE80; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; }
.form-success h3 { font-size: 1.3rem; font-weight: 800; color: var(--text); margin-bottom: .5rem; }
.form-success p  { font-size: .88rem; color: var(--muted2); margin-bottom: 1.5rem; line-height: 1.7; }
.fs-btn { background: var(--card); border: 1px solid var(--card-b); color: var(--muted2); padding: .6rem 1.4rem; border-radius: 8px; font-size: .82rem; font-family: 'Outfit', sans-serif; cursor: pointer; transition: border-color .2s, color .2s; }
.fs-btn:hover { border-color: var(--red); color: var(--red); }

/* Transitions */
.fade-enter-active, .fade-leave-active { transition: opacity .3s, transform .3s; }
.fade-enter-from, .fade-leave-to { opacity: 0; transform: translateY(10px); }

/* Hover */
@media (hover: hover) and (pointer: fine) {
  .ci-item:hover { border-color: rgba(229,62,62,.25); background: var(--red-soft); }
}

/* Responsive */
@media (max-width: 900px) {
  .ch-inner { grid-template-columns: 1fr; gap: 2.5rem; }
  .ch-lead  { max-width: 100%; }
}
@media (max-width: 640px) {
  .contact-hero { padding: 5.5rem 5vw 4rem; }
  .cform        { padding: 1.4rem 1.3rem; }
  .cf-row       { grid-template-columns: 1fr; }
  .ch-h1        { font-size: clamp(2rem, 9vw, 3rem); }
}
@media (max-width: 400px) {
  .contact-hero { padding: 5rem 4vw 3.5rem; }
  .avail-block  { flex-direction: column; align-items: flex-start; gap: .6rem; }
  .lb-items     { flex-direction: column; gap: .5rem; }
}
</style>
