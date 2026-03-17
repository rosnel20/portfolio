<template>
  <div class="bppage" :class="theme">
    <AppNav :dark="theme==='dark'" @toggle-theme="toggleTheme" />
    <NProgress />

    <main>
      <!-- HERO -->
      <section class="bph">
        <div class="bph-img-wrap" v-if="post.image">
          <img :src="post.image" :alt="post.title" class="bph-bg-img"/>
          <div class="bph-img-overlay"></div>
        </div>
        <div v-else class="bph-bg">
          <div class="bph-grid"></div>
          <div class="bph-orb" :style="{ background: post.color }"></div>
        </div>

        <div class="bph-inner" :class="{ 'has-image': post.image }">
          <div class="bph-crumb">
            <Link href="/" class="bphc-link">Accueil</Link>
            <span class="bphc-sep">/</span>
            <Link href="/blog" class="bphc-link">Blog</Link>
            <span class="bphc-sep">/</span>
            <span class="bphc-cur">{{ post.category }}</span>
          </div>
          <div class="bph-meta">
            <span class="bph-cat" :style="{ color: post.color, background: post.color+'22', borderColor: post.color+'44' }">
              {{ post.category }}
            </span>
            <span class="bph-date">{{ post.date }}</span>
            <span class="bph-time">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              {{ post.readTime }} min de lecture
            </span>
          </div>
          <h1 class="bph-title">{{ post.title }}</h1>
          <p  class="bph-lead">{{ post.lead }}</p>
          <div class="bph-author">
            <div class="bpha-avatar" :style="{ background: post.color }">R</div>
            <div>
              <div class="bpha-name">Rosnel Pacely</div>
              <div class="bpha-role">Ingénieur Informaticien · Full-Stack Developer</div>
            </div>
          </div>
        </div>
      </section>

      <!-- CORPS -->
      <div class="bpc">
        <div class="bpc-inner">

          <article class="bpc-article">

            <div v-if="post.toc && post.toc.length" class="bpa-toc">
              <div class="toc-label">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Table des matières
              </div>
              <ol class="toc-list">
                <li v-for="(item, i) in post.toc" :key="i">
                  <a :href="'#' + item.id" @click.prevent="scrollTo(item.id)">{{ item.label }}</a>
                </li>
              </ol>
            </div>

            <div class="bpa-content" v-html="post.content"></div>

            <div v-if="post.tags && post.tags.length" class="bpa-tags">
              <span class="bpat-label">Tags :</span>
              <div class="bpat-list">
                <span v-for="t in post.tags" :key="t" class="bpat-tag">{{ t }}</span>
              </div>
            </div>

            <div class="bpa-nav">
              <Link href="/blog" class="bpan-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour au blog
              </Link>
            </div>

            <!-- COMMENTAIRES -->
            <div class="comments-section">
              <div class="cs-head">
                <h2 class="cs-title">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                  Commentaires
                  <span class="cs-count">{{ comments.length }}</span>
                </h2>
              </div>

              <div v-if="comments.length" class="cs-list">
                <div v-for="(c, i) in comments" :key="i" class="cs-comment">
                  <div class="csc-avatar" :style="{ background: avatarColor(c.name) }">
                    {{ c.name.charAt(0).toUpperCase() }}
                  </div>
                  <div class="csc-body">
                    <div class="csc-meta">
                      <span class="csc-name">{{ c.name }}</span>
                      <span class="csc-date">{{ c.date }}</span>
                    </div>
                    <p class="csc-text">{{ c.text }}</p>
                  </div>
                </div>
              </div>

              <div v-else class="cs-empty">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <p>Soyez le premier à commenter cet article.</p>
              </div>

              <div class="cs-form">
                <div class="csf-head">Laisser un commentaire</div>

                <Transition name="fade">
                  <div v-if="commentSent" class="csf-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"/></svg>
                    Commentaire publié ! Merci pour votre retour.
                  </div>
                </Transition>

                <div v-if="globalError" class="csf-error">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                  {{ globalError }}
                </div>

                <form v-if="!commentSent" @submit.prevent="submitComment" novalidate>
                  <div class="csf-row">
                    <div class="csf-field" :class="{ error: formErrors.name }">
                      <label>Nom <span class="csf-req">*</span></label>
                      <input v-model="newComment.name" type="text" placeholder="Votre nom"/>
                      <span v-if="formErrors.name" class="csf-err">{{ formErrors.name }}</span>
                    </div>
                    <div class="csf-field" :class="{ error: formErrors.email }">
                      <label>Email <span class="csf-req">*</span> <span class="csf-private">(non publié)</span></label>
                      <input v-model="newComment.email" type="email" placeholder="vous@example.com"/>
                      <span v-if="formErrors.email" class="csf-err">{{ formErrors.email }}</span>
                    </div>
                  </div>
                  <div class="csf-field ta" :class="{ error: formErrors.text }">
                    <label>Commentaire <span class="csf-req">*</span></label>
                    <textarea v-model="newComment.text" rows="4" placeholder="Votre commentaire, question ou retour d'expérience..."></textarea>
                    <div class="csf-count">{{ newComment.text.length }} / 500</div>
                    <span v-if="formErrors.text" class="csf-err">{{ formErrors.text }}</span>
                  </div>
                  <button type="submit" class="csf-submit" :disabled="submitting">
                    <span v-if="!submitting">
                      Publier le commentaire
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </span>
                    <span v-else class="csf-spinner"></span>
                  </button>
                </form>
              </div>
            </div>
            <!-- FIN COMMENTAIRES -->

          </article>

          <!-- ASIDE -->
          <aside class="bpc-aside">
            <div class="aside-card ac-author">
              <div class="aca-avatar" :style="{ background: post.color }">R</div>
              <div class="aca-name">Rosnel Pacely</div>
              <div class="aca-role">Ingénieur Informaticien</div>
              <div class="aca-bio">Développeur full-stack spécialisé Laravel + Vue.js, basé au Cameroun. Je partage mes expériences et bonnes pratiques.</div>
              <div class="aca-links">
                <a href="https://github.com/rosnel20" target="_blank" rel="noopener" class="acal">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.38-1.33-1.75-1.33-1.75-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.8 1.3 3.49 1 .11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.14-.3-.54-1.52.1-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 3-.4c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.64 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z"/></svg>
                  GitHub
                </a>
                <a href="https://linkedin.com/in/rosneldev" target="_blank" rel="noopener" class="acal">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                  LinkedIn
                </a>
              </div>
            </div>

            <div v-if="relatedPosts.length" class="aside-card ac-related">
              <div class="acr-head">Articles similaires</div>
              <div class="acr-list">
                <Link v-for="p in relatedPosts" :key="p.slug" :href="'/blog/' + p.slug" class="acrl-item">
                  <span class="acrl-cat" :style="{ color: p.color }">{{ p.category }}</span>
                  <span class="acrl-title">{{ p.title }}</span>
                  <span class="acrl-time">{{ p.readTime }} min</span>
                </Link>
              </div>
            </div>

            <div class="aside-card ac-cta">
              <div class="acct-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </div>
              <div class="acct-t">Un projet en tête ?</div>
              <div class="acct-s">Disponible pour vos projets web. Parlons-en.</div>
              <Link href="/contact" class="acct-btn">Me contacter</Link>
            </div>

          </aside>
        </div>
      </div>

      <AppFooter />
    </main>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { Link } from '@inertiajs/vue3'
