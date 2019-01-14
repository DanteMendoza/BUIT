<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios
{
    /**
     * @var int
     *
     * @ORM\Column(name="dni", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="nyape", type="string", length=30, nullable=false)
     */
    private $nyape;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infracciones", mappedBy="dni", cascade={"persist", "remove"})
     */
    private $infracciones;

    public function __construct()
    {
        $this->infracciones = new ArrayCollection();
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getNyape(): ?string
    {
        return $this->nyape;
    }

    public function setNyape(string $nyape): self
    {
        $this->nyape = $nyape;

        return $this;
    }

    /**
     * @return Collection|Infracciones[]
     */
    public function getInfracciones(): Collection
    {
        return $this->infracciones;
    }

    public function addInfraccione(Infracciones $infraccione): self
    {
        if (!$this->infracciones->contains($infraccione)) {
            $this->infracciones[] = $infraccione;
            $infraccione->setUsuario($this);
        }

        return $this;
    }

    public function removeInfraccione(Infracciones $infraccione): self
    {
        if ($this->infracciones->contains($infraccione)) {
            $this->infracciones->removeElement($infraccione);
            // set the owning side to null (unless already changed)
            if ($infraccione->getUsuario() === $this) {
                $infraccione->setUsuario(null);
            }
        }

        return $this;
    }


}












