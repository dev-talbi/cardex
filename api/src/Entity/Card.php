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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rarity = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $set = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isHolo = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isReverseHolo = null;

    #[ORM\Column(nullable: true)]
    private ?float $avg1Price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pictureUrl = null;

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

    public function getRarity(): ?string
    {
        return $this->rarity;
    }

    public function setRarity(?string $rarity): static
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSet(): ?string
    {
        return $this->set;
    }

    public function setSet(?string $set): static
    {
        $this->set = $set;

        return $this;
    }

    public function isIsHolo(): ?bool
    {
        return $this->isHolo;
    }

    public function setIsHolo(?bool $isHolo): static
    {
        $this->isHolo = $isHolo;

        return $this;
    }

    public function isIsReverseHolo(): ?bool
    {
        return $this->isReverseHolo;
    }

    public function setIsReverseHolo(?bool $isReverseHolo): static
    {
        $this->isReverseHolo = $isReverseHolo;

        return $this;
    }

    public function getAvg1Price(): ?float
    {
        return $this->avg1Price;
    }

    public function setAvg1Price(?float $avg1Price): static
    {
        $this->avg1Price = $avg1Price;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): static
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }
}
