<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nimi;

    /**
     * @ORM\Column(type="integer")
     */
    private $hinta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qty;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $kategoria;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $artesaani;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNimi(): ?string
    {
        return $this->nimi;
    }

    public function setNimi(string $nimi): self
    {
        $this->nimi = $nimi;

        return $this;
    }

    public function getHinta(): ?int
    {
        return $this->hinta;
    }

    public function setHinta(int $hinta): self
    {
        $this->hinta = $hinta;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getKategoria(): ?string
    {
        return $this->kategoria;
    }

    public function setKategoria(?string $kategoria): self
    {
        $this->kategoria = $kategoria;

        return $this;
    }

    public function getArtesaani(): ?string
    {
        return $this->artesaani;
    }

    public function setArtesaani(?string $artesaani): self
    {
        $this->artesaani = $artesaani;

        return $this;
    }
}
