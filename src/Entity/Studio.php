<?php

namespace App\Entity;

use App\Repository\StudioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudioRepository::class)]
#[ORM\Table(name: 'studio')] 
class Studio
{
    #[ORM\Id]
    #[ORM\GeneratedValue] 
    #[ORM\Column(name: "num_studio", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "nom_studio", length: 50)]
    private ?string $nomStudio = null;

    #[ORM\Column(name: "nb_places_studio")]
    private ?int $nbPlacesStudio = null;

    #[ORM\Column(name: "prix_saison_studio", type: "decimal", precision: 8, scale: 2)]
    private ?string $prixSaisonStudio = null;

    #[ORM\Column(name: "prix_hors_saison_studio", type: "decimal", precision: 8, scale: 2)]
    private ?string $prixHorsSaisonStudio = null;

    #[ORM\ManyToOne(targetEntity: Village::class)]
    #[ORM\JoinColumn(name: "num_village", referencedColumnName: "num_village")]
    private ?Village $village = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStudio(): ?string
    {
        return $this->nomStudio;
    }

    public function setNomStudio(string $nomStudio): self
    {
        $this->nomStudio = $nomStudio;
        return $this;
    }

    public function getNbPlacesStudio(): ?int
    {
        return $this->nbPlacesStudio;
    }

    public function setNbPlacesStudio(int $nbPlacesStudio): self
    {
        $this->nbPlacesStudio = $nbPlacesStudio;
        return $this;
    }

    public function getPrixSaisonStudio(): ?string
    {
        return $this->prixSaisonStudio;
    }

    public function setPrixSaisonStudio(string $prixSaisonStudio): self
    {
        $this->prixSaisonStudio = $prixSaisonStudio;
        return $this;
    }

    public function getPrixHorsSaisonStudio(): ?string
    {
        return $this->prixHorsSaisonStudio;
    }

    public function setPrixHorsSaisonStudio(string $prixHorsSaisonStudio): self
    {
        $this->prixHorsSaisonStudio = $prixHorsSaisonStudio;
        return $this;
    }

    public function getVillage(): ?Village
    {
        return $this->village;
    }

    public function setVillage(?Village $village): self
    {
        $this->village = $village;
        return $this;
    }
}