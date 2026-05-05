<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- SEO de base -->
    <title>Rosnel Pacely — Ingénieur Full-Stack Laravel · Vue.js</title>
    <meta name="description" content="Portfolio de Mabong Anaba Rosnel Pacely — Ingénieur Informaticien Full-Stack spécialisé Laravel, Vue.js et React. Disponible pour missions freelance et CDI depuis le Cameroun." />
    <meta name="author" content="Mabong Anaba Rosnel Pacely" />
    <link rel="canonical" href="https://rosnel.dev" />

    <!-- Open Graph (LinkedIn, Facebook, WhatsApp…) -->
    <meta property="og:type"        content="website" />
    <meta property="og:url"         content="https://rosnel.dev" />
    <meta property="og:title"       content="Rosnel Pacely — Ingénieur Full-Stack" />
    <meta property="og:description" content="Développeur Full-Stack Laravel · Vue.js · React. Code propre, architecture réfléchie, livraison rapide." />
    <meta property="og:image"       content="https://rosnel.dev/images/og-cover.jpg" />
    <meta property="og:image:width"  content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:locale"      content="fr_FR" />

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image" />
    <meta name="twitter:title"       content="Rosnel Pacely — Ingénieur Full-Stack" />
    <meta name="twitter:description" content="Développeur Full-Stack Laravel · Vue.js · React." />
    <meta name="twitter:image"       content="https://rosnel.dev/images/og-cover.jpg" />

    <!-- Favicon -->
    <link rel="icon"             type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon"             type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="180x180"               href="/apple-touch-icon.png" />
    <link rel="manifest"         href="/site.webmanifest" />
    <meta name="theme-color" content="#0A0A0A" />

    <!-- ⚡ Anti-flash : applique le thème AVANT que le CSS charge -->
    <script>
      (function () {
        var t = localStorage.getItem('theme') || 'dark';
        document.documentElement.classList.add(t);
        document.documentElement.style.backgroundColor = t === 'light' ? '#F8F8F8' : '#0A0A0A';
      })();
    </script>

    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>