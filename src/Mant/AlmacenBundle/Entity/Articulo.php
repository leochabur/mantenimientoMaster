<?php

namespace Mant\AlmacenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Mant\AlmacenBundle\Entity\Almacen;

/**
 * Articulo
 *
 * @ORM\Table(name="articulos")
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\ArticuloRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"codigo"},
 *               message="Ya existe un articulo con ese codigo!")
 */
class Articulo
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
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=100)
     * @Assert\NotBlank(message="El campo no puede permanecer en blanco!") 
     */
    private $codigo;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede permanecer en blanco!") 
     */
    private $descripcion;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="especificacion", type="text", nullable=true)
     */    
    
    private $especificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    
    
    /**
    * @ORM\ManyToOne(targetEntity="Clasificacion") 
    * @ORM\JoinColumn(name="id_clasificacion", referencedColumnName="id")
    */    
    private $clasificacion;


    /**
    * @ORM\ManyToOne(targetEntity="GestionUsuariosBundle\Entity\Usuario") 
    * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
    */  
    private $user;  
    
    /**
     * @ORM\Column(name="t_aprovisionamiento", type="integer", nullable=true)
     */
    private $aprovisionamiento;        


    /**
     * @ORM\ManyToMany(targetEntity="Almacen", inversedBy="articulos")
     * @ORM\JoinTable(name="articulos_por_almacen")
     * @Assert\Count(
     *      min = 1,
     *      minMessage = "Debe asignar el Articulo a un Deposito al menos!!"
     * )
     */
    private $almacenes;
    
    
    /**
     * @ORM\OneToMany(targetEntity="ArticuloMarca", mappedBy="articulo", cascade={"persist", "remove"})
     * @Assert\Count(
     *      min = 1,
     *      minMessage = "Debe cargar al menos una marca al articulo!!"
     * )
     */
    private $articulosMarca;    


    // ...Representa las opciones de stock de dicho articulo para cada almacen donde este activo
    /**
     * @ORM\OneToMany(targetEntity="StockArticuloAlmacen", mappedBy="articulo")
     */
     private $stockAlmacen;
     
    /**
    * @ORM\ManyToOne(targetEntity="Unidad") 
    * @ORM\JoinColumn(name="id_unidad", referencedColumnName="id")
    */  
    private $unidad;
    
    /**
     * @ORM\OneToMany(targetEntity="StockArticuloAlmacen", mappedBy="articulo")
     */
    private $stocksArticulos; /// para un item observado representa el item asociado    
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
     * Set activo
     *
     * @param boolean $activo
     * @return Articulo
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Articulo
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
     * Set clasificacion
     *
     * @param \Mant\AlmacenBundle\Entity\Clasificacion $clasificacion
     * @return Articulo
     */
    public function setClasificacion(\Mant\AlmacenBundle\Entity\Clasificacion $clasificacion = null)
    {
        $this->clasificacion = $clasificacion;

        return $this;
    }

    /**
     * Get clasificacion
     *
     * @return \Mant\AlmacenBundle\Entity\Clasificacion 
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * Set user
     *
     * @param \GestionUsuariosBundle\Entity\Usuario $user
     * @return Articulo
     */
    public function setUser(\GestionUsuariosBundle\Entity\Usuario $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \GestionUsuariosBundle\Entity\Usuario 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Articulo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Articulo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set especificacion
     *
     * @param string $especificacion
     * @return Articulo
     */
    public function setEspecificacion($especificacion)
    {
        $this->especificacion = $especificacion;

        return $this;
    }

    /**
     * Get especificacion
     *
     * @return string 
     */
    public function getEspecificacion()
    {
        return $this->especificacion;
    }

    /**
     * Set aprovisionamiento
     *
     * @param integer $aprovisionamiento
     * @return Articulo
     */
    public function setAprovisionamiento($aprovisionamiento)
    {
        $this->aprovisionamiento = $aprovisionamiento;

        return $this;
    }

    /**
     * Get aprovisionamiento
     *
     * @return integer 
     */
    public function getAprovisionamiento()
    {
        return $this->aprovisionamiento;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
        $this->activo = true;
        foreach($this->articulosMarca as $articuloMarca){
                $articuloMarca->setArticulo($this);
        }
    }     
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->almacenes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articulosMarca = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stockAlmacen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add almacenes
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacenes
     * @return Articulo
     */
    public function addAlmacene(\Mant\AlmacenBundle\Entity\Almacen $almacenes)
    {
        $this->almacenes[] = $almacenes;

        return $this;
    }

    /**
     * Remove almacenes
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacenes
     */
    public function removeAlmacene(\Mant\AlmacenBundle\Entity\Almacen $almacenes)
    {
        $this->almacenes->removeElement($almacenes);
    }

    /**
     * Get almacenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlmacenes()
    {
        return $this->almacenes;
    }

    /**
     * Add articulosMarca
     *
     * @param \Mant\AlmacenBundle\Entity\ArticuloMarca $articulosMarca
     * @return Articulo
     */
    public function addArticulosMarca(\Mant\AlmacenBundle\Entity\ArticuloMarca $articulosMarca)
    {
        $this->articulosMarca[] = $articulosMarca;

        return $this;
    }

    /**
     * Remove articulosMarca
     *
     * @param \Mant\AlmacenBundle\Entity\ArticuloMarca $articulosMarca
     */
    public function removeArticulosMarca(\Mant\AlmacenBundle\Entity\ArticuloMarca $articulosMarca)
    {
        $this->articulosMarca->removeElement($articulosMarca);
    }

    /**
     * Get articulosMarca
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticulosMarca()
    {
        return $this->articulosMarca;
    }
    
    public function setArticulosMarca($articles)
    {
        $this->articulosMarca = $articles;
    }    

    /**
     * Add stockAlmacen
     *
     * @param \Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stockAlmacen
     * @return Articulo
     */
    public function addStockAlmacen(\Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stockAlmacen)
    {
        $this->stockAlmacen[] = $stockAlmacen;

        return $this;
    }

    /**
     * Remove stockAlmacen
     *
     * @param \Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stockAlmacen
     */
    public function removeStockAlmacen(\Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stockAlmacen)
    {
        $this->stockAlmacen->removeElement($stockAlmacen);
    }

    /**
     * Get stockAlmacen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStockAlmacen()
    {
        return $this->stockAlmacen;
    }
    
    public function getArticuloMarca($marca)
    {
        foreach ($this->articulosMarca as $artMca){
            if ($artMca->getMarca() == $marca){
                return $artMca;
            }
        }
        return 0;
    }

    /**
     * Set unidad
     *
     * @param \Mant\AlmacenBundle\Entity\Unidad $unidad
     * @return Articulo
     */
    public function setUnidad(\Mant\AlmacenBundle\Entity\Unidad $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \Mant\AlmacenBundle\Entity\Unidad 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Add stocksArticulos
     *
     * @param \Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stocksArticulos
     * @return Articulo
     */
    public function addStocksArticulo(\Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stocksArticulos)
    {
        $this->stocksArticulos[] = $stocksArticulos;

        return $this;
    }

    /**
     * Remove stocksArticulos
     *
     * @param \Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stocksArticulos
     */
    public function removeStocksArticulo(\Mant\AlmacenBundle\Entity\StockArticuloAlmacen $stocksArticulos)
    {
        $this->stocksArticulos->removeElement($stocksArticulos);
    }

    /**
     * Get stocksArticulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStocksArticulos()
    {
        return $this->stocksArticulos;
    }
    
    public function getStockArticuloAlmacen($almacen)
    {
        foreach ($this->stocksArticulos as $st)
        {
            if ($st->getAlmacen() == $almacen)
                return $st;
        }
        return null;
    }
}
