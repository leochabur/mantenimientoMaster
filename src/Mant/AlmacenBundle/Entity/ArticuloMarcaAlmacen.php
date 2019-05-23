<?php

namespace Mant\AlmacenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticuloAlmacen
 *
 * @ORM\Table(name="articulo_marca_almacen")
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\ArticuloMarcaAlmacenRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class ArticuloMarcaAlmacen
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
     * @ORM\Column(name="sReal", type="decimal", nullable=true)
     */
    private $sReal = 0;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @ORM\Column(name="sMinimo", type="decimal", nullable=true)
     */
    private $sMinimo = 0;

    /**
     * @ORM\Column(name="sMaximo", type="decimal", nullable=true)
     */
    private $sMaximo = 99999;

    /**
     * @ORM\Column(name="sIdeal", type="decimal", nullable=true)
     */
    private $sIdeal = 0;

    /**
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=true)
     */
    private $ubicacion;
    
    
    /**
    * @ORM\ManyToOne(targetEntity="GestionUsuariosBundle\Entity\Usuario") 
    * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
    */       
    private $usuario;
    
    /**
    * @ORM\ManyToOne(targetEntity="Almacen") 
    * @ORM\JoinColumn(name="id_almacen", referencedColumnName="id")
    */        
    private $almacen;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="ArticuloMarca", inversedBy="articuloMarcasAlmacenes")
     * @ORM\JoinColumn(name="id_articulo_marca", referencedColumnName="id")
     **/    
    private $articuloMarca;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $importe;
    

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
     * Set sReal
     *
     * @param string $sReal
     * @return ArticuloAlmacen
     */
    public function setSReal($sReal)
    {
        $this->sReal = $sReal;

        return $this;
    }

    /**
     * Get sReal
     *
     * @return string 
     */
    public function getSReal()
    {
        return $this->sReal;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ArticuloAlmacen
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return ArticuloAlmacen
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
     * Set sMinimo
     *
     * @param string $sMinimo
     * @return ArticuloAlmacen
     */
    public function setSMinimo($sMinimo)
    {
        $this->sMinimo = $sMinimo;

        return $this;
    }

    /**
     * Get sMinimo
     *
     * @return string 
     */
    public function getSMinimo()
    {
        return $this->sMinimo;
    }

    /**
     * Set sMaximo
     *
     * @param string $sMaximo
     * @return ArticuloAlmacen
     */
    public function setSMaximo($sMaximo)
    {
        $this->sMaximo = $sMaximo;

        return $this;
    }

    /**
     * Get sMaximo
     *
     * @return string 
     */
    public function getSMaximo()
    {
        return $this->sMaximo;
    }

    /**
     * Set sIdeal
     *
     * @param string $sIdeal
     * @return ArticuloAlmacen
     */
    public function setSIdeal($sIdeal)
    {
        $this->sIdeal = $sIdeal;

        return $this;
    }

    /**
     * Get sIdeal
     *
     * @return string 
     */
    public function getSIdeal()
    {
        return $this->sIdeal;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     * @return ArticuloAlmacen
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set usuario
     *
     * @param \GestionUsuariosBundle\Entity\Usuario $usuario
     * @return ArticuloAlmacen
     */
    public function setUsuario(\GestionUsuariosBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GestionUsuariosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set almacen
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacen
     * @return ArticuloAlmacen
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
        return $this->articulo->getDescripcion();
    }
    
    public function updateStock($stock)
    {
        $this->sReal = ($this->sReal + $stock);
    }
    
    /**
     * @ORM\PrePersist
     */
     
     public function setPrePersistData()
     {
         $this->createdAt = new \DateTime();
         $this->activo = true;
     }

    /**
     * Set articuloMarca
     *
     * @param \Mant\AlmacenBundle\Entity\ArticuloMarca $articuloMarca
     * @return ArticuloMarcaAlmacen
     */
    public function setArticuloMarca(\Mant\AlmacenBundle\Entity\ArticuloMarca $articuloMarca = null)
    {
        $this->articuloMarca = $articuloMarca;

        return $this;
    }

    /**
     * Get articuloMarca
     *
     * @return \Mant\AlmacenBundle\Entity\ArticuloMarca 
     */
    public function getArticuloMarca()
    {
        return $this->articuloMarca;
    }

    /**
     * Set importe
     *
     * @param string $importe
     * @return ArticuloMarcaAlmacen
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return string 
     */
    public function getImporte()
    {
        return $this->importe;
    }
}
