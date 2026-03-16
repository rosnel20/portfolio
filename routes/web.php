<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

/**
 * POST /contact — traitement du formulaire.
 *
 * Config requise dans .env :
 *   MAIL_MAILER=smtp
 *   MAIL_HOST=smtp.gmail.com
 *   MAIL_PORT=587
 *   MAIL_ENCRYPTION=tls
 *   MAIL_USERNAME=mrrosnel6@gmail.com
 *   MAIL_PASSWORD=xxxx xxxx xxxx xxxx   ← mot de passe d'application Gmail
 *   MAIL_FROM_ADDRESS=mrrosnel6@gmail.com
 *   MAIL_FROM_NAME="Portfolio Rosnel"
 */
Route::post('/contact', function (Request $request) {

    // ── 1. Validation ──────────────────────────────────────────────────────
    $data = $request->validate([
        'name'    => ['required', 'string', 'max:128'],
        'email'   => ['required', 'email', 'max:128'],
        'subject' => ['required', 'string', 'max:256'],
        'message' => ['required', 'string', 'min:10', 'max:2000'],
    ], [
        // Messages en français
        'name.required'    => 'Votre nom est requis.',
        'name.max'         => 'Le nom ne peut pas dépasser 128 caractères.',
        'email.required'   => 'Votre adresse email est requise.',
        'email.email'      => 'L\'adresse email n\'est pas valide.',
        'subject.required' => 'Le sujet est requis.',
        'subject.max'      => 'Le sujet ne peut pas dépasser 256 caractères.',
        'message.required' => 'Le message est requis.',
        'message.min'      => 'Le message doit contenir au moins 10 caractères.',
        'message.max'      => 'Le message ne peut pas dépasser 2000 caractères.',
    ]);

    // ── 2. Envoi de l'email ────────────────────────────────────────────────
    try {
        Mail::send([], [], function ($mail) use ($data) {
            $mail
                ->to('mrrosnel6@gmail.com', 'Rosnel Pacely')
                ->replyTo($data['email'], $data['name'])
                ->subject('📬 [Portfolio] ' . $data['subject'])
                ->html(contactHtmlBody($data));
        });
    } catch (\Exception $e) {
        // En cas d'erreur SMTP, renvoyer une erreur lisible côté front
        return back()->withErrors([
            'global' => 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou m\'écrire directement à mrrosnel6@gmail.com',
        ]);
    }

    // ── 3. Retour avec flash success ───────────────────────────────────────
    return back()->with('success', true);

})->name('contact.send');

