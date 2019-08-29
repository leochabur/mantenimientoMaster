<?php

namespace Mant\AlmacenBundle\Entity\movimientos;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Sector
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\movimientos\SectorRepository")
 * @UniqueEntity("sector",  message="Ya existe un sector con ese nombre!")
 */
class Sector
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
     * @ORM\Column(name="sector", type="string", length=255)
     * @Assert\NotBlank( message="El sector no puede permanecer en blanco!")
     */
    private $sector;


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
     * Set sector
     *
     * @param string $sector
     * @return Sector
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

    public function __toString()
    {
        return $this->sector;
    }
}
