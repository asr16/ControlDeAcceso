<?php

namespace App\Entity;

use App\Repository\EmpresasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpresasRepository::class)
 */
class Empresas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direction;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\Column(type="integer")
     */
    private $validation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="empresas")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Jefe;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="empresa", orphanRemoval=true)
     */
    private $Empleados;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->Empleados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCif(): ?string
    {
        return $this->cif;
    }

    public function setCif(string $cif): self
    {
        $this->cif = $cif;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getValidation(): ?int
    {
        return $this->validation;
    }

    public function setValidation(int $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function setImage(string $image): self
    {
        $this->logo = $image;

        return $this;
    }

    public function getJefe(): ?User
    {
        return $this->Jefe;
    }

    public function setJefe(?User $Jefe): self
    {
        $this->Jefe = $Jefe;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEmpleados(): Collection
    {
        return $this->Empleados;
    }

    public function addEmpleado(User $empleado): self
    {
        if (!$this->Empleados->contains($empleado)) {
            $this->Empleados[] = $empleado;
            $empleado->setEmpresa($this);
        }

        return $this;
    }

    public function removeEmpleado(User $empleado): self
    {
        if ($this->Empleados->removeElement($empleado)) {
            // set the owning side to null (unless already changed)
            if ($empleado->getEmpresa() === $this) {
                $empleado->setEmpresa(null);
            }
        }

        return $this;
    }
}
