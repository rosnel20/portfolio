<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

Route::get('/',        fn() => Inertia::render('Home'))->name('home');
Route::get('/blog',    fn() => Inertia::render('Blog'))->name('blog');
Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');

/*
|==========================================================================
|  BLOG — article individuel
|==========================================================================
*/
Route::get('/blog/{slug}', function (string $slug) {

    $posts = [

        'application-web-vs-site-web' => [
            'slug'     => 'application-web-vs-site-web',
            'title'    => 'Application web vs site web : quelle est vraiment la différence ?',
            'lead'     => "On entend souvent les deux termes utilisés de façon interchangeable. Pourtant, il existe une distinction fondamentale que tout développeur — et tout client — devrait connaître avant de se lancer dans un projet.",
            'category' => 'Développement web',
            'color'    => '#E53E3E',
            'date'     => 'Mars 2026',
            'readTime' => 7,
            'image'    => 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=1400&auto=format&fit=crop&q=80',
            'tags'     => ['Web', 'Architecture', 'Laravel', 'Vue.js', 'Bonnes pratiques'],
            'toc'      => [
                ['id' => 'definition',       'label' => 'Les définitions de base'],
                ['id' => 'differences-cles', 'label' => 'Les 5 différences clés'],
                ['id' => 'exemples',         'label' => 'Exemples concrets'],
                ['id' => 'choix',            'label' => 'Comment choisir ?'],
                ['id' => 'technologies',     'label' => 'Technologies associées'],
                ['id' => 'conclusion',       'label' => 'Conclusion'],
            ],
            'content' => <<<HTML
<h2 id="definition">Les définitions de base</h2>
<p>Avant d'entrer dans les détails, posons des définitions claires.</p>
<p>Un <strong>site web</strong> est un ensemble de pages accessibles via un navigateur, principalement conçu pour <em>présenter de l'information</em>. Le contenu est essentiellement statique ou peu interactif : pages d'entreprise, blogs, portfolios, sites vitrines. L'objectif est la consultation.</p>
<p>Une <strong>application web</strong>, en revanche, est un logiciel accessible via un navigateur qui permet à l'utilisateur d'effectuer des <em>actions</em> : créer un compte, soumettre des données, effectuer des transactions, collaborer en temps réel. L'objectif est l'interaction.</p>
<blockquote><p>Un site web vous dit quelque chose. Une application web vous permet de faire quelque chose.</p></blockquote>
<hr>
<h2 id="differences-cles">Les 5 différences clés</h2>
<h3>1. L'interactivité et la logique métier</h3>
<p>C'est la différence la plus visible. Un site web affiche du contenu. Une application web traite des données, applique des règles métier et répond aux actions de l'utilisateur en temps réel.</p>
<p>Sur un site vitrine, cliquer sur un bouton vous redirige vers une autre page. Sur une application comme TaskFlow, cliquer sur "Marquer comme terminé" met à jour une tâche en base de données, recalcule la progression du projet et notifie les membres de l'équipe — tout en quelques millisecondes.</p>
<h3>2. L'authentification et les données personnalisées</h3>
<p>La plupart des applications web nécessitent une authentification. Chaque utilisateur dispose de <strong>son propre espace</strong>, ses propres données et ses propres préférences.</p>
<div class="callout">
  <strong>Exemple :</strong> La page d'accueil de Netflix est un site web. Une fois connecté, vous entrez dans l'application web Netflix avec votre liste, votre historique et vos recommandations personnalisées.
</div>
<h3>3. La gestion de l'état</h3>
<p>Une application web doit mémoriser ce que fait l'utilisateur à chaque instant. C'est pourquoi les applications modernes utilisent des frameworks comme <strong>Vue.js</strong> ou <strong>React</strong> pour gérer cet état côté client de façon réactive.</p>
<h3>4. La complexité technique</h3>
<p>Un site web peut être construit avec HTML/CSS et un CMS. Une application web requiert généralement :</p>
<ul>
  <li>Un <strong>backend robuste</strong> (Laravel, Node.js, Django…)</li>
  <li>Une <strong>base de données</strong> relationnelle ou NoSQL</li>
  <li>Un système d'<strong>authentification</strong> sécurisé</li>
  <li>Des <strong>APIs</strong> pour la communication frontend/backend</li>
  <li>Un <strong>framework frontend</strong> pour l'interactivité</li>
</ul>
<h3>5. La performance et l'infrastructure</h3>
<p>Les sites web peuvent être mis en cache et servis depuis un CDN. Les applications web impliquent des requêtes dynamiques et des calculs côté serveur, ce qui demande une infrastructure plus soignée.</p>
<hr>
<h2 id="exemples">Exemples concrets</h2>
<table>
  <thead><tr><th>Site web</th><th>Application web</th></tr></thead>
  <tbody>
    <tr><td>Blog personnel</td><td>Plateforme de gestion de contenu</td></tr>
    <tr><td>Site vitrine d'entreprise</td><td>CRM, ERP, outil de gestion</td></tr>
    <tr><td>Site de documentation</td><td>Tableau de bord analytique</td></tr>
    <tr><td>Portfolio</td><td>Plateforme de collaboration (Slack, Trello)</td></tr>
    <tr><td>Landing page</td><td>Application SaaS</td></tr>
  </tbody>
</table>
<hr>
<h2 id="choix">Comment choisir ?</h2>
<p>La question à se poser est simple : <strong>est-ce que mes utilisateurs ont besoin de faire des choses, ou juste de voir des choses ?</strong></p>
<ul>
  <li>Vos utilisateurs doivent-ils se connecter ? → <strong>Application web</strong></li>
  <li>Vos données changent-elles selon l'utilisateur ? → <strong>Application web</strong></li>
  <li>Y a-t-il des transactions ou des workflows ? → <strong>Application web</strong></li>
  <li>Vous souhaitez juste présenter votre activité ? → <strong>Site web</strong></li>
</ul>
<div class="callout callout-warn">
  <strong>Attention :</strong> Beaucoup de clients demandent un "site web" alors qu'ils ont besoin d'une application web. Clarifiez toujours le besoin réel avant de commencer — cela évite les devis sous-estimés et les projets mal architecturés.
</div>
<hr>
<h2 id="technologies">Technologies associées</h2>
<h3>Pour un site web</h3>
<ul>
  <li><strong>HTML / CSS / JavaScript</strong> — les bases</li>
  <li><strong>Frameworks CSS</strong> : Tailwind CSS, Bootstrap</li>
  <li><strong>CMS</strong> : WordPress, Webflow, Strapi</li>
</ul>
<h3>Pour une application web</h3>
<ul>
  <li><strong>Backend</strong> : Laravel (PHP), Node.js, Django</li>
  <li><strong>Frontend réactif</strong> : Vue.js, React, Angular</li>
  <li><strong>BDD</strong> : MySQL, PostgreSQL</li>
</ul>
<div class="callout callout-ok">
  <strong>Ma stack favorite :</strong> Laravel + Inertia.js + Vue 3 — la robustesse de Laravel avec la réactivité de Vue, sans API REST séparée. C'est la stack que j'utilise pour la majorité de mes projets.
</div>
<hr>
<h2 id="conclusion">Conclusion</h2>
<p>La distinction entre site web et application web n'est pas une question de technologie, mais de <strong>cas d'usage</strong>. Un site web informe. Une application web permet d'agir. La technologie doit servir le besoin, jamais l'inverse.</p>
HTML,
        ],

        'mobile-vs-web' => [
            'slug'     => 'mobile-vs-web',
            'title'    => 'Développement mobile vs développement web : comment choisir ?',
            'lead'     => "Application native, web ou hybride ? Ce choix stratégique conditionne votre budget, votre audience et votre délai de mise sur le marché. Voici un guide complet pour décider avec méthode.",
            'category' => 'Mobile & Web',
            'color'    => '#3B82F6',
            'date'     => 'Fév. 2026',
            'readTime' => 8,
            'image'    => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=1400&auto=format&fit=crop&q=80',
            'tags'     => ['Mobile', 'Web', 'React Native', 'PWA', 'Stratégie'],
            'toc'      => [
                ['id' => 'types',            'label' => "Les types d'applications mobiles"],
                ['id' => 'avantages-mobile', 'label' => 'Avantages du mobile natif'],
                ['id' => 'avantages-web',    'label' => 'Avantages du web'],
                ['id' => 'comparatif',       'label' => 'Comparatif détaillé'],
                ['id' => 'pwa',              'label' => 'La PWA : le meilleur des deux ?'],
                ['id' => 'decision',         'label' => 'Guide de décision pratique'],
                ['id' => 'conclusion-mobile','label' => 'Conclusion'],
            ],
            'content' => <<<HTML
<h2 id="types">Les types d'applications mobiles</h2>
<p>Avant de choisir, il faut comprendre les différentes familles :</p>
<ul>
  <li><strong>Application native</strong> : développée spécifiquement pour iOS (Swift) ou Android (Kotlin). Accès complet au hardware, performances optimales, mais deux codebases à maintenir.</li>
  <li><strong>Application hybride</strong> : technologies web encapsulées dans un conteneur natif (React Native, Flutter). Un seul codebase pour iOS et Android.</li>
  <li><strong>Application web / PWA</strong> : accessible depuis un navigateur, installable sur l'écran d'accueil, fonctionne hors ligne grâce aux Service Workers.</li>
</ul>
<blockquote><p>Il n'existe pas de "meilleure" approche universelle — seulement la plus adaptée à votre contexte.</p></blockquote>
<hr>
<h2 id="avantages-mobile">Avantages du développement mobile natif</h2>
<h3>Accès aux fonctionnalités natives</h3>
<p>Les applications natives exploitent pleinement le matériel : caméra, GPS, NFC, Bluetooth, notifications push, stockage sécurisé.</p>
<h3>Performances supérieures</h3>
<p>Une app native offre des animations fluides à 60fps et une réactivité que le web peine encore à égaler pour des interfaces très complexes.</p>
<h3>Monétisation via les stores</h3>
<p>App Store et Google Play offrent une vitrine intégrée, un système de paiement in-app et une crédibilité perçue.</p>
<div class="callout">
  <strong>Note :</strong> Avec React Native, il est possible de partager 70 à 90% du code entre iOS et Android tout en obtenant des performances proches du natif.
</div>
<hr>
<h2 id="avantages-web">Avantages du développement web</h2>
<h3>Accessibilité universelle</h3>
<p>Une application web est accessible depuis n'importe quel appareil avec un navigateur. Aucun téléchargement requis.</p>
<h3>Coût réduit</h3>
<p>Un seul codebase pour toutes les plateformes. Les mises à jour sont instantanées, sans validation par les stores.</p>
<h3>SEO et découvrabilité</h3>
<p>Les applications web sont indexées par Google. Une app native ne peut pas être découverte via un moteur de recherche.</p>
<hr>
<h2 id="comparatif">Comparatif détaillé</h2>
<table>
  <thead><tr><th>Critère</th><th>Native</th><th>Hybride</th><th>Web / PWA</th></tr></thead>
  <tbody>
    <tr><td>Coût</td><td>Élevé</td><td>Moyen</td><td>Faible à moyen</td></tr>
    <tr><td>Performances</td><td>Excellentes</td><td>Très bonnes</td><td>Bonnes</td></tr>
    <tr><td>Accès matériel</td><td>Complet</td><td>Partiel</td><td>Limité</td></tr>
    <tr><td>Délai de mise en marché</td><td>Long</td><td>Moyen</td><td>Court</td></tr>
    <tr><td>SEO</td><td>Aucun</td><td>Aucun</td><td>Excellent</td></tr>
    <tr><td>Mises à jour</td><td>Via store</td><td>Via store</td><td>Instantanées</td></tr>
  </tbody>
</table>
<hr>
<h2 id="pwa">La PWA : le meilleur des deux mondes ?</h2>
<p>Une <strong>Progressive Web App</strong> est une application web qui adopte des comportements habituellement réservés aux apps natives :</p>
<ul>
  <li>Installation sur l'écran d'accueil (sans passer par un store)</li>
  <li>Fonctionnement hors ligne via les Service Workers</li>
  <li>Notifications push</li>
  <li>Interface plein écran</li>
</ul>
<div class="callout callout-ok">
  <strong>Pour la majorité des projets</strong>, une PWA bien construite offre 90% des bénéfices d'une app native pour 40% du coût de développement.
</div>
<hr>
<h2 id="decision">Guide de décision pratique</h2>
<ul>
  <li>Avez-vous besoin d'accéder à des capteurs hardware spécifiques (NFC, Bluetooth BLE) ? → <strong>App native</strong></li>
  <li>Votre app doit-elle fonctionner hors ligne avec des données volumineuses ? → <strong>App native ou hybride</strong></li>
  <li>Le SEO est crucial pour votre acquisition ? → <strong>Web obligatoire</strong></li>
  <li>Vous devez livrer vite avec des ressources limitées ? → <strong>Web ou hybride</strong></li>
</ul>
<div class="callout callout-warn">
  <strong>Erreur fréquente :</strong> Commencer par une app native "parce que ça fait plus sérieux". Une PWA bien conçue couvre 80% des besoins à moindre coût.
</div>
<hr>
<h2 id="conclusion-mobile">Conclusion</h2>
<p>Le choix entre mobile et web est <strong>stratégique</strong>, pas technique. Il dépend de votre audience, budget, délais et fonctionnalités réelles. Dans la plupart des projets, je recommande de commencer par une application web — et d'envisager le natif uniquement si des besoins hardware spécifiques le justifient.</p>
HTML,
        ],

        'pourquoi-choisir-le-web' => [
            'slug'     => 'pourquoi-choisir-le-web',
            'title'    => 'Pourquoi choisir le web pour votre projet en 2026 ?',
            'lead'     => "Accessibilité universelle, coûts réduits, mises à jour instantanées... Le web offre des avantages concurrentiels décisifs que beaucoup de porteurs de projets sous-estiment encore.",
            'category' => 'Stratégie',
            'color'    => '#10B981',
            'date'     => 'Jan. 2026',
            'readTime' => 6,
            'image'    => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1400&auto=format&fit=crop&q=80',
            'tags'     => ['Web', 'Stratégie', 'Business', 'Laravel', 'ROI'],
            'toc'      => [
                ['id' => 'web-2026',     'label' => 'Le web en 2026 : état des lieux'],
                ['id' => 'access',       'label' => 'Accessibilité universelle'],
                ['id' => 'couts',        'label' => 'Coûts et délais réduits'],
                ['id' => 'seo',          'label' => 'SEO et visibilité organique'],
                ['id' => 'evolution',    'label' => 'Évolutivité et maintenance'],
                ['id' => 'securite',     'label' => 'Sécurité et conformité'],
                ['id' => 'conclusion-w', 'label' => 'Conclusion'],
            ],
            'content' => <<<HTML
<h2 id="web-2026">Le web en 2026 : état des lieux</h2>
<p>En 2026, le navigateur est devenu la plateforme logicielle la plus universelle au monde. Plus de <strong>5,4 milliards de personnes</strong> ont accès à Internet. Les navigateurs modernes supportent WebAssembly, WebGL, WebRTC, les Service Workers et des APIs matérielles de plus en plus riches.</p>
<p>La question n'est plus "est-ce que le web peut faire ça ?" mais "<strong>pourquoi ne pas choisir le web en premier ?</strong>"</p>
<hr>
<h2 id="access">Accessibilité universelle</h2>
<p>Une URL, et votre application est accessible depuis n'importe quel appareil connecté. Smartphone, tablette, PC, TV connectée — <strong>un seul déploiement les atteint tous</strong>.</p>
<ul>
  <li><strong>Aucun téléchargement requis</strong></li>
  <li><strong>Aucune friction à l'entrée</strong></li>
  <li><strong>Partage instantané</strong> via un simple lien</li>
</ul>
<div class="callout">
  <strong>Chiffre clé :</strong> En Afrique subsaharienne, plus de 60% des accès Internet se font depuis des smartphones Android d'entrée de gamme. Une application web légère atteint cette audience là où une app native lourde échouerait.
</div>
<hr>
<h2 id="couts">Coûts et délais réduits</h2>
<h3>Un seul codebase, toutes les plateformes</h3>
<p>Fini le budget multiplié par deux pour iOS et Android. Une mise à jour web se déploie en quelques minutes pour tous les utilisateurs simultanément.</p>
<h3>Hébergement compétitif</h3>
<p>Les solutions d'hébergement modernes (VPS, Forge + DigitalOcean pour Laravel) permettent de démarrer avec moins de 20$/mois et de scaler progressivement.</p>
<div class="callout callout-ok">
  <strong>ROI concret :</strong> Pour un budget de 3 000 000 FCFA, une application web Laravel bien architecturée peut livrer une solution complète en 3 à 4 mois. Le même budget divisé pour iOS + Android produirait une application beaucoup plus limitée.
</div>
<hr>
<h2 id="seo">SEO et visibilité organique</h2>
<p>Une application web est <strong>indexable par les moteurs de recherche</strong>. Google peut analyser votre contenu et vous positionner dans les résultats — un levier d'acquisition gratuit et puissant sur le long terme.</p>
<h3>Les bases du SEO web</h3>
<ul>
  <li><strong>URLs parlantes</strong> et structurées</li>
  <li><strong>Balises meta</strong> optimisées par page</li>
  <li><strong>Temps de chargement</strong> rapide (Core Web Vitals)</li>
  <li><strong>Contenu textuel</strong> riche et accessible</li>
</ul>
<hr>
<h2 id="evolution">Évolutivité et maintenance</h2>
<p>Avec Laravel, les migrations de base de données et l'architecture MVC permettent d'ajouter des fonctionnalités sans casser l'existant. Tous vos utilisateurs utilisent toujours la dernière version — plus de gestion de compatibilité rétroactive.</p>
<div class="callout callout-warn">
  <strong>Attention :</strong> L'évolutivité du web ne dispense pas d'une bonne architecture initiale. Un projet mal structuré dès le départ sera difficile à faire évoluer, quelle que soit la technologie.
</div>
<hr>
<h2 id="securite">Sécurité et conformité</h2>
<p>Laravel intègre des mécanismes de sécurité par défaut :</p>
<ul>
  <li><strong>CSRF protection</strong> activée par défaut</li>
  <li><strong>XSS prevention</strong> via l'échappement automatique</li>
  <li><strong>SQL injection protection</strong> via Eloquent ORM</li>
  <li><strong>HTTPS</strong> avec Let's Encrypt (gratuit et automatique)</li>
</ul>
<hr>
<h2 id="conclusion-w">Conclusion</h2>
<p>En 2026, le web est la plateforme de développement la plus mature, la plus accessible et souvent la plus rentable. Choisissez le web <strong>par défaut</strong>, et n'optez pour une app native que lorsqu'un besoin spécifique le justifie réellement. Pour la grande majorité des projets — outils métier, SaaS, marketplaces, applications de gestion — le web est la réponse.</p>
HTML,
        ],

        // ─── Ajoutez vos nouveaux articles ici ───

    ];

    abort_if(! isset($posts[$slug]), 404);

    $comments = \App\Models\Comment::where('post_slug', $slug)
        ->latest()
        ->get(['id', 'name', 'body', 'created_at'])
        ->map(fn($c) => [
            'name' => $c->name,
            'text' => $c->body,
            'date' => $c->created_at->format('d/m/Y'),
        ]);

    $related = collect($posts)
        ->filter(fn($p) => $p['slug'] !== $slug)
        ->take(2)->values()
        ->map(fn($p) => [
            'slug'     => $p['slug'],
            'title'    => $p['title'],
            'category' => $p['category'],
            'color'    => $p['color'],
            'readTime' => $p['readTime'],
        ])->all();

    return Inertia::render('BlogPost', [
        'post'         => $posts[$slug],
        'relatedPosts' => $related,
        'comments'     => $comments,
    ]);

})->name('blog.show');

