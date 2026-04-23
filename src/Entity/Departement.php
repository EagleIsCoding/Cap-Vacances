<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Departement
{
    #[ORM\Id]
    #[ORM\Column(name: "num_departement", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "nom_departement", length: 50)]
    private ?string $nomDepartement = null;

    public function getId(): ?int { return $this->id; }
    public function getNomDepartement(): ?string { return $this->nomDepartement; }
    public function setNomDepartement(string $nom): self { $this->nomDepartement = $nom; return $this; }
}