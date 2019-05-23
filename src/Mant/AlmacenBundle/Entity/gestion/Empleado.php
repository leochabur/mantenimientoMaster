<?php

namespace Mant\AlmacenBundle\Entity\gestion;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empleado
 *
 * @ORM\Table(name="empleados")
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\gestion\EmpleadoRepository")
 */
class Empleado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_empleado", type="bigint", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="legajo", type="integer")
     */
    private $legajo;

    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=30, nullable=true)
     */
    private $domicilio;

    /**
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_ciudad", referencedColumnName="id", nullable=true),
     *      @ORM\JoinColumn(name="id_estructura_ciudad", referencedColumnName="id_estructura", nullable=true)
     * })
     */    
    private $ciudad;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=30, nullable=true)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nacionalidad", type="bigint", nullable=true)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=true)
     */
    private $sexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechanac", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="tipodoc", type="string", length=3, nullable=true)
     */
    private $tipoDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="nrodoc", type="string", length=10, nullable=true)
     */
    private $numDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="cuil", type="string", length=15, nullable=true)
     */
    private $cuil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="id_sector", type="bigint", nullable=true)
     */
    private $sector;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cargo")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_cargo", referencedColumnName="id", nullable=true),
     *      @ORM\JoinColumn(name="id_estructura_cargo", referencedColumnName="id_estructura", nullable=true)
     * })
     */    
    private $cargo; 
    
    /**
     * @ORM\ManyToOne(targetEntity="Empleador")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_empleador", referencedColumnName="id")
     * })
     */    
    private $empleador;    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio_relacion_laboral", type="date")
     */
    private $inicioRelacionLaboral;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=true)
     */
    private $clave;

    /**
     * @var integer
     *
     * @ORM\Column(name="nivel_acceso", type="integer", nullable=true)
     */
    private $nivelAcceso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contratado", type="boolean", nullable=true)
     */
    private $contratado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ocupacional", type="date", nullable=true)
     */
    private $fechaOcupacional;

    /**
     * @var \integer
     *
     * @ORM\Column(name="id_estructura", type="integer")
     */
    private $estructura;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="procesado", type="boolean")
     */
    private $procesado;
    
    /**
     * @var \integer
     *
     * @ORM\Column(name="afectado_a_estructura", type="integer", nullable=true)
     */
    private $estructuraAfectado;    

    /**
     * @var boolean
     *
     * @ORM\Column(name="borrado", type="boolean")
     */
    private $borrado;
    
    
    /**
     * @var \integer
     *
     * @ORM\Column(name="usuario_alta_provisoria", type="integer", nullable=true)
     */
    private $usuarioAltaProvisoria;    
    
    /**
     * @var \integer
     *
     * @ORM\Column(name="usuario_alta_definitiva", type="integer", nullable=true)
     */
    private $usuarioAltaDefinitiva;        

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta_definitiva", type="datetime", nullable=true)
     */
    private $fechaAltaDefinitiva;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin_relacion_laboral", type="date", nullable=true)
     */
    private $fechaFinRelacionLaboral;
    
    /**
     * @var \integer
     *
     * @ORM\Column(name="id_estructura_empleador", type="integer", nullable=true)
     */
    private $strEmpleador;


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
     * Set legajo
     *
     * @param integer $legajo
     * @return Empleado
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * Get legajo
     *
     * @return integer 
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return Empleado
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Empleado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set nacionalidad
     *
     * @param integer $nacionalidad
     * @return Empleado
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return integer 
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Empleado
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set fechanac
     *
     * @param \DateTime $fechanac
     * @return Empleado
     */
    public function setFechanac($fechanac)
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    /**
     * Get fechanac
     *
     * @return \DateTime 
     */
    public function getFechanac()
    {
        return $this->fechanac;
    }

    /**
     * Set tipodoc
     *
     * @param string $tipodoc
     * @return Empleado
     */
    public function setTipodoc($tipodoc)
    {
        $this->tipodoc = $tipodoc;

        return $this;
    }

    /**
     * Get tipodoc
     *
     * @return string 
     */
    public function getTipodoc()
    {
        return $this->tipodoc;
    }

    /**
     * Set numDoc
     *
     * @param string $numDoc
     * @return Empleado
     */
    public function setNumDoc($numDoc)
    {
        $this->numDoc = $numDoc;

        return $this;
    }

    /**
     * Get numDoc
     *
     * @return string 
     */
    public function getNumDoc()
    {
        return $this->numDoc;
    }

    /**
     * Set cuil
     *
     * @param string $cuil
     * @return Empleado
     */
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;

        return $this;
    }

    /**
     * Get cuil
     *
     * @return string 
     */
    public function getCuil()
    {
        return $this->cuil;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Empleado
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
     * Set sector
     *
     * @param string $sector
     * @return Empleado
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string 
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set inicioRelacionLaboral
     *
     * @param \DateTime $inicioRelacionLaboral
     * @return Empleado
     */
    public function setInicioRelacionLaboral($inicioRelacionLaboral)
    {
        $this->inicioRelacionLaboral = $inicioRelacionLaboral;

        return $this;
    }

    /**
     * Get inicioRelacionLaboral
     *
     * @return \DateTime 
     */
    public function getInicioRelacionLaboral()
    {
        return $this->inicioRelacionLaboral;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Empleado
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Empleado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Empleado
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return Empleado
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set nivelAcceso
     *
     * @param integer $nivelAcceso
     * @return Empleado
     */
    public function setNivelAcceso($nivelAcceso)
    {
        $this->nivelAcceso = $nivelAcceso;

        return $this;
    }

    /**
     * Get nivelAcceso
     *
     * @return integer 
     */
    public function getNivelAcceso()
    {
        return $this->nivelAcceso;
    }

    /**
     * Set contratado
     *
     * @param boolean $contratado
     * @return Empleado
     */
    public function setContratado($contratado)
    {
        $this->contratado = $contratado;

        return $this;
    }

    /**
     * Get contratado
     *
     * @return boolean 
     */
    public function getContratado()
    {
        return $this->contratado;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Empleado
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaOcupacional
     *
     * @param \DateTime $fechaOcupacional
     * @return Empleado
     */
    public function setFechaOcupacional($fechaOcupacional)
    {
        $this->fechaOcupacional = $fechaOcupacional;

        return $this;
    }

    /**
     * Get fechaOcupacional
     *
     * @return \DateTime 
     */
    public function getFechaOcupacional()
    {
        return $this->fechaOcupacional;
    }

    /**
     * Set procesado
     *
     * @param boolean $procesado
     * @return Empleado
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
     * Set borrado
     *
     * @param boolean $borrado
     * @return Empleado
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return boolean 
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Set fechaAltaDefinitiva
     *
     * @param \DateTime $fechaAltaDefinitiva
     * @return Empleado
     */
    public function setFechaAltaDefinitiva($fechaAltaDefinitiva)
    {
        $this->fechaAltaDefinitiva = $fechaAltaDefinitiva;

        return $this;
    }

    /**
     * Get fechaAltaDefinitiva
     *
     * @return \DateTime 
     */
    public function getFechaAltaDefinitiva()
    {
        return $this->fechaAltaDefinitiva;
    }

    /**
     * Set fechaFinRelacionLaboral
     *
     * @param \DateTime $fechaFinRelacionLaboral
     * @return Empleado
     */
    public function setFechaFinRelacionLaboral($fechaFinRelacionLaboral)
    {
        $this->fechaFinRelacionLaboral = $fechaFinRelacionLaboral;

        return $this;
    }

    /**
     * Get fechaFinRelacionLaboral
     *
     * @return \DateTime 
     */
    public function getFechaFinRelacionLaboral()
    {
        return $this->fechaFinRelacionLaboral;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Empleado
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set estructura
     *
     * @param integer $estructura
     * @return Empleado
     */
    public function setEstructura($estructura)
    {
        $this->estructura = $estructura;

        return $this;
    }

    /**
     * Get estructura
     *
     * @return integer 
     */
    public function getEstructura()
    {
        return $this->estructura;
    }

    /**
     * Set estructuraAfectado
     *
     * @param integer $estructuraAfectado
     * @return Empleado
     */
    public function setEstructuraAfectado($estructuraAfectado)
    {
        $this->estructuraAfectado = $estructuraAfectado;

        return $this;
    }

    /**
     * Get estructuraAfectado
     *
     * @return integer 
     */
    public function getEstructuraAfectado()
    {
        return $this->estructuraAfectado;
    }

    /**
     * Set usuarioAltaProvisoria
     *
     * @param integer $usuarioAltaProvisoria
     * @return Empleado
     */
    public function setUsuarioAltaProvisoria($usuarioAltaProvisoria)
    {
        $this->usuarioAltaProvisoria = $usuarioAltaProvisoria;

        return $this;
    }

    /**
     * Get usuarioAltaProvisoria
     *
     * @return integer 
     */
    public function getUsuarioAltaProvisoria()
    {
        return $this->usuarioAltaProvisoria;
    }

    /**
     * Set usuarioAltaDefinitiva
     *
     * @param integer $usuarioAltaDefinitiva
     * @return Empleado
     */
    public function setUsuarioAltaDefinitiva($usuarioAltaDefinitiva)
    {
        $this->usuarioAltaDefinitiva = $usuarioAltaDefinitiva;

        return $this;
    }

    /**
     * Get usuarioAltaDefinitiva
     *
     * @return integer 
     */
    public function getUsuarioAltaDefinitiva()
    {
        return $this->usuarioAltaDefinitiva;
    }

    /**
     * Set ciudad
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Ciudad $ciudad
     * @return Empleado
     */
    public function setCiudad(\Mant\AlmacenBundle\Entity\gestion\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set cargo
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Cargo $cargo
     * @return Empleado
     */
    public function setCargo(\Mant\AlmacenBundle\Entity\gestion\Cargo $cargo = null)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Cargo 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set empleador
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Empleador $empleador
     * @return Empleado
     */
    public function setEmpleador(\Mant\AlmacenBundle\Entity\gestion\Empleador $empleador = null)
    {
        $this->empleador = $empleador;

        return $this;
    }

    /**
     * Get empleador
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Empleador 
     */
    public function getEmpleador()
    {
        return $this->empleador;
    }
    
    public function __toString()
    {
        return $this->legajo." - (".$this->apellido.", ".$this->nombre.")";
    }
}
