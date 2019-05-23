<?php

namespace Mant\AlmacenBundle\Entity\finanzas;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FacturaProveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\finanzas\FacturaProveedorRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class FacturaProveedor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFactura", type="date")
     * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")      *
     */
    private $fechaFactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntoVenta", type="integer", nullable=true)
     */
    private $puntoVenta;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroFactura", type="integer")
     * @Assert\NotBlank(message="El campo N° de factura no puede permanecer en blanco!") 
     */
    private $numeroFactura;

    /**
     * @var string
     *
     * @ORM\Column(name="letraFactura", type="string", length=1)
     */
    private $letraFactura;

    /**
     * @var float
     *
     * @ORM\Column(name="importeNeto", type="float")
     * @Assert\NotBlank(message="El campo Importe Neto no puede permanecer en blanco!")  
     */
    private $importeNeto;

    /**
     * @var float
     *
     * @ORM\Column(name="importeIva", type="float")
     */
    private $importeIva;

    /**
     * @var float
     *
     * @ORM\Column(name="importeTotal", type="float")
    * @Assert\NotBlank(message="El campo Importe Total no puede permanecer en blanco!")  
     */
    private $importeTotal;
    
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\movimientos\Proveedor") 
    * @ORM\JoinColumn(name="id_proveedor", referencedColumnName="id")
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")     
    */   
    private $proveedor;    
    
    /**
     * @ORM\ManyToMany(targetEntity="Mant\AlmacenBundle\Entity\movimientos\DocumentoEntrada", inversedBy="facturas")
     * @ORM\JoinTable(name="documentos_por_factura")
     */
    private $documentos;   
    
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\Almacen") 
    * @ORM\JoinColumn(name="id_almacen", referencedColumnName="id")
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")    * 
    */       
    private $almacen;
    
    /**
    * @ORM\ManyToOne(targetEntity="GestionUsuariosBundle\Entity\Usuario") 
    * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
    */      
    private $userAlta;    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta; 
        
    /**
     * @var \boolean
     *
     * @ORM\Column(name="procesada", type="boolean", options={"default"=false})
     */
    private $procesada = false; ///indica si ya se ha finalizado de preocesar la factura
    
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
     * Set fechaFactura
     *
     * @param \DateTime $fechaFactura
     * @return FacturaProveedor
     */
    public function setFechaFactura($fechaFactura)
    {
        $this->fechaFactura = $fechaFactura;

        return $this;
    }

    /**
     * Get fechaFactura
     *
     * @return \DateTime 
     */
    public function getFechaFactura()
    {
        return $this->fechaFactura;
    }

    /**
     * Set puntoVenta
     *
     * @param integer $puntoVenta
     * @return FacturaProveedor
     */
    public function setPuntoVenta($puntoVenta)
    {
        $this->puntoVenta = $puntoVenta;

        return $this;
    }

    /**
     * Get puntoVenta
     *
     * @return integer 
     */
    public function getPuntoVenta()
    {
        return $this->puntoVenta;
    }

    /**
     * Set numeroFactura
     *
     * @param integer $numeroFactura
     * @return FacturaProveedor
     */
    public function setNumeroFactura($numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;

        return $this;
    }

    /**
     * Get numeroFactura
     *
     * @return integer 
     */
    public function getNumeroFactura()
    {
        return $this->numeroFactura;
    }

    /**
     * Set letraFactura
     *
     * @param string $letraFactura
     * @return FacturaProveedor
     */
    public function setLetraFactura($letraFactura)
    {
        $this->letraFactura = $letraFactura;

        return $this;
    }

    /**
     * Get letraFactura
     *
     * @return string 
     */
    public function getLetraFactura()
    {
        return $this->letraFactura;
    }

    /**
     * Set importeNeto
     *
     * @param float $importeNeto
     * @return FacturaProveedor
     */
    public function setImporteNeto($importeNeto)
    {
        $this->importeNeto = $importeNeto;

        return $this;
    }

    /**
     * Get importeNeto
     *
     * @return float 
     */
    public function getImporteNeto()
    {
        return $this->importeNeto;
    }

    /**
     * Set importeIva
     *
     * @param float $importeIva
     * @return FacturaProveedor
     */
    public function setImporteIva($importeIva)
    {
        $this->importeIva = $importeIva;

        return $this;
    }

    /**
     * Get importeIva
     *
     * @return float 
     */
    public function getImporteIva()
    {
        return $this->importeIva;
    }

    /**
     * Set importeTotal
     *
     * @param float $importeTotal
     * @return FacturaProveedor
     */
    public function setImporteTotal($importeTotal)
    {
        $this->importeTotal = $importeTotal;

        return $this;
    }

    /**
     * Get importeTotal
     *
     * @return float 
     */
    public function getImporteTotal()
    {
        return $this->importeTotal;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set proveedor
     *
     * @param \Mant\AlmacenBundle\Entity\movimientos\Proveedor $proveedor
     * @return FacturaProveedor
     */
    public function setProveedor(\Mant\AlmacenBundle\Entity\movimientos\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Mant\AlmacenBundle\Entity\movimientos\Proveedor 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Add documentos
     *
     * @param \Mant\AlmacenBundle\Entity\movimientos\DocumentoEntrada $documentos
     * @return FacturaProveedor
     */
    public function addDocumento(\Mant\AlmacenBundle\Entity\movimientos\DocumentoEntrada $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \Mant\AlmacenBundle\Entity\movimientos\DocumentoEntrada $documentos
     */
    public function removeDocumento(\Mant\AlmacenBundle\Entity\movimientos\DocumentoEntrada $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set almacen
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacen
     * @return FacturaProveedor
     */
    public function setAlmacen(\Mant\AlmacenBundle\Entity\Almacen $almacen = null)
    {
        $this->almacen = $almacen;

        return $this;
    }

    /**
     * Get almacen
     *
     * @return \Mant\AlmacenBundle\Entity\Almacen 
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }
    
    public function __toString()
    {
        return $this->almacen.'';
    }
    
    /**
     * @ORM\PrePersist
     */
     public function setPrePersist()
     {
         $this->fechaAlta = new \DateTime();
     }    
     
     /**
      * @ORM\PreRemove
      */
      
     public function setPreRemove()
     {
        foreach ($this->documentos as $doc)
        {
            $doc->setAfectadoAFactura(false);
        }
     }   
     
    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return FacturaProveedor
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
     * Set userAlta
     *
     * @param \GestionUsuariosBundle\Entity\Usuario $userAlta
     * @return FacturaProveedor
     */
    public function setUserAlta(\GestionUsuariosBundle\Entity\Usuario $userAlta = null)
    {
        $this->userAlta = $userAlta;

        return $this;
    }

    /**
     * Get userAlta
     *
     * @return \GestionUsuariosBundle\Entity\Usuario 
     */
    public function getUserAlta()
    {
        return $this->userAlta;
    }

    /**
     * Set procesada
     *
     * @param boolean $procesada
     * @return FacturaProveedor
     */
    public function setProcesada($procesada)
    {
        $this->procesada = $procesada;

        return $this;
    }

    /**
     * Get procesada
     *
     * @return boolean 
     */
    public function getProcesada()
    {
        return $this->procesada;
    }
    
    public function getMontoAplicado()
    {
        $aplicado = 0;
        foreach ($this->documentos as $doc)
        {
            $aplicado+= $doc->getImporteTotal();
        }
        return $aplicado;
    }
    
    public function finalizarCargaFactura($observada) ///marca todas las ordenes de compra como el parametro recibido
    {
        foreach ($this->documentos as $doc)
        {
            $doc->getDocumentoAsociado()->setObservado($observada);
        }
    }
}
