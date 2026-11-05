# TP1 - Hackathon : mise en place de l'ORM (Object Relational Mapping)

## Prérequis
- PHP 8.5.4, Composer 2.9.5, Symfony CLI
- MySQL 8.4

## Installation

```bash
git clone [URL du dépôt]
cd hackathon
composer install
```

Créer un fichier `.env.local` avec :

```
DATABASE_URL="mysql://user_hack:[mot_de_passe]@127.0.0.1:3306/Hackathon?serverVersion=8.4.0&charset=utf8mb4"
```

Valeurs à adapter selon votre configuration.

En option : créer la base si celle-ci n'existe pas

```bash
php bin/console doctrine:database:create
```

## Entités

| Entité | Attributs principaux |
|---|---|
| Hackathon | dateHeureDebut, dateHeureFin, lieu, ville, theme, affiche, objectifs |

## Fixtures

Le jeu d'essai est défini dans `src/DataFixtures/HackathonFixtures.php` : 5 hackathons dans 5 villes bretonnes.

## Base de données et jeux d'essai (fixtures)

```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

## Test d'interrogation

Requête :

```bash
php bin/console dbal:run-sql "SELECT * FROM hackathon LIMIT 5"
```

Résultat (extrait) :

```
 ---- --------------------- --------------------- --------- -------------- ---------------- -------------- --------------------------------- 
  id   date_heure_debut      date_heure_fin        lieu      ville          theme            affiche        objectifs                        
 ---- --------------------- --------------------- --------- -------------- ---------------- -------------- --------------------------------- 
  1    2026-11-05 09:00:00   2026-11-07 18:00:00   Salle 0   Rennes         Thème numéro 0   affiche0.png   Objectifs du hackathon numéro 0  
  2    2026-11-12 09:00:00   2026-11-14 18:00:00   Salle 1   Brest          Thème numéro 1   affiche1.png   Objectifs du hackathon numéro 1  
  3    2026-11-19 09:00:00   2026-11-21 18:00:00   Salle 2   Saint-Brieuc   Thème numéro 2   affiche2.png   Objectifs du hackathon numéro 2  
 ---- --------------------- --------------------- --------- -------------- ---------------- -------------- --------------------------------- 
```

## Difficultés rencontrées

Les premières commandes Composer ont été exécutées dans le mauvais dossier. Il a donc fallu nettoyer et recréer le projet. En classe, j'avais sauvegardé mon travail sur ma clé USB afin de pouvoir le terminer à la maison. Cependant, ma clé USB étant défectueuse, j'ai dû recommencer le projet depuis le début.
