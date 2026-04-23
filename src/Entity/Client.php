<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\Table(name: 'client')]
class Client
{
    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class)]
    #[ORM\JoinColumn(name: "id_user", referencedColumnName: "id", nullable: false)]
    private ?User $user = null;

    #[ORM\Column(name: "nom_client", length: 50, nullable: true)]
    private ?string $nomClient = null;

    #[ORM\Column(name: "prenom_client", length: 50, nullable: true)]
    private ?string $prenomClient = null;

    #[ORM\Column(name: "rue_client", length: 100, nullable: true)]
    private ?string $rueClient = null;

    /**
     * Pour récupérer l'ID, on passe par l'objet User
     */
    public function getId(): ?int
    {
        return $this->user ? $this->user->getId() : null;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(?string $nomClient): self
    {
        $this->nomClient = $nomClient;
        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(?string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;
        return $this;
    }

    public function getRueClient(): ?string
    {
        return $this->rueClient;
    }

    public function setRueClient(?string $rueClient): self
    {
        $this->rueClient = $rueClient;
        return $this;
    }
}