/*
|--------------------------------------------------------------------------
| PROJETS
|--------------------------------------------------------------------------
*/
Route::get('/projets/{slug}', function (string $slug) {

    // ═══════════════════════════════════════════════════════
    //  AJOUTER UN PROJET :
    //  Copie le bloc ci-dessous, change le slug et remplis
    //  tous les champs.
    // ═══════════════════════════════════════════════════════

    $projects = [

        'taskflow' => [
            'slug'    => 'taskflow',
            'title'   => 'TaskFlow',
            'tagline' => 'Plateforme de gestion de projets informatiques pour ingénieurs ITI.',
            'description' => '
                <p><strong>TaskFlow</strong> est une application web complète dédiée
                à la gestion de projets informatiques. Elle a été développée
                entièrement avec <strong>Laravel</strong> pour le backend et
                <strong>Blade + Bootstrap</strong> pour le frontend.</p>
                <p>L\'application permet de planifier des projets, d\'assigner des tâches
                aux membres de l\'équipe, de suivre l\'avancement en temps réel et de
                générer des rapports de progression automatisés.</p>
                <p>Conçue pour les ingénieurs des travaux informatiques (ITI), elle
                offre une interface claire et intuitive adaptée aux besoins
                des équipes techniques.</p>
            ',
            'year'     => '2025',
            'color'    => '#E53E3E',
            'tags'     => ['Laravel', 'Blade', 'MySQL', 'Bootstrap'],
            'demo'     => 'https://taskflow.ipmbtpe.cm/',
            'github'   => 'https://github.com/rosnel20/app_formation',
            'client'   => 'Projet personnel',
            'duration' => '4 mois',
            'role'     => 'Développeur Full-Stack (Laravel)',
            'screenshots' => [
                '/images/taskflow.png',
                '/images/connexion.png',
                '/images/inscription.png',
                '/images/tableau.png',
                '/images/projet.png',
                '/images/tache.png',
            ],
            'stats' => [
                ['val' => '5K+',  'label' => 'Projets gérés'],
                ['val' => '10K+', 'label' => 'Tâches complétées'],
                ['val' => '98%',  'label' => 'Satisfaction'],
                ['val' => '24/7', 'label' => 'Disponibilité'],
            ],
            'features' => [
                ['title' => 'Gestion des tâches',   'desc' => 'Créez, assignez et suivez vos tâches avec priorités et deadlines.', 'icon' => '<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>'],
                ['title' => 'Suivi en temps réel',  'desc' => 'Tableaux de bord avec graphiques de progression automatisés.',      'icon' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'],
                ['title' => 'Collaboration équipe', 'desc' => 'Invitez des membres, partagez et communiquez en temps réel.',       'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                ['title' => 'Sécurité avancée',     'desc' => 'Authentification sécurisée, rôles et permissions granulaires.',    'icon' => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>'],
            ],
            'stack' => [
                ['name' => 'Laravel',    'role' => 'Backend / MVC',  'logo' => 'https://cdn.simpleicons.org/laravel/FF2D20'],
                ['name' => 'Blade',      'role' => 'Templating',     'logo' => 'https://cdn.simpleicons.org/laravel/FF2D20'],
                ['name' => 'MySQL',      'role' => 'Base de données', 'logo' => 'https://cdn.simpleicons.org/mysql/4479A1'],
                ['name' => 'Bootstrap',  'role' => 'Styling',        'logo' => 'https://cdn.simpleicons.org/bootstrap/7952B3'],
                ['name' => 'JavaScript', 'role' => 'Interactions',   'logo' => 'https://cdn.simpleicons.org/javascript/F7DF1E'],
            ],
        ],

        // ─── Ajoute tes autres projets ici ──────────────────
        // 'mon-projet' => [ ... ],
    ];

    abort_if(! isset($projects[$slug]), 404);

    $others = collect($projects)
        ->filter(fn($p) => $p['slug'] !== $slug)
        ->values()
        ->map(fn($p) => [
            'slug'    => $p['slug'],
            'title'   => $p['title'],
            'tagline' => $p['tagline'],
            'color'   => $p['color'],
            'tags'    => $p['tags'],
        ])
        ->all();

    return Inertia::render('ProjectShow', [
        'project'       => $projects[$slug],
        'otherProjects' => $others,
    ]);

})->name('project.show');


/*
|--------------------------------------------------------------------------
| Helper : corps HTML de l'email
|--------------------------------------------------------------------------
*/
if (! function_exists('contactHtmlBody')) {
    function contactHtmlBody(array $data): string
    {
        $name    = htmlspecialchars($data['name']);
        $email   = htmlspecialchars($data['email']);
        $subject = htmlspecialchars($data['subject']);
        $message = nl2br(htmlspecialchars($data['message']));

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><style>
  body { font-family: 'Segoe UI', sans-serif; background:#0A0A0A; color:#F0F0F0; margin:0; padding:0; }
  .wrap { max-width:580px; margin:40px auto; background:#111; border:1px solid #222; border-radius:16px; overflow:hidden; }
  .head { background:#E53E3E; padding:28px 32px; }
  .head h1 { margin:0; font-size:1.3rem; color:#fff; font-weight:800; letter-spacing:-.03em; }
  .head p  { margin:4px 0 0; font-size:.82rem; color:rgba(255,255,255,.7); }
  .body { padding:28px 32px; }
  .row  { margin-bottom:18px; }
  .lbl  { font-size:.7rem; color:#666; text-transform:uppercase; letter-spacing:.1em; margin-bottom:4px; font-family:monospace; }
  .val  { font-size:.95rem; color:#F0F0F0; }
  .msg  { background:#1a1a1a; border:1px solid #2a2a2a; border-radius:10px; padding:16px; line-height:1.75; font-size:.93rem; color:#ccc; }
  .foot { border-top:1px solid #1a1a1a; padding:16px 32px; font-size:.74rem; color:#555; }
  a { color:#E53E3E; }
</style></head>
<body>
<div class="wrap">
  <div class="head">
    <h1>📬 Nouveau message de contact</h1>
    <p>Portfolio rosnel.dev</p>
  </div>
  <div class="body">
    <div class="row">
      <div class="lbl">Nom</div>
      <div class="val">{$name}</div>
    </div>
    <div class="row">
      <div class="lbl">Email</div>
      <div class="val"><a href="mailto:{$email}">{$email}</a></div>
    </div>
    <div class="row">
      <div class="lbl">Sujet</div>
      <div class="val">{$subject}</div>
    </div>
    <div class="row">
      <div class="lbl">Message</div>
      <div class="msg">{$message}</div>
    </div>
  </div>
  <div class="foot">Envoyé depuis le formulaire de contact · rosnel.dev</div>
</div>
</body>
</html>
HTML;
    }
}