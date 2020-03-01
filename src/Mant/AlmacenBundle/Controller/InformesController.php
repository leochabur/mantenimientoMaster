<?php

namespace Mant\AlmacenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mant\AlmacenBundle\Entity\AlmacenRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\JsonResponse;
use Mant\AlmacenBundle\Entity\gestion\Estructura;
use Mant\AlmacenBundle\Entity\gestion\Cargo;
use Mant\AlmacenBundle\Entity\gestion\Empleador;
use Mant\AlmacenBundle\Entity\gestion\Empleado;

class InformesController extends Controller
{
    public function ctaCteArticuloAction(Request $request)
    {
        $form = $this->createFormCtaCteArt();
        if ( $request->isMethod('POST'))
        {   
            $form->handleRequest($request);
            if (!$form->isValid())
            {
                return $this->render('MantAlmacenBundle:informes:resumenCtaCteArticulo.html.twig', array('form' => $form->createView()));
            }
            $em = $this->getDoctrine()->getManager();
            $data = $request->request->get('form'); 
            $deposito = $em->find('MantAlmacenBundle:Almacen', $data['deposito']);
            $repository = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen');
            $articulos = $repository->articulosPorAlmacenConMovimientos($deposito, $data['desde'], $data['hasta']);//articulosPorAlmacen($deposito);
            $forms = array();
            foreach($articulos as $articulo)
            {
                $forms[$articulo['id']] = $this->createFormResumenCtaArticulo('mant_almacen_informes_view_ctacte_articulo', $articulo['id'], $data['deposito'], $data['desde'], $data['hasta'])->createView();
            }
            return $this->render('MantAlmacenBundle:informes:resumenCtaCteArticulo.html.twig', array('form' => $form->createView(), 'articulos' => $articulos, 'forms' => $forms));
        }
        return $this->render('MantAlmacenBundle:informes:resumenCtaCteArticulo.html.twig', array('form' => $form->createView()));
    }
    
    public function createFormResumenCtaArticulo($url, $articulo, $deposito, $desde, $hasta)
    {
        return $this->createFormBuilder()
                    ->add('load', 'submit', array('label'=>'Ver Resumen'))
                    ->add('desde', 'hidden', array('data' => $desde))
                    ->add('hasta', 'hidden', array('data' => $hasta))
                    ->setAction($this->generateUrl($url, array('art' => $articulo, 'dep' => $deposito)))
                    ->setMethod('POST')
                    ->getForm();
    }
    
    private function createFormCtaCteArt($deposito = null)
    {
        $form = $this->createFormBuilder()
                    ->add('deposito', 'entity', array('class' => 'MantAlmacenBundle:Almacen',
                                            'query_builder' => function(AlmacenRepository $er){
                                                                                                return $er->createQueryBuilder('u')
                                                                                                          ->where('u in (:depositos)')
                                                                                                          ->setParameter('depositos', $this->getUser()->getDepositos()->toArray());
                                                                                             }))  
                    ->add('desde', 'date', array('widget' => 'single_text', 'constraints' => array(new NotBlank())))
                    ->add('hasta', 'date', array('widget' => 'single_text', 'constraints' => array(new NotBlank())))
                    ->add('save', 'submit', array('label'=>'Cargar Articulos'));
        return $form->getForm();        
    }
    
    public function viewResumenArticuloAction($art, $dep)
    {
        $request = $this->getRequest();
        $data = $request->request->get('form'); 
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->find('MantAlmacenBundle:Articulo', $art);
        $deposito = $em->find('MantAlmacenBundle:Almacen', $dep);

        $repository = $em->getRepository('MantAlmacenBundle:movimientos\MovimientoStock');
        $movimientos = $repository->findMovimientosArticulos($articulo, $deposito, $data['desde'], $data['hasta']);
        return $this->render('MantAlmacenBundle:informes:viewCtaCteArticulo.html.twig', array('movimientos' => $movimientos, 'articulo'=>$articulo, 'desde'=>$data['desde'], 'hasta'=>$data['hasta']));
    }
    
