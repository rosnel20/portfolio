<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/projets/{slug}', function (string $slug) {

    // ═══════════════════════════════════════════════════════
    //  AJOUTER UN PROJET :
    //  Copie le bloc ci-dessous, change le slug et remplis
    //  tous les champs. Le slug doit correspondre à celui
    //  défini dans Home.vue (tableau `projects`).
    //
    //  screenshots : tableau d'URLs d'images.
    //    - Mets tes propres images dans public/images/
    //    - Ou utilise des URLs externes (Unsplash, etc.)
    //
    //  stack : chaque techno avec name, role, logo
    //    Logos via : https://cdn.simpleicons.org/NOM/COULEUR
    // ═══════════════════════════════════════════════════════

    $projects = [

        // ─── TASKFLOW (repo : app_formation) ────────────────
        'taskflow' => [
            'slug'    => 'taskflow',
            'title'   => 'TaskFlow',
            'tagline' => 'Plateforme de gestion de projets informatiques pour ingénieurs ITI.',
            'description' => '
                <p><strong>TaskFlow</strong> est une application web complète dédiée
                à la gestion de projets informatiques. Elle a été développée
                entièrement avec <strong>Laravel</strong> pour le backend et
                <strong>Blade + Bootstrap</strong> pour le frontend — sans framework
                JavaScript côté client.</p>
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
                // Remplace par tes vraies captures d'écran
                // ex: '/images/taskflow-home.png'
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
                [
                    'title' => 'Gestion des tâches',
                    'desc'  => 'Créez, assignez et suivez vos tâches avec priorités et deadlines.',
                    'icon'  => '<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>',
                ],
                [
                    'title' => 'Suivi en temps réel',
                    'desc'  => 'Tableaux de bord avec graphiques de progression automatisés.',
                    'icon'  => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
                ],
                [
                    'title' => 'Collaboration équipe',
                    'desc'  => 'Invitez des membres, partagez et communiquez en temps réel.',
                    'icon'  => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
                ],
                [
                    'title' => 'Sécurité avancée',
                    'desc'  => 'Authentification sécurisée, rôles et permissions granulaires.',
                    'icon'  => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
                ],
            ],
            'stack' => [
                ['name' => 'Laravel',   'role' => 'Backend / MVC', 'logo' => 'https://cdn.simpleicons.org/laravel/FF2D20'],
                ['name' => 'Blade',     'role' => 'Templating',    'logo' => 'https://cdn.simpleicons.org/laravel/FF2D20'],
                ['name' => 'MySQL',     'role' => 'Base de données','logo' => 'https://cdn.simpleicons.org/mysql/4479A1'],
                ['name' => 'Bootstrap', 'role' => 'Styling',       'logo' => 'https://cdn.simpleicons.org/bootstrap/7952B3'],
                ['name' => 'JavaScript','role' => 'Interactions',  'logo' => 'https://cdn.simpleicons.org/javascript/F7DF1E'],
            ],
        ],

        // ─── EXEMPLE : ajoute tes autres projets ici ────────
        // 'mon-projet' => [
        //     'slug'        => 'mon-projet',
        //     'title'       => 'Nom du projet',
        //     'tagline'     => 'Courte description.',
        //     'description' => '<p>Description HTML...</p>',
        //     'year'        => '2024',
        //     'color'       => '#3B82F6',
        //     'tags'        => ['Laravel', 'Vue'],
        //     'demo'        => 'https://...',
        //     'github'      => 'https://github.com/rosnel20/...',
        //     'client'      => 'Client X',
        //     'duration'    => '2 mois',
        //     'role'        => 'Développeur Full-Stack',
        //     'screenshots' => ['/images/projet-1.jpg', '/images/projet-2.jpg'],
        //     'stats'       => [['val' => '100+', 'label' => 'Utilisateurs']],
        //     'features'    => [['title'=>'...','desc'=>'...','icon'=>'...']],
        //     'stack'       => [['name'=>'Laravel','role'=>'Backend','logo'=>'https://cdn.simpleicons.org/laravel/FF2D20']],
        // ],
    ];

    abort_if(! isset($projects[$slug]), 404);

    // Autres projets (sans le courant)
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