import axios from 'axios'
import AppNav    from '../Components/AppNav.vue'
import AppFooter from '../Components/AppFooter.vue'
import NProgress from '../Components/NProgress.vue'

const props = defineProps({
  post:         { type: Object, required: true },
  relatedPosts: { type: Array,  default: () => [] },
  comments:     { type: Array,  default: () => [] },
})

const theme = ref(localStorage.getItem('theme') || 'dark')
function toggleTheme() {
  theme.value = theme.value === 'dark' ? 'light' : 'dark'
  localStorage.setItem('theme', theme.value)
}

function scrollTo(id) {
  const el = document.getElementById(id)
  if (el) window.scrollTo({ top: el.offsetTop - 110, behavior: 'smooth' })
}

const avatarColors = ['#E53E3E', '#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EC4899']
function avatarColor(name) {
  let hash = 0
  for (let i = 0; i < name.length; i++) hash = name.charCodeAt(i) + ((hash << 5) - hash)
  return avatarColors[Math.abs(hash) % avatarColors.length]
}

const comments    = ref(props.comments)
const commentSent = ref(false)
const submitting  = ref(false)
const globalError = ref('')
const newComment  = reactive({ name: '', email: '', text: '' })
const formErrors  = reactive({ name: '', email: '', text: '' })