/*
|--------------------------------------------------------------------------
|  BLOG — enregistrer un commentaire
|--------------------------------------------------------------------------
*/
Route::post('/blog/{slug}/comments', function (Request $request, string $slug) {

    $data = $request->validate([
        'name'  => ['required', 'string', 'max:128'],
        'email' => ['required', 'email', 'max:128'],
        'text'  => ['required', 'string', 'min:5', 'max:500'],
    ], [
        'name.required'  => 'Votre nom est requis.',
        'email.required' => "L'email est requis.",
        'email.email'    => 'Email invalide.',
        'text.required'  => 'Le commentaire est requis.',
        'text.min'       => 'Commentaire trop court.',
        'text.max'       => 'Maximum 500 caractères.',
    ]);

    \App\Models\Comment::create([
        'post_slug' => $slug,
        'name'      => $data['name'],
        'email'     => $data['email'],
        'body'      => $data['text'],
    ]);

    $comments = \App\Models\Comment::where('post_slug', $slug)
        ->latest()
        ->get(['id', 'name', 'body', 'created_at'])
        ->map(fn($c) => [
            'name' => $c->name,
            'text' => $c->body,
            'date' => $c->created_at->format('d/m/Y'),
        ]);

    return response()->json(['comments' => $comments]);

})->name('comments.store');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/
Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name'    => ['required', 'string', 'max:128'],
        'email'   => ['required', 'email', 'max:128'],
        'subject' => ['required', 'string', 'max:256'],
        'budget'  => ['nullable', 'string', 'max:64'],
        'message' => ['required', 'string', 'min:10', 'max:2000'],
    ], [
        'name.required'    => 'Votre nom est requis.',
        'email.required'   => 'Votre adresse email est requise.',
        'email.email'      => "L'adresse email n'est pas valide.",
        'subject.required' => 'Le sujet est requis.',
        'message.required' => 'Le message est requis.',
        'message.min'      => 'Le message doit contenir au moins 10 caractères.',
    ]);
    try {
        Mail::send([], [], function ($mail) use ($data) {
            $mail->to('mrrosnel6@gmail.com', 'Rosnel Pacely')
                 ->replyTo($data['email'], $data['name'])
                 ->subject('📬 [Portfolio] ' . $data['subject'])
                 ->html(contactHtmlBody($data));
        });
    } catch (\Exception $e) {
        return back()->withErrors(['global' => "Erreur d'envoi. Écrivez à mrrosnel6@gmail.com"]);
    }
    return back()->with('success', true);
})->name('contact.send');

