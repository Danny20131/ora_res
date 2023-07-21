<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToMany(targetEntity: Employer::class, mappedBy: 'commentaire')]
    private Collection $employers;

    public function __construct()
    {
        $this->employers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, Employer>
     */
    public function getEmployers(): Collection
    {
        return $this->employers;
    }

    public function addEmployer(Employer $employer): static
    {
        if (!$this->employers->contains($employer)) {
            $this->employers->add($employer);
            $employer->addCommentaire($this);
        }

        return $this;
    }

    public function removeEmployer(Employer $employer): static
    {
        if ($this->employers->removeElement($employer)) {
            $employer->removeCommentaire($this);
        }

        return $this;
    }
}
