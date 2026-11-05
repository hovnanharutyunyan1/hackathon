<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $projets = $manager->getRepository(Projet::class)->findAll();

        $data = [
            ['Les Hackers Bretons', 'https://github.com/hackers-bretons/prototype'],
            ['Code Armor', 'https://github.com/code-armor/prototype'],
            ['Team Breizh', null],
        ];

        foreach ($data as $i => [$nom, $lien]) {
            $e = new Equipe();
            $e->setNom($nom);
            $e->setLienPrototype($lien);
            $e->setProjet($projets[$i % count($projets)]);
            $manager->persist($e);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProjetFixtures::class];
    }
}
