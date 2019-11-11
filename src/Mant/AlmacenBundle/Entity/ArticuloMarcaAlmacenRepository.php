<?php

namespace Mant\AlmacenBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Mant\AlmacenBundle\Entity\Almacen;
use Mant\AlmacenBundle\Entity\movimientos\OrdenCompra;
use Mant\AlmacenBundle\Entity\movimientos\DocumentoEntrada;
/**
 * ArticuloAlmacenRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticuloMarcaAlmacenRepository extends EntityRepository
{
    public function articulosPorDeposito($origen, $destino = null)
    {
        $almacen = is_null($origen)?$destino:$origen;
        return $this->getEntityManager()
                    ->createQuery('SELECT a 
                                  FROM MantAlmacenBundle:ArticuloMarcaAlmacen a 
                                  JOIN a.articuloMarca am 
                                  JOIN am.articulo ar 
                                  WHERE a.almacen = :almacen and a.activo = :activo 
                                  ORDER BY ar.descripcion, ar.codigo')
                    ->setParameter('almacen', $almacen)
                    ->setParameter('activo', true)
                    ->getResult();
    }
    
    public function allArticulosPorDeposito($almacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT a 
                                  FROM MantAlmacenBundle:ArticuloMarcaAlmacen a 
                                  JOIN a.articuloMarca am 
                                  JOIN am.articulo ar 
                                  WHERE a.almacen = :almacen
                                  ORDER BY ar.descripcion, ar.codigo')
                    ->setParameter('almacen', $almacen)
                    ->getResult();
    }    
    
    public function stockArticulosPorDeposito($almacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT ar.id, ar.codigo, ar.descripcion, sum(a.sReal) as stock, c.clasificacion as clasificacion, u.unidad as unidad FROM MantAlmacenBundle:ArticuloMarcaAlmacen a JOIN a.articuloMarca am JOIN am.articulo ar JOIN ar.clasificacion c LEFT JOIN ar.unidad u WHERE a.almacen = :almacen AND a.activo = :activo GROUP BY ar')
                    ->setParameter('almacen', $almacen)
                    ->setParameter('activo', true)
                    ->getResult();
    }
    
    public function articulosPorAlmacen($almacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT ar.id, ar.codigo, ar.descripcion, saa.sMin, saa.sMax, saa.ubicacion, u.unidad, c.clasificacion, u.unidad
                                   FROM MantAlmacenBundle:ArticuloMarcaAlmacen ama
                                   JOIN ama.almacen al
                                   JOIN ama.articuloMarca am
                                   JOIN am.articulo ar
                                   JOIN ar.clasificacion c
                                   LEFT JOIN ar.unidad u
                                   LEFT JOIN MantAlmacenBundle:StockArticuloAlmacen saa WITH saa.articulo = ar AND saa.almacen = ama.almacen
                                   WHERE ama.almacen = :almacen AND ama.activo = :activo
                                   GROUP BY ar
                                   ORDER BY ar.descripcion')
                    ->setParameter('almacen', $almacen)
                    ->setParameter('activo', true)
                    ->getResult();
    }
    
    public function articulosPorAlmacenConMovimientos($almacen, $desde, $hasta) ///para un deposito dado devuelve los articulos con movimiento entre las fechas selecciondas
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT ar.id, ar.codigo, ar.descripcion, saa.sMin, saa.sMax, saa.ubicacion, u.unidad, c.clasificacion, u.unidad
                                    FROM MantAlmacenBundle:movimientos\MovimientoStock ms
                                    JOIN ms.items im
                                    JOIN im.articulo ama
                                    JOIN ama.almacen al
                                    JOIN ama.articuloMarca am
                                    JOIN am.articulo ar
                                    JOIN ar.clasificacion c
                                    LEFT JOIN ar.unidad u
                                    LEFT JOIN MantAlmacenBundle:StockArticuloAlmacen saa WITH saa.articulo = ar AND saa.almacen = ama.almacen
                                    WHERE ama.almacen = :almacen AND ama.activo = :activo AND ms.fecha BETWEEN :desde AND :hasta
                                    GROUP BY ar
                                    ORDER BY ar.descripcion')
                    ->setParameter('almacen', $almacen)
                    ->setParameter('desde', $desde)
                    ->setParameter('hasta', $hasta)                    
                    ->setParameter('activo', true)
                    ->getResult();
    }    
    
    public function getArticuloMarcaAlmacen($almacen, $articuloMarca)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT a FROM MantAlmacenBundle:ArticuloMarcaAlmacen a WHERE a.articuloMarca = :articulo AND a.almacen = :almacen AND a.activo = :activo')
                    ->setParameter('almacen', $almacen)
                    ->setParameter('articulo', $articuloMarca)
                    ->setParameter('activo', true)
                    ->getOneOrNullResult();
    }        
    
    public function getStockArticuloAlmacen($idArticulo, $idAlmacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT a 
                                   FROM MantAlmacenBundle:StockArticuloAlmacen a 
                                   JOIN a.almacen al
                                   JOIN a.articulo ar
                                   WHERE ar.id = :articulo AND al.id = :almacen')
                    ->setParameter('articulo', $idArticulo)
                    ->setParameter('almacen', $idAlmacen)                    
                    ->getOneOrNullResult();
    }
    
    public function getStockMaxMinArticuloAlmacen($articulo, $almacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT SUM(ama.sReal) as stock, ar.id as id
                                   FROM MantAlmacenBundle:ArticuloMarcaAlmacen ama
                                   JOIN ama.articuloMarca am
                                   JOIN am.articulo ar
                                   WHERE ama.almacen = :almacen AND ar = :articulo
                                   GROUP BY ar.id')
                    ->setParameter('almacen', $almacen)                    
                    ->setParameter('articulo', $articulo)         
                    ->getOneOrNullResult();
    }   
    
    public function articulosConMarcaPorDeposito($almacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT am 
                                   FROM MantAlmacenBundle:ArticuloMarca am
                                   INNER JOIN MantAlmacenBundle:ArticuloMarcaAlmacen ama WITH ama.articuloMarca = am
                                   WHERE ama.almacen = :almacen')
                    ->setParameter('almacen', $almacen)
                    ->getResult();
    }    
    
    public function getStockArticuloMarcaAlmacen($articulo, $almacen)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT SUM(ama.sReal) as stock, ar.id as id
                                   FROM MantAlmacenBundle:ArticuloMarcaAlmacen ama
                                   JOIN ama.articuloMarca am
                                   JOIN am.articulo ar
                                   WHERE ama.almacen = :almacen AND ar = :articulo
                                   GROUP BY ar.id')
                    ->setParameter('almacen', $almacen)                    
                    ->setParameter('articulo', $articulo)         
                    ->getOneOrNullResult();
    }   
    
    public function getStockArticuloPendienteDeConfirmar($ama)///devuelve la cantidad del ArticuloMarcaAlmacen dado de los movimientos que estan pendientes de finalizar (Pausados)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT SUM(it.cantidad) as stock
                                   FROM MantAlmacenBundle:movimientos\MovimientoStock ms  
                                   JOIN ms.items it
                                   JOIN it.articulo ama
                                   JOIN ama.articuloMarca am
                                   JOIN am.articulo ar
                                   WHERE ms.confirmado = :confirmado AND ama = :articulo AND (NOT(ms INSTANCE OF :type2)) AND (NOT(ms INSTANCE OF :type))
                                   GROUP BY ama.id')        
                    ->setParameter('confirmado', false)                    
                    ->setParameter('articulo', $ama)
                    ->setParameter('type', $this->getEntityManager()->getClassMetadata(OrdenCompra::class))        
                    ->setParameter('type2', $this->getEntityManager()->getClassMetadata(DocumentoEntrada::class))               
                    ->getOneOrNullResult();
    }
    
}
