<?php

namespace App\DataFixtures;

use App\Entity\Organisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['Association', 'Hackat\'Innov', 'https://hackatinnov.fr', 'contact@hackatinnov.fr'],
            ['Entreprise', 'Rennes Tech', 'https://rennestech.fr', 'info@rennestech.fr'],
            ['Ecole', 'Lycée Dupuy', null, 'sio@lycee-dupuy.fr'],
        ];

        foreach ($data as [$statut, $nom, $site, $email]) {
            $o = new Organisateur();
            $o->setStatut($statut);
            $o->setNom($nom);
            $o->setSiteWeb($site);
            $o->setEmail($email);
            $manager->persist($o);
        }

        $manager->flush();
    }
}
