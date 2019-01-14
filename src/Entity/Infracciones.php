<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infracciones
 *
 * @ORM\Table(name="infracciones", indexes={@ORM\Index(name="CF_ingracciones", columns={"dni"})})
 * @ORM\Entity(repositoryClass="App\Repository\InfraccionesRepository")
 */
class Infracciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="nro_infraccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nroInfraccion;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float", precision=10, scale=0, nullable=false)
     */
    private $monto;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="infracciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dni", referencedColumnName="dni")
     * })
     */
    private $dni;

    public function getNroInfraccion(): ?int
    {
        return $this->nroInfraccion;
    }

    public function getMonto(): ?float
    {
        return $this->monto;
    }

    public function setMonto(float $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getDni(): ?Usuarios
    {
        return $this->dni;
    }

    public function setDni(?Usuarios $dni): self
    {
        $this->dni = $dni;

        return $this;
    }


}
