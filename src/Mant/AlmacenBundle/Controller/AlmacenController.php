<?php

namespace Mant\AlmacenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mant\AlmacenBundle\Form\AlmacenType;
use Mant\AlmacenBundle\Entity\Almacen;
use Mant\AlmacenBundle\Form\ClasificacionType;
use Mant\AlmacenBundle\Entity\Clasificacion;
use Mant\AlmacenBundle\Form\MarcaType;
use Mant\AlmacenBundle\Entity\Marca;
use Mant\AlmacenBundle\Form\ArticuloType;
use Mant\AlmacenBundle\Form\ArticuloAlmacenType;
use Mant\AlmacenBundle\Entity\Articulo;
use Symfony\Component\HttpFoundation\Request;
use Mant\AlmacenBundle\Entity\AlmacenRepository;
use Symfony\Component\HttpFoundation\Response;
use Mant\AlmacenBundle\Form\ArticuloMarcaAlmacenType;
use Mant\AlmacenBundle\Form\ArticuloBaseType;
use Mant\AlmacenBundle\Entity\ArticuloMarcaAlmacen;
use Mant\AlmacenBundle\Entity\MarcaRepository;
use Mant\AlmacenBundle\Entity\ArticuloMarca;
use Symfony\Component\HttpFoundation\JsonResponse;
use Mant\AlmacenBundle\Entity\StockArticuloAlmacen;
use Mant\AlmacenBundle\Entity\Unidad;
use Mant\AlmacenBundle\Form\UnidadType;

class AlmacenController extends Controller
{
    public function altaUnidadMedidaAction()
    {
        $unidaMedida = new Unidad;
        $form = $this->createForm(new UnidadType(), $unidaMedida, array('action'=>$this->generateUrl('mant_nueva_unidad_medida_procesar'), 'method'=>'POST'));
        return $this->render('MantAlmacenBundle:options:addUnidadMedida.html.twig', array('form'=>$form->createView()));  
    }

    public function altaUnidadMedidaProcesarAction(Request $request)
    {
        $unidaMedida = new Unidad;
        $form = $this->createForm(new UnidadType(), $unidaMedida, array('action'=>$this->generateUrl('mant_nueva_unidad_medida_procesar'), 'method'=>'POST'));
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unidaMedida);
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha almacenado con exito la unidad de medida en la Base de Datos!'
                            );    
            return $this->redirectToRoute('mant_nueva_unidad_medida');
        }
        return $this->render('MantAlmacenBundle:options:addUnidadMedida.html.twig', array('form'=>$form->createView()));  
    }

    public function addAction()
    {
        $almacen = new Almacen();
        $form = $this->crearFormularioAltaAlmacen($almacen);
        return $this->render('MantAlmacenBundle:options:addAlmacen.html.twig', array('form'=>$form->createView()));        
    }
    
    private function crearFormularioAltaAlmacen(Almacen $almacen)
    {
        return $this->createForm(new AlmacenType(), $almacen, array('action'=>$this->generateUrl('gestion_mant_create_almacen'), 'method'=>'POST'));
    } 
    
    public function createalmacenAction(Request $request)
    {
        $almacen = new Almacen();
        $form = $this->crearFormularioAltaAlmacen($almacen);
        $form->handleRequest($request);
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $almacen->setUser($user);
            $em->persist($almacen);
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha almacenado con exito el deposito en la Base de Datos!'
                            );            
            return $this->redirectToRoute('mant_almacen_addAlmacen');
        }
        return $this->render('MantAlmacenBundle:options:addAlmacen.html.twig', array('form'=>$form->createView()));
    }
    
    public function listAction()
    {
        $almacenes = $this->getDoctrine()->getRepository(Almacen::class)->findAlmacenesActivas();
        return $this->render('MantAlmacenBundle:options:listaAlmacenes.html.twig', array('almacenes'=>$almacenes));        
    }
    
    public function addclasificacionAction()
    {
        $clasificacion = new Clasificacion();
        $form = $this->crearFormularioAltaClasificacion($clasificacion);
        return $this->render('MantAlmacenBundle:options:addClasificacion.html.twig', array('form'=>$form->createView()));        
    }
    
    private function crearFormularioAltaClasificacion(Clasificacion $class)
    {
        return $this->createForm(new ClasificacionType(), $class, array('action'=>$this->generateUrl('gestion_mant_create_clasificacion'), 'method'=>'POST'));
    }
    
    public function createclasificacionAction(Request $request)
    {
        $clasificacion = new Clasificacion();
        $form = $this->crearFormularioAltaClasificacion($clasificacion);
        $form->handleRequest($request);
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $clasificacion->setUser($user);
            $em->persist($clasificacion);
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha almacenado con exito la clasificacion en la Base de Datos!'
                            );            
            return $this->redirectToRoute('mant_almacen_add_clasificacion');
        }
        return $this->render('MantAlmacenBundle:options:addClasificacion.html.twig', array('form'=>$form->createView()));
    } 
    
