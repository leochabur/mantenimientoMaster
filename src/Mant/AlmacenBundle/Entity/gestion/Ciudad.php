<?php

namespace Mant\AlmacenBundle\Entity\gestion;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudades")
 * @ORM\Entity
 */
class Ciudad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Estructura")
     * @ORM\Id 
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_estructura", referencedColumnName="id")
     * })
     */    
    private $estructura;    
    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=45)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="lati", type="decimal", precision=12, scale=10)
     */
    private $lati;

    /**
     * @var string
     *
     * @ORM\Column(name="long", type="decimal", precision=12, scale=10)
     */
    private $longi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esCabecera", type="boolean")
     */
    private $cabecera;

    /**
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_provincia", referencedColumnName="id")
     * })
     */    
    private $provincia;    

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
     * Set ciudad
     *
     * @param string $ciudad
     * @return Ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set lati
     *
     * @param string $lati
     * @return Ciudad
     */
    public function setLati($lati)
    {
        $this->lati = $lati;

        return $this;
    }

    /**
     * Get lati
     *
     * @return string 
     */
    public function getLati()
    {
        return $this->lati;
    }

    /**
     * Set longi
     *
     * @param string $longi
     * @return Ciudad
     */
    public function setLongi($longi)
    {
        $this->longi = $longi;

        return $this;
    }

    /**
     * Get longi
     *
     * @return string 
     */
    public function getLongi()
    {
        return $this->longi;
    }

    /**
     * Set cabecera
     *
     * @param boolean $cabecera
     * @return Ciudad
     */
    public function setCabecera($cabecera)
    {
        $this->cabecera = $cabecera;

        return $this;
    }

    /**
     * Get cabecera
     *
     * @return boolean 
     */
    public function getCabecera()
    {
        return $this->cabecera;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Ciudad
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set estructura
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Estructura $estructura
     * @return Ciudad
     */
    public function setEstructura(\Mant\AlmacenBundle\Entity\gestion\Estructura $estructura)
    {
        $this->estructura = $estructura;

        return $this;
    }

    /**
     * Get estructura
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Estructura 
     */
    public function getEstructura()
    {
        return $this->estructura;
    }

    /**
     * Set provincia
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Provincia $provincia
     * @return Ciudad
     */
    public function setProvincia(\Mant\AlmacenBundle\Entity\gestion\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
