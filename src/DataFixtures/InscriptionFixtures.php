<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Hackathon;
use App\Entity\Inscription;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $hackathons = $manager->getRepository(Hackathon::class)->findAll();
        $participants = $manager->getRepository(Participant::class)->findAll();
        $equipes = $manager->getRepository(Equipe::class)->findAll();

        $data = [
            [1, '2026-10-01 09:00:00', 'Développement web'],
            [2, '2026-10-02 14:30:00', 'Graphisme'],
            [3, '2026-10-03 10:15:00', 'Communication'],
        ];

        foreach ($data as $k => [$num, $date, $competence]) {
            $i = new Inscription();
            $i->setNum($num);
            $i->setDate(new \DateTime($date));
            $i->setCompetence($competence);
            $i->setHackathon($hackathons[$k % count($hackathons)]);
            $i->setParticipant($participants[$k % count($participants)]);
            $i->setEquipe($equipes[$k % count($equipes)]);
            $manager->persist($i);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            HackathonFixtures::class,
            MembreFixtures::class,
            EquipeFixtures::class,
        ];
    }
}
