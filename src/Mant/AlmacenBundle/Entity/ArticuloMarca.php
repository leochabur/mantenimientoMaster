<?php

namespace Mant\AlmacenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticuloMarca
 *
 * @ORM\Table(name="articulo_marca")
 * @ORM\Entity
 */
class ArticuloMarca
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
     * @ORM\Column(name="codigoBarras", type="string", length=255, nullable=true)
     */
    private $codigoBarras;
    
    
    /**
    * @ORM\ManyToOne(targetEntity="Marca") 
    * @ORM\JoinColumn(name="id_marca", referencedColumnName="id")
    */          
    private $marca;
    
    
    /**
    * @ORM\ManyToOne(targetEntity="Articulo", inversedBy="articulosMarca") 
    * @ORM\JoinColumn(name="id_articulo", referencedColumnName="id")
    */        
    private $articulo;
    
    /**
     * @ORM\OneToMany(targetEntity="ArticuloMarcaAlmacen", mappedBy="articuloMarca")
     */
    private $articuloMarcasAlmacenes;
    

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
     * Set codigoBarras
     *
     * @param string $codigoBarras
     * @return ArticuloMarca
     */
    public function setCodigoBarras($codigoBarras)
    {
        $this->codigoBarras = $codigoBarras;

        return $this;
    }

    /**
     * Get codigoBarras
     *
     * @return string 
     */
    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }



    /**
     * Set marca
     *
     * @param \Mant\AlmacenBundle\Entity\Marca $marca
     * @return ArticuloMarca
     */
    public function setMarca(\Mant\AlmacenBundle\Entity\Marca $marca = null)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return \Mant\AlmacenBundle\Entity\Marca 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set articulo
     *
     * @param \Mant\AlmacenBundle\Entity\Articulo $articulo
     * @return ArticuloMarca
     */
    public function setArticulo(\Mant\AlmacenBundle\Entity\Articulo $articulo = null)
    {
        $this->articulo = $articulo;

        return $this;
    }

    /**
     * Get articulo
     *
     * @return \Mant\AlmacenBundle\Entity\Articulo 
     */
    public function getArticulo()
    {
        return $this->articulo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articuloMarcasAlmacenes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articuloMarcasAlmacenes
     *
     * @param \Mant\AlmacenBundle\Entity\ArticuloMarcaAlmacen $articuloMarcasAlmacenes
     * @return ArticuloMarca
     */
    public function addArticuloMarcasAlmacene(\Mant\AlmacenBundle\Entity\ArticuloMarcaAlmacen $articuloMarcasAlmacenes)
    {
        $this->articuloMarcasAlmacenes[] = $articuloMarcasAlmacenes;

        return $this;
    }

    /**
     * Remove articuloMarcasAlmacenes
     *
     * @param \Mant\AlmacenBundle\Entity\ArticuloMarcaAlmacen $articuloMarcasAlmacenes
     */
    public function removeArticuloMarcasAlmacene(\Mant\AlmacenBundle\Entity\ArticuloMarcaAlmacen $articuloMarcasAlmacenes)
    {
        $this->articuloMarcasAlmacenes->removeElement($articuloMarcasAlmacenes);
    }

    /**
     * Get articuloMarcasAlmacenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticuloMarcasAlmacenes()
    {
        return $this->articuloMarcasAlmacenes;
    }
}
