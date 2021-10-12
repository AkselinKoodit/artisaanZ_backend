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
     * @ORM\Column(type="array")
     */
    private $kuva = [];

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nimi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kuvaus;

    /**
     * @ORM\Column(type="integer")
     */
    private $hinta;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $artesaani;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $kategoria;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKuva(): ?array
    {
        return $this->kuva;
    }

    public function setKuva(array $kuva): self
    {
        $this->kuva = $kuva;

        return $this;
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

    public function getKuvaus(): ?string
    {
        return $this->kuvaus;
    }

    public function setKuvaus(string $kuvaus): self
    {
        $this->kuvaus = $kuvaus;

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

    public function getArtesaani(): ?string
    {
        return $this->artesaani;
    }

    public function setArtesaani(string $artesaani): self
    {
        $this->artesaani = $artesaani;

        return $this;
    }

    public function getKategoria(): ?string
    {
        return $this->kategoria;
    }

    public function setKategoria(string $kategoria): self
    {
        $this->kategoria = $kategoria;

        return $this;
    }
}