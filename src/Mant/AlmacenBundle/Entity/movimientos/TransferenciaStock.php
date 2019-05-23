<?php

namespace Mant\AlmacenBundle\Entity\movimientos;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * TransferenciaStock
 *
 * @ORM\Table(name="transferencias_stock")
 * @ORM\Entity
 */
class TransferenciaStock extends MovimientoStock
{
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\Almacen") 
    * @ORM\JoinColumn(name="id_almacen_origen", referencedColumnName="id")
  * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")    * 
    */   
    private $almacenOrigen;     
    
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\Almacen") 
    * @ORM\JoinColumn(name="id_almacen_destino", referencedColumnName="id")
  * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")    * 
    */   
    private $almacenDestino;       

    /**
     *
     * @ORM\Column(name="procesado", type="boolean")
     */
     private $procesado;


    /**
     * Set almacenOrigen
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacenOrigen
     * @return TransferenciaStock
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
     * Set almacenDestino
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $almacenDestino
     * @return TransferenciaStock
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
        return "Transferencia de Stock";
    }
    
    public function updateItems()
    {
        
    }    
    
    public function getInstance()
    {
        return 4;
    }
    
     public function getAlmacenOrigenData()
     {
         return $this->almacenOrigen;
     }
     
     public function getAlmacenDestinoData()
     {
        return $this->almacenOrigen; ///develve elorgien ya que eldestino debe aprobar la operacion    
     }
     
     public function updateArticleItem(ItemMovimiento $item)
     {
        $item->setPrecioTotal($item->getCantidad() * $item->getPrecioUnitario());
        $item->getArticulo()->updateStock((-1)*($item->getCantidad()));              
     }     
     
     public function getProcesado()
     {
         return $this->procesado;
     }
     
     public function setProcesado($procesado)
     {
         $this->procesado = $procesado;
     }
     
     public function getTipoFormulario()
     {
         return 'trx';
     }     
     
    public function getDepositoAAfectar()     
    {
        return $this->almacenOrigen;
    }     
    
    public function getItemConfirmado()    
    {
        return false;
    }    
    
    public function marcarProcesado($procesado){
        $this->procesado = $procesado;
    }
    
    public function movimientoConfirmado()
    {
        return false;
    }    
    
    public function verificarItem($item, $sRealOrigen, $sRealDestino, $stockEnTransito)
    {
       // $stOrigen = $item->getArticulo()->getArticuloMarca()->getArticulo()->getStockArticuloAlmacen($this->almacenOrigen); ///calcula para el almacen orgien la cantidad de articulos existentes 
        $stDestino = $item->getArticulo()->getArticuloMarca()->getArticulo()->getStockArticuloAlmacen($this->almacenDestino);
        if (($item->getCantidad() + $stockEnTransito) > $sRealOrigen)
        {
            return array('ok'=>false, 'warning'=>false, 'msge' => 'El stock del articulo -en el deposito de origen- que intenta transferir es insuficiente!');
        }
        if ($stDestino)
        {        
            if ($stDestino->getSMax() < ($item->getCantidad() + $sRealDestino)){
            return array('ok'=>true, 'warning'=>true, 'msge' => 'La cantidad supera el stock maximo del deposito destino!. La transferencia quedara pendiente de autorizar!');            
            }
        }
        
        return array('ok'=>true, 'warning'=>false, 'msge' => '');
    }    
    
    public function getDepositoAutorizante(){
        return $this->almacenDestino;
    }    
    
    public function getNameProveedor()
    {
        return "";
    }    
    
    public function setAutorizacionFormulario()
    {
        $autorizado = true;
        foreach ($this->getItems() as $item)
        {
            $st = $item->getArticulo()->getArticuloMarca()->getArticulo()->getStockArticuloAlmacen($this->almacenDestino);
            if ($st)
            {
                $autorizado= $autorizado&&(($item->getCantidad() + $item->getArticulo()->getSReal()) <= $st->getSMax());
            }
        }
        $this->setAutorizado($autorizado);
    }    
    
    public function getControlaStockPorMarca()    
    {
        return true;
    }    
}
