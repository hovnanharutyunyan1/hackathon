# TP1 - Hackathon : mise en place de l'ORM (Object Relational Mapping)

## Prérequis
- PHP 8.5.4, Composer 2.9.5, Symfony CLI
- MySQL 8.4

## Installation

```bash
git clone https://github.com/hovnanharutyunyan1/hackathon.git
cd hackathon
composer install
```

Créer la base et l'utilisateur dans MySQL :

```sql
CREATE DATABASE Hackathon;
CREATE USER 'user_hack'@'localhost' IDENTIFIED BY '[mot_de_passe]';
GRANT ALL PRIVILEGES ON Hackathon.* TO 'user_hack'@'localhost';
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
| Organisateur | statut, nom, siteWeb, email |
| Projet | description, retenu |
| Equipe | nom, lienPrototype |
| Inscription | num, date, competence |
| Membre | nom, prenom, email, telephone |
| Participant (hérite de Membre) | dateNaissance, lienPortfolio |
| MembreJury (hérite de Membre) | |
| Notation | note |

Relations :
- Hackathon 1—N Inscription
- Hackathon 1—N Projet
- Projet 1—N Equipe
- Equipe 1—N Inscription
- Participant 1—N Inscription
- Participant et MembreJury héritent de Membre (héritage `JOINED`)

Organisateur et Notation n'ont pas encore de relation.

## Fixtures

Le jeu d'essai est défini dans `src/DataFixtures/` (Hackathon, Organisateur, Membre, Projet, Equipe, Inscription). Les fixtures respectent les relations : chaque projet est rattaché à un hackathon, chaque équipe à un projet, chaque inscription à un hackathon, un participant et une équipe.

## Base de données et jeux d'essai (fixtures)

Appliquer les migrations (dossier `migrations/`) et charger le jeu d'essai :

```bash
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

## Test d'interrogation

Requête :

```bash
php bin/console dbal:run-sql "SELECT i.num, i.competence, h.ville, e.nom AS equipe FROM inscription i JOIN hackathon h ON h.id = i.hackathon_id LEFT JOIN equipe e ON e.id = i.equipe_id"
```

Résultat (extrait) :

```
 ----- ------------------- -------------- --------------------- 
  num   competence          ville          equipe               
 ----- ------------------- -------------- --------------------- 
  1     Développement web   Rennes         Les Hackers Bretons  
  2     Graphisme           Brest          Code Armor           
  3     Communication       Saint-Brieuc   Team Breizh          
 ----- ------------------- -------------- --------------------- 
```

![Capture du résultat](docs/capture.png)

## Difficultés rencontrées

Les premières commandes Composer ont été exécutées dans le mauvais dossier. Il a donc fallu nettoyer et recréer le projet. En classe, j'avais sauvegardé mon travail sur ma clé USB afin de pouvoir le terminer à la maison. Cependant, ma clé USB étant défectueuse, j'ai dû recommencer le projet depuis le début.
