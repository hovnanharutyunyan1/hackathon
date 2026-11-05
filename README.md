# TP1 - Hackathon : mise en place de l'ORM (Doctrine)

## Prérequis
PHP 8.5, Composer, Symfony CLI, MySQL 8.4

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

Créer un fichier `.env.local` (non versionné) :

```
DATABASE_URL="mysql://user_hack:[mot_de_passe]@127.0.0.1:3306/Hackathon?serverVersion=8.4.0&charset=utf8mb4"
```

Créer les tables et charger les données de test :

```bash
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

## Entités (`src/Entity/`)

Hackathon, Organisateur, Projet, Equipe, Inscription, Membre, Participant, MembreJury, Notation.

Relations :
- Hackathon 1—N Inscription
- Hackathon 1—N Projet
- Projet 1—N Equipe
- Equipe 1—N Inscription
- Participant 1—N Inscription
- Participant et MembreJury héritent de Membre (héritage `JOINED`)

Organisateur et Notation n'ont pas encore de relation.

Les migrations sont dans `migrations/` et les fixtures dans `src/DataFixtures/`.

## Test d'interrogation

```bash
php bin/console dbal:run-sql "SELECT i.num, i.competence, h.ville, e.nom AS equipe FROM inscription i JOIN hackathon h ON h.id = i.hackathon_id LEFT JOIN equipe e ON e.id = i.equipe_id"
```

![Résultat de la requête](docs/capture.png)

## Difficultés rencontrées

Les premières commandes Composer ont été exécutées dans le mauvais dossier. Il a donc fallu nettoyer et recréer le projet. En classe, j'avais sauvegardé mon travail sur ma clé USB afin de pouvoir le terminer à la maison. Cependant, ma clé USB étant défectueuse, j'ai dû recommencer le projet depuis le début.
