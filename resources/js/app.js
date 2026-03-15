import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AppLoader from './Components/AppLoader.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    // On crée un composant racine qui monte AppLoader UNE SEULE FOIS
    // en dehors du cycle de vie des pages Inertia.
    // Ainsi la barre de progression survit aux changements de page.
    const RootApp = {
      render() {
        return h('div', { style: 'min-height:100vh' }, [
          h(AppLoader),          // ← toujours monté, jamais détruit
          h(App, props),         // ← pages Inertia normales
        ])
      }
    }

    createApp(RootApp)
      .use(plugin)
      .mount(el)
  },
})