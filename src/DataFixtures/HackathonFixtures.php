<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HackathonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $villes = ['Rennes', 'Brest', 'Saint-Brieuc', 'Lorient', 'Vannes'];

        for ($i = 0; $i < 5; $i++) {
            $hack = new Hackathon();
            $hack->setDateHeureDebut(new \DateTime("+$i week 09:00"));
            $hack->setDateHeureFin(new \DateTime("+$i week +2 days 18:00"));
            $hack->setLieu("Salle $i");
            $hack->setVille($villes[$i]);
            $hack->setTheme("Thème numéro $i");
            $hack->setAffiche("affiche$i.png");
            $hack->setObjectifs("Objectifs du hackathon numéro $i");

            $manager->persist($hack);
        }

        $manager->flush();
    }
}
