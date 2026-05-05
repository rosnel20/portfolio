/**
 * useTheme.js
 * Composable partagé pour la gestion du thème dark/light.
 *
 * Usage dans n'importe quelle page :
 *   import { useTheme } from '../Composables/useTheme'
 *   const { theme, toggleTheme } = useTheme()
 *
 * Il synchronise :
 *  - localStorage (persistance entre sessions)
 *  - la classe CSS sur <html> (pour app.css → body/html)
 *  - la prop :class sur le wrapper de page
 */

import { ref, watch, onMounted } from 'vue'

// État partagé entre toutes les instances (singleton)
const theme = ref('dark')

function applyToHtml(t) {
  if (typeof document === 'undefined') return
  document.documentElement.classList.toggle('light', t === 'light')
  document.documentElement.classList.toggle('dark',  t === 'dark')
}

export function useTheme() {
  onMounted(() => {
    const saved = localStorage.getItem('theme') || 'dark'
    theme.value = saved
    applyToHtml(saved)
  })

  watch(theme, (t) => {
    localStorage.setItem('theme', t)
    applyToHtml(t)
  })

  function toggleTheme() {
    theme.value = theme.value === 'dark' ? 'light' : 'dark'
  }

  return { theme, toggleTheme }
}
