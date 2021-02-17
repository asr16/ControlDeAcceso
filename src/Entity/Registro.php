<?php

namespace App\Entity;

use App\Repository\RegistroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegistroRepository::class)
 */
class Registro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $input;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $output;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="usuarioRegistro")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInput(): ?\DateTimeInterface
    {
        return $this->input;
    }

    public function setInput(\DateTimeInterface $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function getOutput(): ?\DateTimeInterface
    {
        return $this->output;
    }

    public function setOutput(\DateTimeInterface $output): self
    {
        $this->output = $output;

        return $this;
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
}