/*
|--------------------------------------------------------------------------
| PROJETS
|--------------------------------------------------------------------------
*/
Route::get('/projets/{slug}', function (string $slug) {
    $projects = [
        'taskflow' => [
            'slug' => 'taskflow', 'title' => 'TaskFlow',
            'tagline' => 'Plateforme de gestion de projets informatiques pour ingénieurs ITI.',
            'description' => '<p><strong>TaskFlow</strong> est une application web complète développée avec <strong>Laravel</strong> et <strong>Bootstrap</strong>.</p><p>Elle permet de planifier des projets, assigner des tâches et suivre l\'avancement en temps réel.</p>',
            'year' => '2026', 'color' => '#E53E3E',
            'tags' => ['Laravel', 'Blade', 'MySQL', 'Bootstrap'],
            'demo' => 'https://taskflow.ipmbtpe.cm/',
            'github' => 'https://github.com/rosnel20/app_formation',
            'client' => 'Projet personnel', 'duration' => '4 mois', 'role' => 'Développeur Full-Stack',
            'screenshots' => ['/images/taskflow.png','/images/connexion.png','/images/inscription.png','/images/tableau.png','/images/projet.png','/images/tache.png'],
            'stats' => [['val'=>'5K+','label'=>'Projets gérés'],['val'=>'10K+','label'=>'Tâches complétées'],['val'=>'98%','label'=>'Satisfaction'],['val'=>'24/7','label'=>'Disponibilité']],
            'features' => [
                ['title'=>'Gestion des tâches','desc'=>'Créez, assignez et suivez vos tâches.','icon'=>'<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>'],
                ['title'=>'Suivi temps réel','desc'=>'Tableaux de bord avec graphiques.','icon'=>'<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'],
                ['title'=>'Collaboration','desc'=>"Invitez et partagez en temps réel.",'icon'=>'<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>'],
                ['title'=>'Sécurité','desc'=>'Auth, rôles et permissions.','icon'=>'<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>'],
            ],
            'stack' => [
                ['name'=>'Laravel','role'=>'Backend','logo'=>'https://cdn.simpleicons.org/laravel/FF2D20'],
                ['name'=>'MySQL','role'=>'Base de données','logo'=>'https://cdn.simpleicons.org/mysql/4479A1'],
                ['name'=>'Bootstrap','role'=>'Styling','logo'=>'https://cdn.simpleicons.org/bootstrap/7952B3'],
            ],
        ],
    ];
    abort_if(! isset($projects[$slug]), 404);
    $others = collect($projects)->filter(fn($p) => $p['slug'] !== $slug)->values()
        ->map(fn($p) => ['slug'=>$p['slug'],'title'=>$p['title'],'tagline'=>$p['tagline'],'color'=>$p['color'],'tags'=>$p['tags']])->all();
    return Inertia::render('ProjectShow', ['project'=>$projects[$slug],'otherProjects'=>$others]);
})->name('project.show');