function validateComment() {
  let ok = true
  formErrors.name = formErrors.email = formErrors.text = ''
  if (!newComment.name.trim())  { formErrors.name  = 'Votre nom est requis.'; ok = false }
  if (!newComment.email.trim()) { formErrors.email = "L'email est requis."; ok = false }
  else if (!/\S+@\S+\.\S+/.test(newComment.email)) { formErrors.email = 'Email invalide.'; ok = false }
  if (newComment.text.trim().length < 5) { formErrors.text = 'Commentaire trop court.'; ok = false }
  if (newComment.text.length > 500)      { formErrors.text = 'Maximum 500 caractères.'; ok = false }
  return ok
}

async function submitComment() {
  if (!validateComment()) return
  submitting.value = true
  globalError.value = ''

  try {
    const { data } = await axios.post(
      `/blog/${props.post.slug}/comments`,
      {
        name:  newComment.name,
        email: newComment.email,
        text:  newComment.text,
      }
    )
    comments.value = data.comments
    commentSent.value = true
    newComment.name = newComment.email = newComment.text = ''
    setTimeout(() => { commentSent.value = false }, 4000)
  } catch (err) {
    if (err.response?.status === 422) {
      const errs = err.response.data.errors
      formErrors.name  = errs.name?.[0]  || ''
      formErrors.email = errs.email?.[0] || ''
      formErrors.text  = errs.text?.[0]  || ''
    } else {
      globalError.value = 'Une erreur est survenue. Réessaie.'
    }
  } finally {
    submitting.value = false
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

.bppage.dark {
  --bg: #0A0A0A; --bg2: #111111; --footer-bg: #080808;
  --card: rgba(255,255,255,.04); --card-b: rgba(255,255,255,.08);
  --text: #F0F0F0; --muted: #555; --muted2: #888;
  --nav-bg: rgba(12,12,12,.88); --nav-b: rgba(255,255,255,.09);
  --red: #E53E3E; --red-soft: rgba(229,62,62,.1); --blue: #3B82F6;
  --prose: #C8C8C8; --prose-head: #F0F0F0;
  --code-bg: rgba(255,255,255,.07); --code-b: rgba(255,255,255,.12);
  --input-bg: rgba(255,255,255,.04); --input-b: rgba(255,255,255,.1);
}
.bppage.light {
  --bg: #F8F8F8; --bg2: #FFFFFF; --footer-bg: #EFEFEF;
  --card: rgba(0,0,0,.035); --card-b: rgba(0,0,0,.09);
  --text: #0A0A0A; --muted: #888; --muted2: #AAA;
  --nav-bg: rgba(248,248,248,.92); --nav-b: rgba(0,0,0,.09);
  --red: #C53030; --red-soft: rgba(197,48,48,.08); --blue: #2563EB;
  --footer-bg: #EFEFEF;
  --prose: #2D2D2D; --prose-head: #0A0A0A;
  --code-bg: rgba(0,0,0,.05); --code-b: rgba(0,0,0,.1);
  --input-bg: rgba(0,0,0,.03); --input-b: rgba(0,0,0,.12);
}
* { box-sizing: border-box; margin: 0; padding: 0; }
.bppage { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; transition: background .4s, color .4s; }

.bph { position: relative; min-height: 72vh; display: flex; align-items: flex-end; padding-bottom: 0; overflow: hidden; }
.bph-img-wrap { position: absolute; inset: 0; }
.bph-bg-img { width: 100%; height: 100%; object-fit: cover; object-position: center; filter: brightness(.45) saturate(.8); }
.bph-img-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,.25) 0%, rgba(0,0,0,.55) 50%, rgba(0,0,0,.82) 100%); }
.bph-bg { position: absolute; inset: 0; pointer-events: none; }
.bph-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(229,62,62,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(229,62,62,.06) 1px, transparent 1px); background-size: 48px 48px; -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, black 20%, transparent 80%); mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, black 20%, transparent 80%); }
.bph-orb { position: absolute; width: 500px; height: 500px; border-radius: 50%; top: -160px; right: -80px; opacity: .06; filter: blur(110px); }

