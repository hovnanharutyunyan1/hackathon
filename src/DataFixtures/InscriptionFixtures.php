<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [1, '2026-10-01 09:00:00', 'Développement web'],
            [2, '2026-10-02 14:30:00', 'Graphisme'],
            [3, '2026-10-03 10:15:00', 'Communication'],
        ];

        foreach ($data as [$num, $date, $competence]) {
            $i = new Inscription();
            $i->setNum($num);
            $i->setDate(new \DateTime($date));
            $i->setCompetence($competence);
            $manager->persist($i);
        }

        $manager->flush();
    }
}
