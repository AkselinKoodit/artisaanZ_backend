<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class Seller
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nimi;

    /**
     * @ORM\Column(type="text")
     */
    private $esittely;


    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $password;


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

    public function getEsittely(): ?string
    {
        return $this->esittely;
    }

    public function setEsittely(string $esittely): self
    {
        $this->esittely = $esittely;

        return $this;
    }

//    public function getTuotteet(): ?array
//    {
//        return $this->tuotteet;
//    }
//
//    public function setTuotteet(?array $tuotteet): self
//    {
//        $this->tuotteet = $tuotteet;
//
//        return $this;
//    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function setUsername(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

//    public function getPasswordCheck(): ?string
//    {
//        return $this->passwordCheck;
//    }
//
//    public function setPasswordCheck(?string $passwordCheck): self
//    {
//        $this->passwordCheck = $passwordCheck;
//
//        return $this;
//    }

//    public function getTuotteita(): ?int
//    {
//        return $this->tuotteita;
//    }
//
//    public function setTuotteita(?int $tuotteita): self
//    {
//        $this->tuotteita = $tuotteita;
//
//        return $this;
//    }
}