.bph-inner { position: relative; z-index: 2; max-width: 860px; margin: 0 auto; width: 100%; padding: 9rem 5vw 4rem; }
.bph-inner.has-image .bph-crumb,
.bph-inner.has-image .bphc-link,
.bph-inner.has-image .bphc-sep,
.bph-inner.has-image .bphc-cur { color: rgba(255,255,255,.65) !important; }
.bph-inner.has-image .bphc-link:hover { color: #fff !important; }
.bph-inner.has-image .bph-date,
.bph-inner.has-image .bph-time { color: rgba(255,255,255,.55) !important; }
.bph-inner.has-image .bph-title { color: #fff; text-shadow: 0 2px 20px rgba(0,0,0,.4); }
.bph-inner.has-image .bph-lead  { color: rgba(255,255,255,.8); }
.bph-inner.has-image .bpha-name { color: #fff; }
.bph-inner.has-image .bpha-role { color: rgba(255,255,255,.6); }

.bph-crumb { display: flex; align-items: center; gap: .5rem; font-size: .76rem; color: var(--muted); margin-bottom: 2rem; flex-wrap: wrap; }
.bphc-link  { color: var(--muted); text-decoration: none; transition: color .2s; }
.bphc-link:hover { color: var(--red); }
.bphc-sep { opacity: .4; }
.bphc-cur { color: var(--muted2); }

.bph-meta { display: flex; align-items: center; gap: .75rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
.bph-cat  { font-family: 'JetBrains Mono', monospace; font-size: .64rem; letter-spacing: .08em; padding: .22rem .72rem; border-radius: 6px; border: 1px solid; font-weight: 600; }
.bph-date { font-family: 'JetBrains Mono', monospace; font-size: .68rem; color: var(--muted); }
.bph-time { display: flex; align-items: center; gap: .35rem; font-family: 'JetBrains Mono', monospace; font-size: .68rem; color: var(--muted); }

.bph-title { font-size: clamp(2rem, 5vw, 3.6rem); font-weight: 900; letter-spacing: -.05em; line-height: 1.1; color: var(--text); margin-bottom: 1.4rem; }
.bph-lead  { font-size: 1.06rem; color: var(--muted2); line-height: 1.85; margin-bottom: 2.2rem; font-family: 'Lora', Georgia, serif; max-width: 680px; }

.bph-author { display: flex; align-items: center; gap: 1rem; }
.bpha-avatar { width: 46px; height: 46px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 900; color: #fff; flex-shrink: 0; }
.bpha-name { font-size: .9rem; font-weight: 700; color: var(--text); }
.bpha-role { font-size: .72rem; color: var(--muted); margin-top: .1rem; }

.bpc { background: var(--bg2); padding: 5rem 5vw 7rem; }
.bpc-inner { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 1fr 280px; gap: 4rem; align-items: start; }

.bpa-toc { background: var(--card); border: 1px solid var(--card-b); border-left: 3px solid var(--red); border-radius: 0 12px 12px 0; padding: 1.2rem 1.4rem; margin-bottom: 2.5rem; }
.toc-label { display: flex; align-items: center; gap: .5rem; font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); letter-spacing: .18em; text-transform: uppercase; margin-bottom: .9rem; }
.toc-list  { list-style: none; display: flex; flex-direction: column; gap: .42rem; counter-reset: toc; }
.toc-list li { counter-increment: toc; }
.toc-list a { font-size: .84rem; color: var(--muted2); text-decoration: none; display: flex; align-items: baseline; gap: .55rem; transition: color .2s; }
.toc-list a::before { content: counter(toc) '.'; font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--red); min-width: 1.2rem; }
.toc-list a:hover { color: var(--red); }

.bpa-content { color: var(--prose); line-height: 1.9; font-size: .97rem; }
.bpa-content :deep(h2) { font-size: 1.6rem; font-weight: 900; color: var(--prose-head); letter-spacing: -.04em; line-height: 1.15; margin: 3rem 0 1.1rem; padding-top: 1rem; border-top: 1px solid var(--card-b); }
.bpa-content :deep(h3) { font-size: 1.15rem; font-weight: 800; color: var(--prose-head); letter-spacing: -.03em; margin: 2.2rem 0 .8rem; }
.bpa-content :deep(p)  { margin-bottom: 1.3rem; }
.bpa-content :deep(ul), .bpa-content :deep(ol) { margin: 0 0 1.3rem 1.5rem; display: flex; flex-direction: column; gap: .5rem; }
.bpa-content :deep(li) { line-height: 1.75; }
.bpa-content :deep(ul li)::marker { color: var(--red); }
.bpa-content :deep(strong) { color: var(--prose-head); font-weight: 700; }
.bpa-content :deep(em) { font-family: 'Lora', Georgia, serif; font-style: italic; }
.bpa-content :deep(blockquote) { border-left: 3px solid var(--red); margin: 1.8rem 0; padding: 1rem 1.4rem; background: var(--red-soft); border-radius: 0 10px 10px 0; font-family: 'Lora', Georgia, serif; font-style: italic; color: var(--prose-head); }
.bpa-content :deep(blockquote p) { margin: 0; font-size: 1.02rem; }
.bpa-content :deep(code) { font-family: 'JetBrains Mono', monospace; font-size: .82em; background: var(--code-bg); border: 1px solid var(--code-b); padding: .08rem .38rem; border-radius: 5px; color: var(--red); }
.bpa-content :deep(pre) { background: #0d0d0d; border: 1px solid rgba(255,255,255,.08); border-radius: 12px; padding: 1.4rem 1.6rem; margin: 1.5rem 0; overflow-x: auto; }
.bpa-content :deep(pre code) { background: none; border: none; padding: 0; color: #e2e8f0; font-size: .85rem; line-height: 1.7; }
.bpa-content :deep(table) { width: 100%; border-collapse: collapse; margin: 1.5rem 0; font-size: .87rem; }
.bpa-content :deep(th) { font-family: 'JetBrains Mono', monospace; font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; background: var(--card); border: 1px solid var(--card-b); padding: .65rem 1rem; color: var(--muted); text-align: left; }
.bpa-content :deep(td) { border: 1px solid var(--card-b); padding: .65rem 1rem; vertical-align: top; }
.bpa-content :deep(tr:hover td) { background: var(--card); }
.bpa-content :deep(hr) { border: none; border-top: 1px solid var(--card-b); margin: 2.5rem 0; }
.bpa-content :deep(.callout) { background: var(--card); border: 1px solid var(--card-b); border-left: 3px solid var(--blue); border-radius: 0 12px 12px 0; padding: 1rem 1.3rem; margin: 1.5rem 0; font-size: .9rem; }
.bpa-content :deep(.callout-warn) { border-left-color: #F59E0B; background: rgba(245,158,11,.06); }
.bpa-content :deep(.callout-ok)   { border-left-color: #10B981; background: rgba(16,185,129,.06); }

.bpa-tags { display: flex; align-items: center; gap: .7rem; flex-wrap: wrap; margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid var(--card-b); }
.bpat-label { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); letter-spacing: .14em; text-transform: uppercase; }
.bpat-tag { font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--red); background: var(--red-soft); border: 1px solid rgba(229,62,62,.18); padding: .18rem .6rem; border-radius: 5px; }

.bpa-nav { margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--card-b); margin-bottom: 3rem; }
.bpan-back { display: inline-flex; align-items: center; gap: .5rem; font-size: .84rem; font-weight: 700; color: var(--muted2); text-decoration: none; transition: color .2s; }
.bpan-back:hover { color: var(--red); }

.comments-section { border-top: 1px solid var(--card-b); padding-top: 3rem; }
.cs-head  { margin-bottom: 2rem; }
.cs-title { display: flex; align-items: center; gap: .65rem; font-size: 1.2rem; font-weight: 800; color: var(--text); }
.cs-count { font-family: 'JetBrains Mono', monospace; font-size: .72rem; background: var(--red-soft); color: var(--red); border: 1px solid rgba(229,62,62,.2); padding: .12rem .5rem; border-radius: 5px; }

.cs-list { display: flex; flex-direction: column; gap: 1.2rem; margin-bottom: 2.5rem; }
.cs-comment { display: flex; gap: 1rem; align-items: flex-start; }
.csc-avatar { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; font-weight: 800; color: #fff; flex-shrink: 0; }
.csc-body  { flex: 1; background: var(--card); border: 1px solid var(--card-b); border-radius: 12px; padding: 1rem 1.2rem; }
.csc-meta  { display: flex; align-items: center; gap: .8rem; margin-bottom: .5rem; }
.csc-name  { font-size: .88rem; font-weight: 700; color: var(--text); }
.csc-date  { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); }
.csc-text  { font-size: .88rem; color: var(--prose); line-height: 1.7; }

.cs-empty { text-align: center; padding: 2.5rem; background: var(--card); border: 1px solid var(--card-b); border-radius: 14px; color: var(--muted); display: flex; flex-direction: column; align-items: center; gap: .8rem; margin-bottom: 2.5rem; }
.cs-empty p { font-size: .88rem; }

.cs-form { background: var(--card); border: 1px solid var(--card-b); border-radius: 16px; padding: 1.8rem; }
.csf-head { font-family: 'JetBrains Mono', monospace; font-size: .64rem; color: var(--muted); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1.4rem; display: flex; align-items: center; gap: .5rem; }
.csf-head::before { content: ''; display: block; width: 14px; height: 1px; background: var(--red); }

.csf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
.csf-field { display: flex; flex-direction: column; gap: .38rem; }
.csf-field label { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); letter-spacing: .1em; text-transform: uppercase; }
.csf-req { color: var(--red); }
.csf-private { opacity: .5; font-size: .9em; text-transform: none; letter-spacing: 0; }
.csf-field input, .csf-field textarea {
  background: var(--input-bg); border: 1px solid var(--input-b);
  border-radius: 9px; padding: .72rem .95rem; color: var(--text);
  font-family: 'Outfit', sans-serif; font-size: .87rem;
  outline: none; resize: none; transition: border-color .2s, box-shadow .2s, background .2s; width: 100%;
}
.csf-field input::placeholder, .csf-field textarea::placeholder { color: var(--muted); }
.csf-field input:focus, .csf-field textarea:focus { border-color: var(--red); background: var(--red-soft); box-shadow: 0 0 0 3px rgba(229,62,62,.07); }
.csf-field.error input, .csf-field.error textarea { border-color: #FC8181; }
.csf-err  { font-size: .7rem; color: #FC8181; font-family: 'JetBrains Mono', monospace; }
.csf-count { font-family: 'JetBrains Mono', monospace; font-size: .58rem; color: var(--muted); text-align: right; margin-top: .25rem; }
.csf-field.ta { margin-bottom: 1.2rem; }

.csf-submit { display: inline-flex; align-items: center; gap: .5rem; background: var(--red); color: #fff; border: none; padding: .82rem 1.8rem; border-radius: 10px; cursor: pointer; font-family: 'Outfit', sans-serif; font-size: .88rem; font-weight: 700; box-shadow: 0 4px 18px rgba(229,62,62,.22); transition: transform .2s, opacity .2s; }
.csf-submit:hover:not(:disabled) { transform: translateY(-2px); opacity: .9; }
.csf-submit:disabled { opacity: .7; cursor: not-allowed; }
.csf-spinner { width: 16px; height: 16px; border-radius: 50%; border: 2px solid rgba(255,255,255,.3); border-top-color: #fff; animation: spin .7s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

.csf-success { display: flex; align-items: center; gap: .6rem; background: rgba(16,185,129,.1); border: 1px solid rgba(16,185,129,.25); color: #10B981; border-radius: 10px; padding: .85rem 1.1rem; font-size: .86rem; font-weight: 600; margin-bottom: 1.2rem; }
.csf-error { display: flex; align-items: center; gap: .6rem; background: rgba(229,62,62,.08); border: 1px solid rgba(229,62,62,.25); color: var(--red); border-radius: 10px; padding: .85rem 1.1rem; font-size: .86rem; font-weight: 600; margin-bottom: 1.2rem; }

.bpc-aside { display: flex; flex-direction: column; gap: 1.2rem; position: sticky; top: 6rem; }
.aside-card { background: var(--card); border: 1px solid var(--card-b); border-radius: 16px; padding: 1.4rem; }
.ac-author  { display: flex; flex-direction: column; align-items: center; text-align: center; gap: .65rem; }
.aca-avatar { width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 900; color: #fff; }
.aca-name   { font-size: .92rem; font-weight: 800; color: var(--text); }
.aca-role   { font-size: .72rem; color: var(--muted); }
.aca-bio    { font-size: .78rem; color: var(--muted2); line-height: 1.65; }
.aca-links  { display: flex; gap: .55rem; }
.acal { display: inline-flex; align-items: center; gap: .35rem; font-size: .74rem; color: var(--muted2); text-decoration: none; border: 1px solid var(--card-b); padding: .28rem .75rem; border-radius: 6px; transition: color .2s, border-color .2s; }
.acr-head  { font-family: 'JetBrains Mono', monospace; font-size: .62rem; color: var(--muted); letter-spacing: .18em; text-transform: uppercase; margin-bottom: 1rem; }
.acr-list  { display: flex; flex-direction: column; gap: .7rem; }
.acrl-item { display: flex; flex-direction: column; gap: .25rem; text-decoration: none; padding: .75rem; border-radius: 10px; border: 1px solid transparent; transition: border-color .2s, background .2s; }
.acrl-cat   { font-family: 'JetBrains Mono', monospace; font-size: .6rem; letter-spacing: .08em; }
.acrl-title { font-size: .82rem; font-weight: 700; color: var(--text); line-height: 1.3; }
.acrl-time  { font-family: 'JetBrains Mono', monospace; font-size: .6rem; color: var(--muted); }
.ac-cta { display: flex; flex-direction: column; align-items: center; text-align: center; gap: .7rem; background: linear-gradient(135deg, var(--red-soft), transparent); border-color: rgba(229,62,62,.2); }
.acct-icon { width: 44px; height: 44px; border-radius: 12px; background: var(--red-soft); color: var(--red); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(229,62,62,.2); }
.acct-t { font-size: .92rem; font-weight: 800; color: var(--text); }
.acct-s { font-size: .78rem; color: var(--muted2); line-height: 1.6; }
.acct-btn { display: flex; align-items: center; justify-content: center; width: 100%; background: var(--red); color: #fff; padding: .65rem 1rem; border-radius: 10px; font-weight: 700; font-size: .84rem; text-decoration: none; transition: opacity .2s, transform .2s; }

.fade-enter-active, .fade-leave-active { transition: opacity .3s, transform .3s; }
.fade-enter-from { opacity: 0; transform: translateY(8px); }
.fade-leave-to   { opacity: 0; }

/* ══ HOVER : vrais pointeurs seulement ══ */
@media (hover: hover) and (pointer: fine) {
  .bphc-link:hover { color: var(--red); }
  .bph-inner.has-image .bphc-link:hover { color: #fff !important; }
  .toc-list a:hover { color: var(--red); }
  .bpan-back:hover { color: var(--red); }
  .acal:hover { color: var(--text); border-color: var(--red); }
  .acrl-item:hover { border-color: var(--card-b); background: var(--card); }
  .acct-btn:hover { opacity: .9; transform: translateY(-1px); }
  .csf-submit:hover:not(:disabled) { transform: translateY(-2px); opacity: .9; }
  .bpa-content :deep(tr:hover td) { background: var(--card); }
}

/* ══ RESPONSIVE ══ */
@media (max-width: 900px) {
  .bpc-inner { grid-template-columns: 1fr; gap: 3rem; }
  .bpc-aside { position: static; }
  .bpc-aside { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }
}

@media (max-width: 680px) {
  .bph-inner { padding: 6.5rem 5vw 3rem; }
  .bpc { padding: 4rem 5vw 5rem; }
  .bph-title { font-size: clamp(1.7rem, 6vw, 2rem); }
  .bph-lead  { font-size: .95rem; }
  .csf-row   { grid-template-columns: 1fr; }
  .bpc-aside { grid-template-columns: 1fr; }
  .bpa-toc   { padding: 1rem 1.2rem; }
  .cs-form   { padding: 1.3rem; }
}

@media (max-width: 480px) {
  .bph-inner { padding: 5.5rem 4vw 2.5rem; }
  .bpc { padding: 3rem 4vw 4rem; }
  .bph-title { font-size: clamp(1.5rem, 7vw, 1.8rem); }
  .bpa-content :deep(h2) { font-size: 1.25rem; }
  .bpa-content :deep(h3) { font-size: 1rem; }
  .bpa-content :deep(pre) { padding: 1rem 1.1rem; font-size: .78rem; }
  .bpa-content :deep(table) { font-size: .78rem; display: block; overflow-x: auto; -webkit-overflow-scrolling: touch; }
  .bpa-content :deep(blockquote) { padding: .85rem 1rem; }
  .cs-comment { gap: .65rem; }
  .csc-avatar { width: 34px; height: 34px; font-size: .85rem; }
  .csc-body { padding: .85rem 1rem; }
  .csf-submit { width: 100%; justify-content: center; }
  .aside-card { padding: 1.1rem; }
}

@media (max-width: 360px) {
  .bph-meta { gap: .5rem; }
  .bph-author { gap: .75rem; }
  .bpha-avatar { width: 38px; height: 38px; }
}
</style>