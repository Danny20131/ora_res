<?php

namespace App\Entity;

use App\Repository\EmployerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerRepository::class)]
class Employer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEm = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomEm = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\ManyToOne(inversedBy: 'employers')]
    private ?Compte $comptes = null;

    #[ORM\ManyToMany(targetEntity: Commentaire::class, inversedBy: 'employers')]
    private Collection $commentaire;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEm(): ?string
    {
        return $this->NomEm;
    }

    public function setNomEm(string $NomEm): static
    {
        $this->NomEm = $NomEm;

        return $this;
    }

    public function getPrenomEm(): ?string
    {
        return $this->PrenomEm;
    }

    public function setPrenomEm(string $PrenomEm): static
    {
        $this->PrenomEm = $PrenomEm;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getComptes(): ?Compte
    {
        return $this->comptes;
    }

    public function setComptes(?Compte $comptes): static
    {
        $this->comptes = $comptes;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire->add($commentaire);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        $this->commentaire->removeElement($commentaire);

        return $this;
    }
}
