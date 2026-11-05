<?php

namespace App\Entity;

use App\Repository\MembreJuryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreJuryRepository::class)]
class MembreJury extends Membre
{
}
