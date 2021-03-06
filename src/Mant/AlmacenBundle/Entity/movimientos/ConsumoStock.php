<?php

namespace Mant\AlmacenBundle\Entity\movimientos;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * SalidaStock
 *
 * @ORM\Table(name="consumo_stock")
 * @ORM\Entity
 */
class ConsumoStock extends MovimientoStock
{
 
     /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\Almacen") 
    * @ORM\JoinColumn(name="id_almacen_origen", referencedColumnName="id")
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")  
    */   
    private $almacenOrigen;  
    
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\gestion\Unidad") 
    * @ORM\JoinColumn(name="id_unidad", referencedColumnName="id", nullable=true)
    */   
    private $unidad;  
    
    
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\gestion\Empleado") 
    * @ORM\JoinColumn(name="id_empleado", referencedColumnName="id_empleado", nullable=true)
    */   
    private $empleado;      
    /**
     * @var integer
     *
     * @ORM\Column(name="num_orden_trabajo", type="integer", nullable=true)
     */
    private $numeroOrdenTrabajo;    
 
 
 
     public function getInstance()
     {
         return 7;
     }
     
     public function getAlmacenOrigenData()
     {
         return $this->almacenOrigen;
     }
     
     public function getAlmacenDestinoData()
     {
         return null;
     }

     public function getConsumidoPor()
     {
         if ($this->unidad)
                return "INTERNO ".$this->unidad->getInterno();
         if ($this->empleado)
                return $this->empleado->getApellido().", ".$this->empleado->getNombre();
         return $this->getSectorConsumo();
     }
     
     public function updateArticleItem(ItemMovimiento $item)
     {
         $item->getArticulo()->updateStock((-1)*($item->getCantidad())); 
     }
     
     public function getProcesado()
     {
         
     }
     
     public function setProcesado($procesado)
     {
         
     }
     
     public function getTipoFormulario()
     {
         return "cons";
     }
     
     public function getDepositoAAfectar() //////para saber a que deposito debe afectar el formulario
     {
         return $this->almacenOrigen;
     }
     
     public function getDepositoAutorizante() //////para saber a que deposito debe autorizar el formulario 
     {
         return null;
     }
     
     public function getItemConfirmado()////devuelve si el item que se agrega al formulario queda confirmado o no
     {
         return true;
     }
     
     public function marcarProcesado($procesado)
     {
         
     }
     
     public function movimientoConfirmado() /////indica si el movimiento una vez cargado debe ser confirmado, caso las transferencias que deben ser confirmadas por el receptor y/o las ordenes de compra
     {
         return true;
     }         
     
     public function verificarItem($item, $sRealOrigen, $sRealDestino, $stockEnTransito)
     {
         if (($item->getCantidad() + $stockEnTransito) > $sRealOrigen)
            return array('ok'=>false, 'warning'=>false, 'msge' => 'No hay stock suficiente!');
            
        if ($item->getCantidad() < 0)
        {
            return array('ok'=>false, 'warning'=>false, 'msge' => 'No puede cargar cantidades negativas!!!');            
        }
        
        return array('ok'=>true, 'warning'=>false, 'msge' => '');
     }
     
     public function getNameProveedor()
     {
         return null;
     }
     
     public function setAutorizacionFormulario()
     {
        $autorizado = true;
        $this->setAutorizado($autorizado);
     }
     
     public function getDescripcionFormulario()
     {
         return "Consumo de Stock";
     }

    /**
     * Set almacenOrigen
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacenOrigen
     * @return ConsumoStock
     */
    public function setAlmacenOrigen(\Mant\AlmacenBundle\Entity\Almacen $almacenOrigen = null)
    {
        $this->almacenOrigen = $almacenOrigen;

        return $this;
    }

    /**
     * Get almacenOrigen
     *
     * @return \Mant\AlmacenBundle\Entity\Almacen 
     */
    public function getAlmacenOrigen()
    {
        return $this->almacenOrigen;
    }

    /**
     * Set unidad
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Unidad $unidad
     * @return ConsumoStock
     */
    public function setUnidad(\Mant\AlmacenBundle\Entity\gestion\Unidad $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Unidad 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set numeroOrdenTrabajo
     *
     * @param integer $numeroOrdenTrabajo
     * @return ConsumoStock
     */
    public function setNumeroOrdenTrabajo($numeroOrdenTrabajo)
    {
        $this->numeroOrdenTrabajo = $numeroOrdenTrabajo;

        return $this;
    }

    /**
     * Get numeroOrdenTrabajo
     *
     * @return integer 
     */
    public function getNumeroOrdenTrabajo()
    {
        return $this->numeroOrdenTrabajo;
    }
    
    public function getControlaStockPorMarca()    
    {
        return true;
    }

    /**
     * Set empleado
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Empleado $empleado
     * @return ConsumoStock
     */
    public function setEmpleado(\Mant\AlmacenBundle\Entity\gestion\Empleado $empleado = null)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Empleado 
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }
    
    /**
     * @Assert\IsTrue(message = "Debe completar alguno de los dos campos Unidad, Empleado o Sector!")
     */
    public function isCocheOrEmploy()
    {
        return $this->unidad || $this->empleado || $this->getSectorConsumo();
    }    
}
