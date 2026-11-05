<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['Application de covoiturage pour étudiants', true],
            ['Plateforme de dons alimentaires', true],
            ['Jeu éducatif sur le recyclage', false],
        ];

        foreach ($data as [$description, $retenu]) {
            $p = new Projet();
            $p->setDescription($description);
            $p->setRetenu($retenu);
            $manager->persist($p);
        }

        $manager->flush();
    }
}
