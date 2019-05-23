<?php

namespace Mant\AlmacenBundle\Entity\gestion;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unidad
 *
 * @ORM\Table(name="unidades")
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\gestion\UnidadRepository")
 */
class Unidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="interno", type="integer")
     */
    private $interno;

    /**
     * @var string
     *
     * @ORM\Column(name="patente", type="string", length=7)
     */
    private $patente;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=50)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=50)
     */
    private $modelo;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantasientos", type="integer")
     */
    private $cantasientos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="video", type="boolean")
     */
    private $video;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bar", type="boolean")
     */
    private $bar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="banio", type="boolean")
     */
    private $banio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="consumo", type="integer")
     */
    private $consumo;

    /**
     * @var string
     *
     * @ORM\Column(name="marca_motor", type="string", length=85)
     */
    private $marcaMotor;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="procesado", type="boolean")
     */
    private $procesado;

    /**
     * @var integer
     *
     * @ORM\Column(name="afectado_a_estructura", type="integer")
     */
    private $afectadoAEstructura;

    /**
     * @var string
     *
     * @ORM\Column(name="nueva_patente", type="string", length=9)
     */
    private $nuevaPatente;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacidad_tanque", type="integer")
     */
    private $capacidadTanque;
    
    /**
     * @var string
     *
     * @ORM\Column(name="id_pase", type="string", length=9, nullable=true)
     */
    private $pase;    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_estructura", type="integer", nullable=true)
     */
    private $estructura;     
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_calidadcoche", type="integer", nullable=true)
     */
    private $calidad;     
    
    
        /**
     * @var integer
     *
     * @ORM\Column(name="id_estructura_calidadcoche", type="integer", nullable=true)
     */
    private $strCalidad;  
    
    
    
        /**
     * @var integer
     *
     * @ORM\Column(name="id_estructura_propietario", type="integer", nullable=true)
     */
    private $strPropietario;  
    
        /**
     * @var integer
     *
     * @ORM\Column(name="id_tipoeje", type="integer", nullable=true)
     */
    private $tipoEje;      
    
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="km_x_litro", type="float")
     */
    private $consumoPorKm;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoUnidad")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_tipounidad", referencedColumnName="id"),
     *      @ORM\JoinColumn(name="id_estructura_tipounidad", referencedColumnName="id_estructura")
     * })
     */    
    private $tipoUnidad;
    
    /**
     * @ORM\ManyToOne(targetEntity="Empleador")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_propietario", referencedColumnName="id")
     * })
     */    
    private $propietario;    


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set interno
     *
     * @param integer $interno
     * @return Unidad
     */
    public function setInterno($interno)
    {
        $this->interno = $interno;

        return $this;
    }

    /**
     * Get interno
     *
     * @return integer 
     */
    public function getInterno()
    {
        return $this->interno;
    }

    /**
     * Set patente
     *
     * @param string $patente
     * @return Unidad
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;

        return $this;
    }

    /**
     * Get patente
     *
     * @return string 
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * Set marca
     *
     * @param string $marca
     * @return Unidad
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Unidad
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set cantasientos
     *
     * @param integer $cantasientos
     * @return Unidad
     */
    public function setCantasientos($cantasientos)
    {
        $this->cantasientos = $cantasientos;

        return $this;
    }

    /**
     * Get cantasientos
     *
     * @return integer 
     */
    public function getCantasientos()
    {
        return $this->cantasientos;
    }

    /**
     * Set video
     *
     * @param boolean $video
     * @return Unidad
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return boolean 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set bar
     *
     * @param boolean $bar
     * @return Unidad
     */
    public function setBar($bar)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return boolean 
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * Set banio
     *
     * @param boolean $banio
     * @return Unidad
     */
    public function setBanio($banio)
    {
        $this->banio = $banio;

        return $this;
    }

    /**
     * Get banio
     *
     * @return boolean 
     */
    public function getBanio()
    {
        return $this->banio;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Unidad
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set consumo
     *
     * @param integer $consumo
     * @return Unidad
     */
    public function setConsumo($consumo)
    {
        $this->consumo = $consumo;

        return $this;
    }

    /**
     * Get consumo
     *
     * @return integer 
     */
    public function getConsumo()
    {
        return $this->consumo;
    }

    /**
     * Set marcaMotor
     *
     * @param string $marcaMotor
     * @return Unidad
     */
    public function setMarcaMotor($marcaMotor)
    {
        $this->marcaMotor = $marcaMotor;

        return $this;
    }

    /**
     * Get marcaMotor
     *
     * @return string 
     */
    public function getMarcaMotor()
    {
        return $this->marcaMotor;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     * @return Unidad
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set procesado
     *
     * @param boolean $procesado
     * @return Unidad
     */
    public function setProcesado($procesado)
    {
        $this->procesado = $procesado;

        return $this;
    }

    /**
     * Get procesado
     *
     * @return boolean 
     */
    public function getProcesado()
    {
        return $this->procesado;
    }

    /**
     * Set afectadoAEstructura
     *
     * @param integer $afectadoAEstructura
     * @return Unidad
     */
    public function setAfectadoAEstructura($afectadoAEstructura)
    {
        $this->afectadoAEstructura = $afectadoAEstructura;

        return $this;
    }

    /**
     * Get afectadoAEstructura
     *
     * @return integer 
     */
    public function getAfectadoAEstructura()
    {
        return $this->afectadoAEstructura;
    }

    /**
     * Set nuevaPatente
     *
     * @param string $nuevaPatente
     * @return Unidad
     */
    public function setNuevaPatente($nuevaPatente)
    {
        $this->nuevaPatente = $nuevaPatente;

        return $this;
    }

    /**
     * Get nuevaPatente
     *
     * @return string 
     */
    public function getNuevaPatente()
    {
        return $this->nuevaPatente;
    }

    /**
     * Set capacidadTanque
     *
     * @param integer $capacidadTanque
     * @return Unidad
     */
    public function setCapacidadTanque($capacidadTanque)
    {
        $this->capacidadTanque = $capacidadTanque;

        return $this;
    }

    /**
     * Get capacidadTanque
     *
     * @return integer 
     */
    public function getCapacidadTanque()
    {
        return $this->capacidadTanque;
    }

    /**
     * Set consumoPorKm
     *
     * @param float $consumoPorKm
     * @return Unidad
     */
    public function setConsumoPorKm($consumoPorKm)
    {
        $this->consumoPorKm = $consumoPorKm;

        return $this;
    }

    /**
     * Get consumoPorKm
     *
     * @return float 
     */
    public function getConsumoPorKm()
    {
        return $this->consumoPorKm;
    }
    
    public function __toString()
    {
        try{
                    return $this->interno." ".$this->propietario->getRazonSocial();
        }
        catch (\Exception $e){return $this->interno."";}

    }

    /**
     * Set tipoUnidad
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\TipoUnidad $tipoUnidad
     * @return Unidad
     */
    public function setTipoUnidad(\Mant\AlmacenBundle\Entity\gestion\TipoUnidad $tipoUnidad = null)
    {
        $this->tipoUnidad = $tipoUnidad;

        return $this;
    }

    /**
     * Get tipoUnidad
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\TipoUnidad 
     */
    public function getTipoUnidad()
    {
        return $this->tipoUnidad;
    }

    /**
     * Set propietario
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Empleador $propietario
     * @return Unidad
     */
    public function setPropietario(\Mant\AlmacenBundle\Entity\gestion\Empleador $propietario = null)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Empleador 
     */
    public function getPropietario()
    {
        return $this->propietario;
    }
}
