<?php

namespace App\DataFixtures;

use App\Entity\MembreJury;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $participants = [
            ['Martin', 'Léa', 'lea.martin@example.com', '0601020304', '2005-03-12', 'https://portfolio-lea.fr'],
            ['Durand', 'Tom', 'tom.durand@example.com', null, '2004-07-25', null],
            ['Le Gall', 'Maëlle', 'maelle.legall@example.com', '0605060708', '2006-01-30', 'https://maelle.dev'],
        ];

        foreach ($participants as [$nom, $prenom, $email, $tel, $naissance, $portfolio]) {
            $p = new Participant();
            $p->setNom($nom);
            $p->setPrenom($prenom);
            $p->setEmail($email);
            $p->setTelephone($tel);
            $p->setDateNaissance(new \DateTime($naissance));
            $p->setLienPortfolio($portfolio);
            $manager->persist($p);
        }

        $jury = [
            ['Bernard', 'Sophie', 'sophie.bernard@example.com', '0611223344'],
            ['Kerjean', 'Yann', 'yann.kerjean@example.com', null],
        ];

        foreach ($jury as [$nom, $prenom, $email, $tel]) {
            $j = new MembreJury();
            $j->setNom($nom);
            $j->setPrenom($prenom);
            $j->setEmail($email);
            $j->setTelephone($tel);
            $manager->persist($j);
        }

        $manager->flush();
    }
}
