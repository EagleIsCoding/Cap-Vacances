<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'commune')]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue] // À retirer si num_commune n'est pas auto-incrémenté
    #[ORM\Column(name: "num_commune", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "cp_commune", length: 10)]
    private ?string $cpCommune = null;

    #[ORM\Column(name: "nom_commune", length: 50)]
    private ?string $nomCommune = null;

    #[ORM\ManyToOne(targetEntity: Departement::class)]
    #[ORM\JoinColumn(name: "num_departement", referencedColumnName: "num_departement")]
    private ?Departement $departement = null;

    // --- GETTERS ET SETTERS ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpCommune(): ?string
    {
        return $this->cpCommune;
    }

    public function setCpCommune(string $cpCommune): self
    {
        $this->cpCommune = $cpCommune;
        return $this;
    }

    public function getNomCommune(): ?string
    {
        return $this->nomCommune;
    }

    public function setNomCommune(string $nomCommune): self
    {
        $this->nomCommune = $nomCommune;
        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;
        return $this;
    }
}