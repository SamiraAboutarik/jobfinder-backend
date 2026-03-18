<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title'       => 'Développeur React Senior',
                'company'     => 'TechMaroc',
                'logo'        => 'TM',
                'color'       => '#6366f1',
                'city'        => 'Casablanca',
                'salary'      => 18000,
                'type'        => 'CDI',
                'description' => 'Rejoignez notre équipe pour construire des apps React modernes avec TypeScript et GraphQL.',
                'tags'        => ['React', 'TypeScript', 'GraphQL'],
            ],
            [
                'title'       => 'Laravel Backend Dev',
                'company'     => 'Digiteam',
                'logo'        => 'DG',
                'color'       => '#f59e0b',
                'city'        => 'Rabat',
                'salary'      => 15000,
                'type'        => 'CDI',
                'description' => 'Développement d\'APIs RESTful robustes avec Laravel 11, MySQL et Redis.',
                'tags'        => ['Laravel', 'MySQL', 'API REST'],
            ],
            [
                'title'       => 'Full Stack Developer',
                'company'     => 'Inwi Digital',
                'logo'        => 'IN',
                'color'       => '#10b981',
                'city'        => 'Casablanca',
                'salary'      => 22000,
                'type'        => 'CDI',
                'description' => 'Stack complète React + Node.js pour notre plateforme de services digitaux.',
                'tags'        => ['React', 'Node.js', 'MongoDB'],
            ],
            [
                'title'       => 'UI/UX Designer',
                'company'     => 'CreativeHub',
                'logo'        => 'CH',
                'color'       => '#ec4899',
                'city'        => 'Agadir',
                'salary'      => 12000,
                'type'        => 'Freelance',
                'description' => 'Design d\'interfaces modernes pour nos clients internationaux, Figma + Tailwind.',
                'tags'        => ['Figma', 'UI/UX', 'Tailwind'],
            ],
            [
                'title'       => 'DevOps Engineer',
                'company'     => 'CloudSys MA',
                'logo'        => 'CS',
                'color'       => '#3b82f6',
                'city'        => 'Marrakech',
                'salary'      => 20000,
                'type'        => 'CDI',
                'description' => 'CI/CD, Docker, Kubernetes sur Azure. Automatisation et monitoring des déploiements.',
                'tags'        => ['Docker', 'CI/CD', 'Azure'],
            ],
            [
                'title'       => 'Data Analyst Junior',
                'company'     => 'DataMinds',
                'logo'        => 'DM',
                'color'       => '#8b5cf6',
                'city'        => 'Rabat',
                'salary'      => 10000,
                'type'        => 'Stage',
                'description' => 'Analyse de données, dashboards Power BI et Python pour nos clients enterprise.',
                'tags'        => ['Python', 'Power BI', 'SQL'],
            ],
            [
                'title'       => 'Mobile Developer Flutter',
                'company'     => 'AppFactory',
                'logo'        => 'AF',
                'color'       => '#06b6d4',
                'city'        => 'Casablanca',
                'salary'      => 16000,
                'type'        => 'CDD',
                'description' => 'Création d\'apps Flutter cross-platform avec intégration Firebase et API REST.',
                'tags'        => ['Flutter', 'Dart', 'Firebase'],
            ],
            [
                'title'       => 'Développeur PHP/Symfony',
                'company'     => 'WebCraft',
                'logo'        => 'WC',
                'color'       => '#f97316',
                'city'        => 'Agadir',
                'salary'      => 13000,
                'type'        => 'CDI',
                'description' => 'Maintenance et évolution d\'applications Symfony 6 pour secteur e-commerce.',
                'tags'        => ['PHP', 'Symfony', 'MySQL'],
            ],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
