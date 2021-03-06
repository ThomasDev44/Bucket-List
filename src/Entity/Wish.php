<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="wish")
 */
#[ORM\Entity(repositoryClass: WishRepository::class)]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(max: "250", maxMessage: "Trop long")]
    #[ORM\Column(type: 'string', length: 250)]
    private $title;

    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(max: "250", maxMessage: "Trop long")]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(max: "50", maxMessage: "Trop long")]
    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[ORM\Column(type: 'boolean')]
    private $isPublished;

    #[ORM\Column(type: 'datetime')]
    private $dateCreated;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'wishes')]
    private $categorie;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }


    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    public function __construct(){
        $this->dateCreated = new \DateTime();
        $this->isPublished = true;
    }

    public function getCategorie(): ?Category
    {
        return $this->categorie;
    }

    public function setCategorie(?Category $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function __toString(): string
    {
        return $this->categorie;
    }


}