    public function listadoArticulosAction(Request $request)
    {
        $form = $this->createSelectAlmacen();
        if ( $request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $data = $request->get('form'); 
                $deposito = $data['deposito'];
                $repository = $em->getRepository('MantAlmacenBundle:ArticuloMarcaAlmacen');                
                $articulos = $repository->allArticulosPorDeposito($deposito);
                $forms = array();
                foreach ($articulos as $art)
                {   $label = "Activar";
                    $activar = 1;
                    if ($art->getActivo()){
                        $activar = 0;
                        $label = "Desactivar";
                    }
                    $forms[$art->getId()] = $this->createFormActionArticulo($art->getId(), 'mant_almacen_activar_desactivar_articulo', $label)->createView();
                }
                return $this->render('MantAlmacenBundle:informes:listaArticulos.html.twig', array('form'=>$form->createView(), 'articulos' => $articulos, 'forms'=>$forms));                 
            }
        }
        return $this->render('MantAlmacenBundle:informes:listaArticulos.html.twig', array('form'=>$form->createView()));        
    }
    
    private function createFormActionArticulo($id, $url, $label)
    {
        $form = $this->createFormBuilder()
                    ->add('action', 'submit', array('label'=>$label))
                    ->setAction($this->generateUrl($url, array('art' => $id)));
        return $form->getForm();        
    }    
    
    public function activarDesactivarArticuloAction(Request $request, $art)
    {
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager();
            $articulo = $em->find('MantAlmacenBundle:ArticuloMarcaAlmacen', $art);
            $articulo->setActivo((!$articulo->getActivo()));
            $em->flush();
            return new JsonResponse(array('error'=>true, 'msge' => $art));
        }
    }
    
    private function createSelectAlmacen()
    {
        $form = $this->createFormBuilder()
                    ->add('deposito', 'entity', array('class' => 'MantAlmacenBundle:Almacen',
                                            'query_builder' => function(AlmacenRepository $er){
                                                                                                return $er->createQueryBuilder('u')
                                                                                                          ->where('u in (:depositos)')
                                                                                                          ->setParameter('depositos', $this->getUser()->getDepositos()->toArray());
                                                                                             }))  
                    ->add('save', 'submit', array('label'=>'Cargar Articulos'));
        return $form->getForm();        
    }

    private function getFormSinc()
    {
        return $this->createFormBuilder()
                    ->add('entidades', 'choice', array(
                            'choices'  => array(
                                'Empleados' => 'e',
                                'Unidades' => 'u',
                            ),
                            'choices_as_values' => true,
                        ))
                    ->add('action', 'submit', array('label'=>'Sincronizar'))
                    ->setAction($this->generateUrl('mant_almacen_sincronizar_sistema_trafico_procesar'))
                    ->setMethod('POST')
                    ->getForm();
    }

    public function sincronizarSistemasAction()
    {
        $form = $this->getFormSinc();
        return $this->render('MantAlmacenBundle:informes:sincronizar.html.twig', array('form'=>$form->createView()));   
    }

    public function procesarSyncAction(Request $request)
    {
        $form = $this->getFormSinc();
        $form->handleRequest($request);
        $data = $form->getData();
        $em = $this->getDoctrine()->getManager();
        try
        {
                $local = mysqli_connect($this->getParameter('database_host'),
                                        $this->getParameter('database_user'),
                                        $this->getParameter('database_password'),
                                        $this->getParameter('database_name'));

                $remoto = mysqli_connect('traficonuevo.masterbus.net', 
                                         'c0mbexpuser', 
                                         'Mb2013Exp',
                                         'c0mbexport');

                //se deben actulizar primero las estructuras
                $sql = "SELECT * FROM estructuras";
                $estructuras = mysqli_query($remoto, $sql);
                while ($row = mysqli_fetch_assoc($estructuras))
                {
                    $str = $em->find(Estructura::class, $row['id']);
                    if (!$str)
                    {
                        $insert = "INSERT INTO estructuras ($row[id], '$row[nombre]', '$row[direccion]', $row[cant_cond])";
                        mysqli_query($local,$insert);                        
                    }
                }


                if ($data['entidades'] == 'e')
                {
                    $entidades = "Empleados";
                    //////////////actualiza la lista bde ciudades/////////
                    $sql = "SELECT * FROM ciudades";
                    $ciudades = mysqli_query($remoto, $sql);
                    while ($row = mysqli_fetch_assoc($ciudades))
                    {
                        $city = $this->getCiudad($row['id'], $row['id_estructura']);
                        if (!$city)
                        { 
                            $insert = "INSERT INTO ciudades ($row[id], $row[id_estructura], $row[id_provincia], '$row[ciudad]', $row[lati], $row[long], $row[esCabecera])";
                            mysqli_query($local, $insert);                        
                        }
                    }
                    /////////////////////////////////////////

                    //////////////actualiza la lista de cargos/////////
                    $sql = "SELECT * FROM cargo";
                    $cargos = mysqli_query($remoto, $sql);
                    while ($row = mysqli_fetch_assoc($cargos))
                    {
                        $cargo = $this->getCargo($row['id'], $row['id_estructura']);
                        if (!$cargo)
                        {
                            $insert = "INSERT INTO cargo ('$row[codigo]', '$row[descripcion]', $row[id], $row[id_estructura])";
                            mysqli_query($local, $insert);                        
                        }
                    }
                    /////////////////////////////////////////
                    //////////////actualiza la lista de empleadores/////////
                    $sql = "SELECT * FROM empleadores";
                    $empleadores = mysqli_query($remoto, $sql);
                    while ($row = mysqli_fetch_assoc($empleadores))
                    {
                        $empleador = $em->find(Empleador::class, $row['id']);
                        if (!$empleador)
                        {
                            $insert = "INSERT INTO empleadores ($row[id], '$row[razon_social]', '$row[direccion]', '$row[cuit_cuil]','$row[telefono]','$row[mail]','$row[www]', $row[activo], $row[id_estructura], '$row[color]', '$row[usr]', '$row[pwd]')";
                            mysqli_query($local, $insert);                        
                        }
                    }
                    /////////////////////////////////////////
                    //////////////actualiza la lista de empleados/////////
                    $sql = "SELECT * FROM empleados";
                    $empleados = mysqli_query($remoto, $sql);
                    while ($row = mysqli_fetch_assoc($empleados))
                    {
                        $empleado = $em->find(Empleado::class, $row['id_empleado']);
                        if (!$empleado)
                        {
                            $insert = "INSERT INTO empleados ($row[id_empleado],
                                                              $row[legajo],
                                                                '$row[domicilio]',
                                                                $row[id_ciudad],
                                                                '$row[telefono]',
                                                                $row[id_nacionalidad],
                                                                '$row[sexo]',
                                                                '$row[fechanac]',
                                                                '$row[tipodoc]',
                                                                '$row[nrodoc]',
                                                                '$row[cuil]',
                                                                $row[activo],
                                                                $row[id_sector],
                                                                $row[id_cargo],
                                                                $row[id_empleador],
                                                                '$row[inicio_relacion_laboral]',
                                                                '$row[apellido]',
                                                                '$row[nombre]',
                                                                '$row[login]',
                                                                '$row[password]',
                                                                $row[nivel_acceso],
                                                                $row[contratado],
                                                                '$row[fecha_alta]',
                                                                '$row[fecha_ocupacional]',
                                                                $row[id_estructura],
                                                                $row[id_estructura_empleador],
                                                                $row[procesado],
                                                                $row[id_estructura_cargo],
                                                                $row[id_estructura_ciudad],
                                                                $row[afectado_a_estructura],
                                                                $row[borrado],
                                                                $row[usuario_alta_provisoria],
                                                                $row[usuario_alta_definitiva],
                                                                '$row[fecha_alta_definitiva]',
                                                                '$row[fecha_fin_relacion_laboral]')";
                            mysqli_query($local, $insert);                        
                        }
                        else{ //si el empleado ya existe actualiza el campo parasaber si sigue activo
                            $empleado->setActivo($row['activo']);
                        }
                    }
                    /////////////////////////////////////////
                }
        }
        catch (\Exception $e){return new JsonResponse(array('eleccion' => $e->getMessage()));}
        
        return new JsonResponse(array('eleccion' => "$entidades sincronizados exitosamente!"));
    }

    private function getCiudad($city, $str)
    {
        $dql = "SELECT c
                FROM MantAlmacenBundle:gestion\Ciudad c
                JOIN c.estructura e
                WHERE c.id = :city AND e.id = :str";
        return $this->getDoctrine()
                    ->getManager()
                    ->createQuery($dql)
                    ->setParameter('city', $city)
                    ->setParameter('str', $str)
                    ->getOneOrNullResult();
    }

    private function getCargo($cargo, $str)
    {
        $dql = "SELECT c
                FROM MantAlmacenBundle:gestion\Cargo c
                JOIN c.estructura e
                WHERE c.id = :cargo AND e.id = :str";
        return $this->getDoctrine()
                    ->getManager()
                    ->createQuery($dql)
                    ->setParameter('cargo', $cargo)
                    ->setParameter('str', $str)
                    ->getOneOrNullResult();
    }
        
}
