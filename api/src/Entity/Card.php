<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ApiResource]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $tcgId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPossed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTcgId(): ?string
    {
        return $this->tcgId;
    }

    public function setTcgId(string $tcgId): static
    {
        $this->tcgId = $tcgId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isIsPossed(): ?bool
    {
        return $this->isPossed;
    }

    public function setIsPossed(?bool $isPossed): static
    {
        $this->isPossed = $isPossed;

        return $this;
    }
}
