<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Registro::class, mappedBy="user")
     */
    private $usuarioRegistro;

    /**
     * @ORM\OneToMany(targetEntity=Empresas::class, mappedBy="Jefe", orphanRemoval=true)
     */
    private $empresas;

    /**
     * @ORM\ManyToOne(targetEntity=Empresas::class, inversedBy="Empleados")
     * @ORM\JoinColumn(nullable=true)
     */
    private $empresa;

    public function __construct()
    {
        $this->usuarioRegistro = new ArrayCollection();
        $this->usuarioEmpresa = new ArrayCollection();
        $this->empresas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
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

    /**
     * @return Collection|Registro[]
     */
    public function getUsuarioRegistro(): Collection
    {
        return $this->usuarioRegistro;
    }

    public function addUsuarioRegistro(Registro $usuarioRegistro): self
    {
        if (!$this->usuarioRegistro->contains($usuarioRegistro)) {
            $this->usuarioRegistro[] = $usuarioRegistro;
            $usuarioRegistro->setUser($this);
        }

        return $this;
    }

    public function removeUsuarioRegistro(Registro $usuarioRegistro): self
    {
        if ($this->usuarioRegistro->removeElement($usuarioRegistro)) {
            // set the owning side to null (unless already changed)
            if ($usuarioRegistro->getUser() === $this) {
                $usuarioRegistro->setUser(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->username;
    }

    /**
     * @return Collection|Empresas[]
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(Empresas $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas[] = $empresa;
            $empresa->setJefe($this);
        }

        return $this;
    }

    public function removeEmpresa(Empresas $empresa): self
    {
        if ($this->empresas->removeElement($empresa)) {
            // set the owning side to null (unless already changed)
            if ($empresa->getJefe() === $this) {
                $empresa->setJefe(null);
            }
        }

        return $this;
    }

    public function getEmpresa(): ?Empresas
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresas $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }
}