/*
|--------------------------------------------------------------------------
| Helper email
|--------------------------------------------------------------------------
*/
if (! function_exists('contactHtmlBody')) {
    function contactHtmlBody(array $data): string {
        $n=htmlspecialchars($data['name']); $e=htmlspecialchars($data['email']);
        $s=htmlspecialchars($data['subject']); $b=htmlspecialchars($data['budget']??'Non précisé');
        $m=nl2br(htmlspecialchars($data['message']));
        return <<<HTML
<!DOCTYPE html><html><head><meta charset="UTF-8"><style>
body{font-family:'Segoe UI',sans-serif;background:#0A0A0A;color:#F0F0F0;margin:0;}
.w{max-width:580px;margin:40px auto;background:#111;border:1px solid #222;border-radius:16px;overflow:hidden;}
.h{background:#E53E3E;padding:24px 28px;}.h h1{margin:0;font-size:1.15rem;color:#fff;font-weight:800;}
.b{padding:24px 28px;}.r{margin-bottom:14px;}.l{font-size:.68rem;color:#666;text-transform:uppercase;letter-spacing:.1em;margin-bottom:3px;font-family:monospace;}
.v{font-size:.9rem;color:#F0F0F0;}.m{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:12px;line-height:1.7;font-size:.88rem;color:#ccc;}
.f{border-top:1px solid #1a1a1a;padding:12px 28px;font-size:.72rem;color:#555;}a{color:#E53E3E;}
</style></head><body><div class="w">
<div class="h"><h1>📬 Nouveau message · rosnel.dev</h1></div>
<div class="b">
<div class="r"><div class="l">Nom</div><div class="v">{$n}</div></div>
<div class="r"><div class="l">Email</div><div class="v"><a href="mailto:{$e}">{$e}</a></div></div>
<div class="r"><div class="l">Sujet</div><div class="v">{$s}</div></div>
<div class="r"><div class="l">Budget</div><div class="v">{$b}</div></div>
<div class="r"><div class="l">Message</div><div class="m">{$m}</div></div>
</div><div class="f">Portfolio rosnel.dev</div></div></body></html>
HTML;
    }
}