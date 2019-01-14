<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imputacionessch
 *
 * @ORM\Table(name="imputacionesSch", indexes={@ORM\Index(name="CF_imputacionesSch", columns={"nro_ant"})})
 * @ORM\Entity
 */
class Imputacionessch
{
    /**
     * @var int
     *
     * @ORM\Column(name="nro_imputacion", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nroImputacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=50, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=50, nullable=false)
     */
    private $asunto;

    /**
     * @var \Antecedentes
     *
     * @ORM\ManyToOne(targetEntity="Antecedentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nro_ant", referencedColumnName="nro_ant")
     * })
     */
    private $nroAnt;

    public function getNroImputacion(): ?int
    {
        return $this->nroImputacion;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getAsunto(): ?string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto): self
    {
        $this->asunto = $asunto;

        return $this;
    }

    public function getNroAnt(): ?Antecedentes
    {
        return $this->nroAnt;
    }

    public function setNroAnt(?Antecedentes $nroAnt): self
    {
        $this->nroAnt = $nroAnt;

        return $this;
    }


}