////
    public function addmarcaAction()
    {
        $marca = new Marca();
        $form = $this->crearFormularioAltaMarca($marca);
        return $this->render('MantAlmacenBundle:options:addMarca.html.twig', array('form'=>$form->createView()));        
    }
    
    private function crearFormularioAltaMarca(Marca $marca)
    {
        return $this->createForm(new MarcaType(), $marca, array('action'=>$this->generateUrl('gestion_mant_create_marca'), 'method'=>'POST'));
    }
    
    public function createmarcaAction(Request $request)
    {
        $marca = new Marca();
        $form = $this->crearFormularioAltaMarca($marca);
        $form->handleRequest($request);
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $marca->setUser($user);
            $em->persist($marca);
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha almacenado con exito la Marca en la Base de Datos!'
                            );            
            return $this->redirectToRoute('mant_almacen_add_marca');
        }
        return $this->render('MantAlmacenBundle:options:addMarca.html.twig', array('form'=>$form->createView()));
    }
    
////Manejo de articulos
    public function addarticuloAction()
    {
        $articulo = new Articulo();
        $form = $this->crearFormularioAltaArticulo($articulo);
        return $this->render('MantAlmacenBundle:options:addArticulo.html.twig', array('form'=>$form->createView()));        
    }
    
    private function crearFormularioAltaArticulo(Articulo $articulo)
    {
        return $this->createForm(new ArticuloType(), $articulo, array('action'=>$this->generateUrl('gestion_mant_create_articulo'), 'method'=>'POST'));
    } 
    
    public function createarticuloAction(Request $request)
    {
        $articulo = new Articulo();
        $form = $this->crearFormularioAltaArticulo($articulo);
        $form->handleRequest($request);
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $articulo->setUser($user);
            $em->persist($articulo);
            
            foreach ($articulo->getAlmacenes() as $almacen)
            {
                foreach($articulo->getArticulosMarca() as $articuloMarca){
                    $artMarcaAlmacen = new ArticuloMarcaAlmacen();
                    $artMarcaAlmacen->setAlmacen($almacen);
                    $artMarcaAlmacen->setArticuloMarca($articuloMarca);
                    $em->persist($artMarcaAlmacen);
                }
            }          
            
          /*  foreach ($articulo->getArticulosAlmacen() as $artAlmacen)
            {
                $artAlmacen->setUsuario($user);
            }    */        
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha almacenado con exito el Articulo en la Base de Datos!'
                            );            
            return $this->redirectToRoute('mant_almacen_add_articulo');
        }
        return $this->render('MantAlmacenBundle:options:addArticulo.html.twig', array('form'=>$form->createView()));
    }
    
    public function editArticuloMarcaAlmacenAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->find($id);
        
        $form = $this->createEditArticuloAlmacenForm($articulo);
        return $this->render('MantAlmacenBundle:options:editArticuloMarcaAlmacen.html.twig', array('articulo' => $articulo,'form'=>$form->createView()));
    }
    
    private function createEditArticuloAlmacenForm(ArticuloMarcaAlmacen $articulo)
    {
        return $this->createForm(new ArticuloMarcaAlmacenType(), $articulo, array('action' => $this->generateUrl('gestion_mant_update_articulo_marca_almacen', array('id' => $articulo->getId())), 'method' => 'POST'));
        
    }
    
    public function updateArticuloMarcaAlmacenAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->find($id);
        $form = $this->createEditArticuloAlmacenForm($articulo);
        $form->handleRequest($request);
        if ($form->isValid()){
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha modificado con exito el Articulo en la Base de Datos!'
                            );              
            return $this->redirectToRoute('mant_almacen_list_articulos');
        }
        return $this->render('MantAlmacenBundle:options:editArticuloAlmacen.html.twig', array('articulo' => $articulo,'form'=>$form->createView()));        
        
        
    }
    
    private function createFormSelectAlmacen()
    {
        return $this->createFormBuilder()
                        ->add('almacenes', 'entity', array('class' => 'MantAlmacenBundle:Almacen',
                                            'query_builder' => function(AlmacenRepository $er){
                                                                                                return $er->createQueryBuilder('u')
                                                                                                          ->where('u in (:depositos)')
                                                                                                          ->setParameter('depositos', $this->getUser()->getDepositos()->toArray());
                                                                                             }))  
                        ->add('save', 'submit', array('label'=>'Cargar Articulos'))
                        ->getForm();
    }
    
    public function listarArticulosAction(Request $request)
    {
            $form = $this->createFormSelectAlmacen();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $articulos = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->articulosPorDeposito($data['almacenes']);
                $formDelete = $this->createEditStockInicialForm('mant_articulo_update_stock_inicial', 'POST', ':ART_ID'); 
                return $this->render('MantAlmacenBundle:options:listArticles.html.twig', 
                                      array('form'=>$form->createView(), 'articulos' => $articulos, 'almacen' => $data['almacenes'], 'formUpdateStockInicial' => $formDelete->createView()));   
            }
            else{
                return $this->render('MantAlmacenBundle:options:listArticles.html.twig', array('form'=>$form->createView())); 
            }
    }
    
    private function createEditStockInicialForm($url, $method, $id)
    {
       return $this->createFormBuilder()
                    ->add('valor', 'hidden')
                    ->setAction($this->generateUrl($url, array('id' => $id)))
                    ->setMethod($method)
                    ->getForm();
    }
    
    public function updateStockInicialAction($id, Request $request)
    {
        try{
                $em = $this->getDoctrine()->getManager();
                $articulo = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->find($id);
                $smin = $request->request->get('form')['valor'];
                if (!is_numeric($smin))
                    return new Response('Error');
                    
                $articulo->setSReal($smin);
                $em->flush();
                return new Response('Pagos');
            }catch(Exception $e) {
                                                        return new Response($e->getMessage());
                                                     }
    }
    
    public function stockXDepositoAction(Request $request)
    {
            $form = $this->createFormSelectAlmacen();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $articulos = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->stockArticulosPorDeposito($data['almacenes']);
                return $this->render('MantAlmacenBundle:options:listStockArticles.html.twig', 
                                      array('form'=>$form->createView(), 'articulos' => $articulos, 'almacen' => $data['almacenes']));   
            }
            else{
                return $this->render('MantAlmacenBundle:options:listStockArticles.html.twig', array('form'=>$form->createView())); 
            }        
     /*   $em = $this->getDoctrine()->getManager();
        $stocks = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->stockArticulosPorDeposito();
        return new Response(var_dump($stocks));*/
    }
    
    public function editArticuloBaseAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('MantAlmacenBundle:Articulo')->find($id);        
        $form = $this->createFormEditArtBase($articulo);
        return $this->render('MantAlmacenBundle:options:editArticuloBase.html.twig', array('form'=>$form->createView(), 'articulo' => $articulo, 'addmca' => $this->addFormMarcaArticulo($id, 'mant_articulo_add_mca_art_base', 'POST')->createView())); 
    }
    
    public function updateArticuloBaseAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('MantAlmacenBundle:Articulo')->find($id);        
        $form = $this->createFormEditArtBase($articulo);        
        $form->handleRequest($request);
        if ($form->isValid()){
            $em->flush();
            $this->addFlash(
                            'response',
                            'Se ha modificado con exito el Articulo en la Base de Datos!'
                            );              
            return $this->redirectToRoute('mant_almacen_stock_por_deposito');
        }
        return $this->render('MantAlmacenBundle:options:editArticuloBase.html.twig', array('form'=>$form->createView(), 'articulo' => $articulo)); 
    }
    
    private function addFormMarcaArticulo($idArticulo, $url, $method){
        return  $this->createFormBuilder()
                     ->add('marcas', 'entity', array('class' => 'MantAlmacenBundle:Marca',
                                                        'query_builder' => function(MarcaRepository $er){
                                                                                                            return $er->createQueryBuilder('u');
                                                                                                          }))
                     ->add('save', 'submit', array('label'=>'Agregar Marca'))
                     ->setAction($this->generateUrl($url, array('id' => $idArticulo)))
                     ->setMethod($method)
                     ->getForm();        
        
    }
    
    public function addMarcaArtBaseAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('MantAlmacenBundle:Articulo')->find($id);  
        try{ 
            $form = $this->addFormMarcaArticulo($id, 'mant_articulo_add_mca_art_base', 'POST');        
            $form->handleRequest($request);    
            if ($form->isValid()) {
                $marca = $form->getData()['marcas'];
                
                $artMarca = $articulo->getArticuloMarca($marca);
                if (!$artMarca){
                    $artMarca = new ArticuloMarca();
                    $artMarca->setArticulo($articulo);
                    $artMarca->setMarca($marca);
                    $em->persist($artMarca);
                    foreach ($articulo->getAlmacenes() as $almacen){
                        $artMcaAlm = new ArticuloMarcaAlmacen();
                        $artMcaAlm->setAlmacen($almacen);
                        $artMcaAlm->setArticuloMarca($artMarca);
                        $em->persist($artMcaAlm);
                    }
                    $em->flush();
                    $response = new JsonResponse(array('state' => true));
                    return $response;                    
                }
                else{
                    $response = new JsonResponse(array('state' => false, 'msge' => 'Ya existe la marca para el articulo!!'));
                    return $response;
                }      
            }

        }catch(Exception $e) {
                                $response = new JsonResponse(array('state' => false, 'msge' => $e->getMessage()));
                                return $response;            
                            }
    }
    
    private function createFormEditArtBase($articulo)
    {
        $form = $this->createForm(new ArticuloBaseType(), $articulo, 
                                  array('action' => $this->generateUrl('mant_articulo_update_articulo_base', array('id' => $articulo->getId())), 
                                        'method' => 'POST'));     
        return $form;
    }
    
    
    public function setStockMinimoMaximoAction(Request $request)
    {
       $form = $this->generateFormSelectAlmacen("mant_set_stock_minimo_maximo", "POST");
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $articulos = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->articulosPorAlmacen($data['almacen']);
            
            $forms = array();
            foreach ($articulos as $articulo)
            {
                $forms[$articulo['id']] = $this->getFormUpdateSMM($articulo['id'], $data['almacen']->getId(), 'mant_articulo_update_stock_min_max', 'POST',$articulo['sMin'],$articulo['sMax'],$articulo['ubicacion'])->createView(); 
            }
            
            return $this->render('MantAlmacenBundle:options:selectAlmacenAction.html.twig', 
                                   array('form'=>$form->createView(), 'title'=>'Cargar Stock Maximo/Minimo', 'articulos'=>$articulos, 'forms' => $forms));
       }
       return $this->render('MantAlmacenBundle:options:selectAlmacenAction.html.twig', array('form'=>$form->createView(), 'title'=>'Cargar Stock Maximo/Minimo')); 
    }
    
    private function getFormUpdateSMM($id, $deposito, $url, $method, $smin, $smax, $ubica)
    {
        return  $this->createFormBuilder()
                     ->add('smin', 'text', array('data' => $smin))
                     ->add('smax', 'text', array('data' => $smax))
                     ->add('ubicacion', 'text', array('data' => $ubica))
                     ->add('save', 'submit', array('label'=>'Guardar'))
                     ->setAction($this->generateUrl($url, array('idArt' => $id, 'idAlm' => $deposito)))
                     ->setMethod($method)
                     ->getForm();            
    }
    
    private function generateFormSelectAlmacen($url, $method)
    {
        return  $this->createFormBuilder()
                    ->add('almacen', 'entity', array('class' => 'MantAlmacenBundle:Almacen',
                                            'query_builder' => function(AlmacenRepository $er){
                                                                                                return $er->createQueryBuilder('u')
                                                                                                          ->where('u in (:depositos)')
                                                                                                          ->setParameter('depositos', $this->getUser()->getDepositos()->toArray());
                                                                                             }))  
                     ->add('save', 'submit', array('label'=>'Siguiente...'))
                     ->setAction($this->generateUrl($url))
                     ->setMethod($method)
                     ->getForm();
    }
    
    public function updateStockMaxMinAction($idArt, $idAlm, Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            try{
                $em = $this->getDoctrine()->getManager();
                $articulo = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->getStockArticuloAlmacen($idArt, $idAlm);
                $form = $this->getFormUpdateSMM($idArt, $idAlm, 'mant_articulo_update_stock_min_max', 'POST', 0, 0, '');
                $form->handleRequest($request);
                 
                if ($form->isValid()) {
                    $data = $form->getData();
                    if (($data['smin'] < 0) || ($data['smax'] < 0)) ///el stock minimo es mayor al stock maximo
                    {
                        return new JsonResponse(array('ok' => false, 'msge' => 'No se admiten valores menores a cero!'));
                    }                    
                    
                    if ($data['smin'] > $data['smax']) ///el stock minimo es mayor al stock maximo
                    {
                        return new JsonResponse(array('ok' => false, 'msge' => 'El stock minimo no puede ser mayor al stock maximo!'));
                    }
                    
                    if (!$articulo)///si no exite cargado el stock lo crea
                    {
                        $art = $em->getRepository('MantAlmacenBundle:Articulo')->find($idArt);   
                        $alm = $em->getRepository('MantAlmacenBundle:Almacen')->find($idAlm);      
                        $articulo = new StockArticuloAlmacen();
                        $articulo->setAlmacen($alm);
                        $articulo->setArticulo($art);
                        $em->persist($articulo);
                    }
                    $articulo->setSMin($data['smin']);
                    $articulo->setSMax($data['smax']);
                    $articulo->setUbicacion($data['ubicacion']);
                    $em->flush();
                    return new JsonResponse(array('ok' => true, 'msge' => 'Actuzalizacion realizada exitosamente!'));
                }
                else{
                    return new Response("erororororororo");
                }
            }
            catch (\Exception $e) {
                                    return new Response($e->getMessage());    
            }
                    
        }
        else
        {
            return new Response("PETICION INCORRECTA");    
        }

    }
    
    public function importArtAlmacenAction(Request $request)
    {
        $form = $this->createFormImportArticulos('POST');
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $articulosOrigen = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->articulosConMarcaPorDeposito($data['origen']);            
            $articulosDestino = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen')->articulosConMarcaPorDeposito($data['destino']);             
            foreach ($articulosOrigen as $articulo)
            {
                if (!in_array($articulo, $articulosDestino))
                {
                    $ama = new ArticuloMarcaAlmacen();
                    $ama->setArticuloMarca($articulo);
                    $ama->setAlmacen($data['destino']);
                    $ama->setUsuario($this->getUser());
                    $em->persist($ama);
                }
            }
            $em->flush();
            return new Response("No esiste");    
        }
        return $this->render('MantAlmacenBundle:options:importArtAlmacen.html.twig', array('form' => $form->createView()));
    }
    
    private function createFormImportArticulos($method)
    {
        return  $this->createFormBuilder()
                    ->add('origen', 'entity', array('class' => 'MantAlmacenBundle:Almacen',
                                            'query_builder' => function(AlmacenRepository $er){
                                                                                                return $er->createQueryBuilder('u')
                                                                                                          ->where('u in (:depositos)')
                                                                                                          ->setParameter('depositos', $this->getUser()->getDepositos()->toArray());
                                                                                             }))  
                    ->add('destino', 'entity', array('class' => 'MantAlmacenBundle:Almacen',
                                            'query_builder' => function(AlmacenRepository $er){
                                                                                                return $er->createQueryBuilder('u')
                                                                                                          ->where('u in (:depositos)')
                                                                                                          ->setParameter('depositos', $this->getUser()->getDepositos()->toArray());
                                                                                             }))                                                                                               
                     ->add('save', 'submit', array('label'=>'Importar'))
                     ->setMethod($method)
                     ->getForm();
    }    
}
