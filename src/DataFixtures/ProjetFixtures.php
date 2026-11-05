<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $hackathons = $manager->getRepository(Hackathon::class)->findAll();

        $data = [
            ['Application de covoiturage pour étudiants', true],
            ['Plateforme de dons alimentaires', true],
            ['Jeu éducatif sur le recyclage', false],
        ];

        foreach ($data as $i => [$description, $retenu]) {
            $p = new Projet();
            $p->setDescription($description);
            $p->setRetenu($retenu);
            $p->setHackathon($hackathons[$i % count($hackathons)]);
            $manager->persist($p);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [HackathonFixtures::class];
    }
}
