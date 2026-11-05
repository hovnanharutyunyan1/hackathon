<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EquipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['Les Hackers Bretons', 'https://github.com/hackers-bretons/prototype'],
            ['Code Armor', 'https://github.com/code-armor/prototype'],
            ['Team Breizh', null],
        ];

        foreach ($data as [$nom, $lien]) {
            $e = new Equipe();
            $e->setNom($nom);
            $e->setLienPrototype($lien);
            $manager->persist($e);
        }

        $manager->flush();
    }
}
