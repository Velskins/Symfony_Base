<?php

namespace App\Entity;

use App\Repository\CitationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CitationRepository::class)]
class Citation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Le texte de la citation est obligatoire.')]
    #[Assert\Length(min: 5, minMessage: 'La citation doit faire au moins {{ limit }} caractères.')]
    private ?string $texte = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'auteur est obligatoire.")]
    #[Assert\Length(max: 255, maxMessage: "L'auteur ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $auteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAjout = null;

    #[ORM\Column(length: 100)]
    private ?string $categorie = null;

    #[ORM\Column(length: 10)]
    private ?string $langue = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min: 1, max: 5, notInRangeMessage: 'La note doit être comprise entre {{ min }} et {{ max }}.')]
    private ?int $note = null;

    #[ORM\Column]
    private ?bool $favori = false;

    public function __construct()
    {
        $this->dateAjout = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): static
    {
        $this->texte = $texte;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeImmutable
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeImmutable $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function isFavori(): ?bool
    {
        return $this->favori;
    }

    public function setFavori(bool $favori): static
    {
        $this->favori = $favori;

        return $this;
    }
}
