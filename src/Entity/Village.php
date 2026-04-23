<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'village')]
class Village
{
    #[ORM\Id]
    #[ORM\GeneratedValue] 
    #[ORM\Column(name: "num_village", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "nom_village", length: 50)]
    private ?string $nomVillage = null;

    #[ORM\ManyToOne(targetEntity: Commune::class)]
    #[ORM\JoinColumn(name: "num_commune", referencedColumnName: "num_commune")]
    private ?Commune $commune = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVillage(): ?string
    {
        return $this->nomVillage;
    }

    public function setNomVillage(string $nomVillage): self
    {
        $this->nomVillage = $nomVillage;
        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;
        return $this;
    }
}