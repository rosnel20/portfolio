/**
 * useScrollReveal.js
 * Composable partagé — anime les éléments à l'entrée dans le viewport.
 *
 * Usage dans n'importe quelle page :
 *   import { useScrollReveal } from '../Composables/useScrollReveal'
 *   useScrollReveal()
 *
 * Marque les éléments à animer avec :
 *   class="reveal"           → fade + slide up (défaut)
 *   class="reveal reveal-left"  → slide depuis la gauche
 *   class="reveal reveal-right" → slide depuis la droite
 *   class="reveal reveal-scale" → zoom léger
 *   data-delay="100"         → délai en ms (ex: 100, 200, 300…)
 */

import { onMounted, onUnmounted } from 'vue'

export function useScrollReveal() {
  let observer

  onMounted(() => {
    const els = document.querySelectorAll('.reveal')

    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const delay = entry.target.dataset.delay || 0
            setTimeout(() => {
              entry.target.classList.add('revealed')
            }, Number(delay))
            observer.unobserve(entry.target)
          }
        })
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    )

    els.forEach(el => observer.observe(el))
  })

  onUnmounted(() => observer?.disconnect())
}
