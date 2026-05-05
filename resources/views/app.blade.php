<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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