<?php

namespace Mant\AlmacenBundle\Entity\movimientos;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EntradaStock
 *
 * @ORM\Table(name="documento_entrada_stock")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks() 
 */
class DocumentoEntrada extends MovimientoStock
{
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\Almacen") 
    * @ORM\JoinColumn(name="id_almacen_destino", referencedColumnName="id")
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")    * 
    */   
    private $almacenDestino;   
    
    /**
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */    
    private $numero;
    
    /**
     * @ORM\ManyToMany(targetEntity="Mant\AlmacenBundle\Entity\finanzas\FacturaProveedor", mappedBy="documentos")
     */
    private $facturas;    
    
    /**
     * @ORM\Column(name="afectado", type="boolean", nullable=false, options={"default"=false})
     */    
    private $afectadoAFactura = false;   ///indica si el documento ya ha sido facturado 
    
    
    public function __construct() 
    {
        $this->facturas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set almacenDestino
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacenDestino
     * @return EntradaStock
     */
    public function setAlmacenDestino(\Mant\AlmacenBundle\Entity\Almacen $almacenDestino = null)
    {
        $this->almacenDestino = $almacenDestino;

        return $this;
    }

    /**
     * Get almacenDestino
     *
     * @return \Mant\AlmacenBundle\Entity\Almacen 
     */
    public function getAlmacenDestino()
    {
        return $this->almacenDestino;
    }
    
    
    public function getDescripcionFormulario()
    {
        return "Documento Entrada Stock";
    }
    

    /**
     * Set numero
     *
     * @param integer $numero
     * @return EntradaStock
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }
    
    public function getInstance()
    {
        return 5;
    }
    
     public function getAlmacenOrigenData()
     {
         return null;
     }
     
     public function getAlmacenDestinoData()
     {
        return $this->almacenDestino;    
     }
     
     public function updateArticleItem(ItemMovimiento $item)
     {
        $item->setPrecioTotal($item->getCantidad() * $item->getPrecioUnitario());
        $item->getArticulo()->updateStock($item->getCantidad());     
        $item->getArticulo()->setImporte($item->getPrecioUnitario());        
     }
     
     public function getProcesado()
     {
        return true;
     }
     public function setProcesado($procesado)
     {

     }
     
     public function getTipoFormulario()
     {
         return 'aut';
     }
     
    public function getDepositoAAfectar()     
    {
        return $this->almacenDestino;
    }     
    
    public function getItemConfirmado()    
    {
        return null;
    }    
    
    public function marcarProcesado($procesado){

    }        
    
    public function movimientoConfirmado()
    {
        return true;
    }
    
    public function verificarItem($item, $sRealOrigen, $sRealDestino, $stockEnTransito)
    {
        return array('ok'=>true, 'warning'=>false, 'msge' => '');
    }    
    
    public function getDepositoAutorizante(){
        return null;
    }    
    
    public function getNameProveedor()
    {
        return "";
    }
    
    public function setAutorizacionFormulario()
    {
        $autorizado = true;
        $this->setAutorizado($autorizado);
    }        
    

    /**
     * Add facturas
     *
     * @param \Mant\AlmacenBundle\Entity\finanzas\FacturaProveedor $facturas
     * @return DocumentoEntrada
     */
    public function addFactura(\Mant\AlmacenBundle\Entity\finanzas\FacturaProveedor $facturas)
    {
        $this->facturas[] = $facturas;

        return $this;
    }

    /**
     * Remove facturas
     *
     * @param \Mant\AlmacenBundle\Entity\finanzas\FacturaProveedor $facturas
     */
    public function removeFactura(\Mant\AlmacenBundle\Entity\finanzas\FacturaProveedor $facturas)
    {
        $this->facturas->removeElement($facturas);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturas()
    {
        return $this->facturas;
    }

    /**
     * Set afectadoAFactura
     *
     * @param boolean $afectadoAFactura
     * @return DocumentoEntrada
     */
    public function setAfectadoAFactura($afectadoAFactura)
    {
        $this->afectadoAFactura = $afectadoAFactura;

        return $this;
    }

    /**
     * Get afectadoAFactura
     *
     * @return boolean 
     */
    public function getAfectadoAFactura()
    {
        return $this->afectadoAFactura;
    }
    
    public function getControlaStockPorMarca()    
    {
        return false;
    }
}
