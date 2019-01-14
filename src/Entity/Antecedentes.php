<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Antecedentes
 *
 * @ORM\Table(name="antecedentes")
 * @ORM\Entity
 */
class Antecedentes
{
    /**
     * @var int
     *
     * @ORM\Column(name="nro_ant", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nroAnt;

    /**
     * @var string
     *
     * @ORM\Column(name="fuenteOrigen", type="string", length=50, nullable=false)
     */
    private $fuenteorigen;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_alta", type="string", length=50, nullable=false)
     */
    private $estadoAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=50, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="fe_comp", type="string", length=50, nullable=false)
     */
    private $feComp;

    /**
     * @var string
     *
     * @ORM\Column(name="fe_compTxt", type="string", length=50, nullable=false)
     */
    private $feComptxt;

    /**
     * @var string
     *
     * @ORM\Column(name="tcomp", type="string", length=50, nullable=false)
     */
    private $tcomp;

    /**
     * @var string
     *
     * @ORM\Column(name="ncomp", type="string", length=50, nullable=false)
     */
    private $ncomp;

    /**
     * @var string
     *
     * @ORM\Column(name="tinfraccion", type="string", length=50, nullable=false)
     */
    private $tinfraccion;

    /**
     * @var string
     *
     * @ORM\Column(name="finfraccion", type="string", length=50, nullable=false)
     */
    private $finfraccion;

    /**
     * @var string
     *
     * @ORM\Column(name="fe_infr", type="string", length=50, nullable=false)
     */
    private $feInfr;

    /**
     * @var string
     *
     * @ORM\Column(name="fe_infrTxt", type="string", length=50, nullable=false)
     */
    private $feInfrtxt;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=50, nullable=false)
     */
    private $lugar;

    /**
     * @var string
     *
     * @ORM\Column(name="jurisdiccion", type="string", length=50, nullable=false)
     */
    private $jurisdiccion;

    /**
     * @var string
     *
     * @ORM\Column(name="dominio", type="string", length=50, nullable=false)
     */
    private $dominio;

    /**
     * @var string
     *
     * @ORM\Column(name="tdoc_titular", type="string", length=50, nullable=false)
     */
    private $tdocTitular;

    /**
     * @var string
     *
     * @ORM\Column(name="ndoc_titular", type="string", length=50, nullable=false)
     */
    private $ndocTitular;

    /**
     * @var string
     *
     * @ORM\Column(name="dato_conductor", type="string", length=50, nullable=false)
     */
    private $datoConductor;

    /**
     * @var string
     *
     * @ORM\Column(name="tdoc_conductor", type="string", length=50, nullable=false)
     */
    private $tdocConductor;

    /**
     * @var string
     *
     * @ORM\Column(name="ndoc_conductor", type="string", length=50, nullable=false)
     */
    private $ndocConductor;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel_ejecucion", type="string", length=50, nullable=false)
     */
    private $nivelEjecucion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_infraccion", type="string", length=50, nullable=false)
     */
    private $estadoInfraccion;

    /**
     * @var string
     *
     * @ORM\Column(name="isFirme", type="string", length=50, nullable=false)
     */
    private $isfirme;

    /**
     * @var string
     *
     * @ORM\Column(name="isPaga", type="string", length=50, nullable=false)
     */
    private $ispaga;

    /**
     * @var string
     *
     * @ORM\Column(name="fe_resolucion", type="string", length=50, nullable=false)
     */
    private $feResolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="fe_resolucionTxt", type="string", length=50, nullable=false)
     */
    private $feResoluciontxt;

    public function getNroAnt(): ?int
    {
        return $this->nroAnt;
    }

    public function getFuenteorigen(): ?string
    {
        return $this->fuenteorigen;
    }

    public function setFuenteorigen(string $fuenteorigen): self
    {
        $this->fuenteorigen = $fuenteorigen;

        return $this;
    }

    public function getEstadoAlta(): ?string
    {
        return $this->estadoAlta;
    }

    public function setEstadoAlta(string $estadoAlta): self
    {
        $this->estadoAlta = $estadoAlta;

        return $this;
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

    public function getFeComp(): ?string
    {
        return $this->feComp;
    }

    public function setFeComp(string $feComp): self
    {
        $this->feComp = $feComp;

        return $this;
    }

    public function getFeComptxt(): ?string
    {
        return $this->feComptxt;
    }

    public function setFeComptxt(string $feComptxt): self
    {
        $this->feComptxt = $feComptxt;

        return $this;
    }

    public function getTcomp(): ?string
    {
        return $this->tcomp;
    }

    public function setTcomp(string $tcomp): self
    {
        $this->tcomp = $tcomp;

        return $this;
    }

    public function getNcomp(): ?string
    {
        return $this->ncomp;
    }

    public function setNcomp(string $ncomp): self
    {
        $this->ncomp = $ncomp;

        return $this;
    }

    public function getTinfraccion(): ?string
    {
        return $this->tinfraccion;
    }

    public function setTinfraccion(string $tinfraccion): self
    {
        $this->tinfraccion = $tinfraccion;

        return $this;
    }

    public function getFinfraccion(): ?string
    {
        return $this->finfraccion;
    }

    public function setFinfraccion(string $finfraccion): self
    {
        $this->finfraccion = $finfraccion;

        return $this;
    }

    public function getFeInfr(): ?string
    {
        return $this->feInfr;
    }

    public function setFeInfr(string $feInfr): self
    {
        $this->feInfr = $feInfr;

        return $this;
    }

    public function getFeInfrtxt(): ?string
    {
        return $this->feInfrtxt;
    }

    public function setFeInfrtxt(string $feInfrtxt): self
    {
        $this->feInfrtxt = $feInfrtxt;

        return $this;
    }

    public function getLugar(): ?string
    {
        return $this->lugar;
    }

    public function setLugar(string $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getJurisdiccion(): ?string
    {
        return $this->jurisdiccion;
    }

    public function setJurisdiccion(string $jurisdiccion): self
    {
        $this->jurisdiccion = $jurisdiccion;

        return $this;
    }

    public function getDominio(): ?string
    {
        return $this->dominio;
    }

    public function setDominio(string $dominio): self
    {
        $this->dominio = $dominio;

        return $this;
    }

    public function getTdocTitular(): ?string
    {
        return $this->tdocTitular;
    }

    public function setTdocTitular(string $tdocTitular): self
    {
        $this->tdocTitular = $tdocTitular;

        return $this;
    }

    public function getNdocTitular(): ?string
    {
        return $this->ndocTitular;
    }

    public function setNdocTitular(string $ndocTitular): self
    {
        $this->ndocTitular = $ndocTitular;

        return $this;
    }

    public function getDatoConductor(): ?string
    {
        return $this->datoConductor;
    }

    public function setDatoConductor(string $datoConductor): self
    {
        $this->datoConductor = $datoConductor;

        return $this;
    }

    public function getTdocConductor(): ?string
    {
        return $this->tdocConductor;
    }

    public function setTdocConductor(string $tdocConductor): self
    {
        $this->tdocConductor = $tdocConductor;

        return $this;
    }

    public function getNdocConductor(): ?string
    {
        return $this->ndocConductor;
    }

    public function setNdocConductor(string $ndocConductor): self
    {
        $this->ndocConductor = $ndocConductor;

        return $this;
    }

    public function getNivelEjecucion(): ?string
    {
        return $this->nivelEjecucion;
    }

    public function setNivelEjecucion(string $nivelEjecucion): self
    {
        $this->nivelEjecucion = $nivelEjecucion;

        return $this;
    }

    public function getEstadoInfraccion(): ?string
    {
        return $this->estadoInfraccion;
    }

    public function setEstadoInfraccion(string $estadoInfraccion): self
    {
        $this->estadoInfraccion = $estadoInfraccion;

        return $this;
    }

    public function getIsfirme(): ?string
    {
        return $this->isfirme;
    }

    public function setIsfirme(string $isfirme): self
    {
        $this->isfirme = $isfirme;

        return $this;
    }

    public function getIspaga(): ?string
    {
        return $this->ispaga;
    }

    public function setIspaga(string $ispaga): self
    {
        $this->ispaga = $ispaga;

        return $this;
    }

    public function getFeResolucion(): ?string
    {
        return $this->feResolucion;
    }

    public function setFeResolucion(string $feResolucion): self
    {
        $this->feResolucion = $feResolucion;

        return $this;
    }

    public function getFeResoluciontxt(): ?string
    {
        return $this->feResoluciontxt;
    }

    public function setFeResoluciontxt(string $feResoluciontxt): self
    {
        $this->feResoluciontxt = $feResoluciontxt;

        return $this;
    }


}
