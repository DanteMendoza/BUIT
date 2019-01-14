<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Usuarios;
use App\Entity\Infracciones;
use SoapClient;

class ApiController extends AbstractController{

    /**
     * @Route("/api", name="raizApi", methods={"GET"})
     */
    public function raizApi(Connection $connection){
         return $this->json(array('respuesta' => 'raiz de API'));
    }

    /***************************************************/
    /*
     *  Version 1 de API
     *  Consulta SQL directa, se transforma el array devuelto en un json
     */

    /**
     * @Route("/api/v1/usuarios/", name="listarTodosUsuariosV1", methods={"GET"})
     */
    public function listarTodosUsuariosV1(Connection $connection){
        try{
            $results = $connection->fetchAll('SELECT * FROM usuarios');
            return $this->json($results);
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }


    /**

     * @Route("/api/v1/usuario/{dni<\d+>}", name="buscarUsuarioPorDniV1", methods={"GET"})
     */
    public function buscarUsuarioPorDniV1($dni ,Connection $connection){
        try{
            $sql = "SELECT * FROM usuarios WHERE dni = :dni";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':dni', $dni, ParameterType::INTEGER);
            $stmt->execute();
            $result = $stmt->fetch();
            if (!$result) {
              throw new \Exception("Usuario con dni ".$dni." no encontrado");
            }
            return $this->json($result);
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }

     /**
     * @Route("/api/v1/usuario/{nombre}", name="buscarUsuarioPorNombreV1", methods={"GET"})
     */
    public function buscarUsuarioPorNombreV1($nombre ,Connection $connection){
        try{
            $sql = "SELECT * FROM usuarios WHERE nyape like \"%".$nombre."%\"";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            //array para devolver
            $resultado_final=array();
            while($result = $stmt->fetch()){
               //armo array con cada fila que devuelve la DB
               $resultado_final[]=$result;
            }
            if (!count($resultado_final)) {
              throw new \Exception("Usuario con nombre ".$nombre." no encontrado");
            }
            return $this->json($resultado_final);
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }


    /***************************************************/
    /*
     *  Version 2 de API
     *  Uso de Doctrine para trabajar con las entidades
     *  La respuesta se serializa, se convierte a JSON y se envia al browser
     */
    /**
     * @Route("/api/v2/usuario/{dni<\d+>}", name="buscarUsuarioPorDniV2", methods={"GET"})
     */

    public function buscarUsuarioPorDniV2($dni){
        try{
            // Instanciamos el encoder de JSON y el ObjectNormalizer
            // para que la Response devuelva un JSON formateado correctamente.
            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            // Se setea la referencia circular del normalizador en 1,
            // para que solo baje un nivel dentro de Infracciones
            // y solo traiga el DNI correspondiente a la infracción
            // y no traiga el objeto usuario completo.
            $normalizer->setCircularReferenceLimit(1);
            // Se agrega el handler correspondiente, y se le indica que use getDni() como buscador de id.
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getDni();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);
            $usuario = $this->getDoctrine()->getRepository(Usuarios::class)->findByDni($dni);
            if (!$usuario) {
                throw new \Exception("Usuario con dni " . $dni . " no encontrado");
            }
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($serializer->serialize($usuario, 'json'));
            return $response;
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }

     /**
     * @Route("/api/v2/usuarios/", name="listarTodosUsuariosV2", methods={"GET"})
     */

    public function listarTodosUsuariosV2(){
        try{
            // Instanciamos el encoder de JSON y el ObjectNormalizer
            // para que la Response devuelva un JSON formateado correctamente.
            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            // Se setea la referencia circular del normalizador en 1,
            // para que solo baje un nivel dentro de Infracciones
            // y solo traiga el DNI correspondiente a la infracción
            // y no traiga el objeto usuario completo.
            $normalizer->setCircularReferenceLimit(1);
            // Se agrega el handler correspondiente, y se le indica que use getDni() como buscador de id.
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getDni();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);
            $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->findAll();
            if (!$usuarios) {
                throw new \Exception("Usuarios no encontrados");
            }
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($serializer->serialize($usuarios, 'json'));

            return $response;
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }

     /**
     * @Route("/api/v2/usuario/{nombre}", name="buscarUsuariosPorNombreV2", methods={"GET"})
     */

    public function buscarUsuariosPorNombreV2($nombre){
        try{
            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $entityManager = $this->getDoctrine()->getEntityManager();
            $query = $entityManager->createQuery(
                'SELECT c.dni, c.nyape FROM App\Entity\Usuarios c
                WHERE c.nyape LIKE :nombre')->setParameter('nombre', "%".$nombre."%");
            $usuarios = $query->execute();
            if (!$usuarios) {
                throw new \Exception("Usuario con nombre ".$nombre." no encontrado");
            }
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($serializer->serialize($usuarios, 'json'));
            return $response;
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }

    /**
     * @Route("/api/v2/usuario/infracciones/{dni<\d+>}", name="buscarInfraccionesDeUsuarioPorDni", methods={"GET"})
     */

    public function buscarInfraccionesDeUsuarioPorDni($dni){
        try{
            // Instanciamos el encoder de JSON y el ObjectNormalizer
            // para que la Response devuelva un JSON formateado correctamente.
            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            // Se setea la referencia circular del normalizador en 1,
            // para que solo baje un nivel dentro de Infracciones
            // y solo traiga el DNI correspondiente a la infracción
            // y no traiga el objeto usuario completo.
            $normalizer->setCircularReferenceLimit(1);
            // Se agrega el handler correspondiente, y se le indica que use getDni() como buscador de id.
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getDni();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);
            //Instancia el usuario, buscandolo con Repository en base al DNI ingresado en el route.
            $usuario = $this->getDoctrine()
                ->getRepository(Usuarios::class)
                ->find($dni);
            if (!$usuario) {
                throw new \Exception("Usuario con dni ".$dni." no encontrado");
            }
            // Instanciamos la nueva respuesta, seteamos los headers para que devuelva un JSON
            // y luego usamos el serializador para setear el contenido de la respuesta como JSON.
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($serializer->serialize($usuario, 'json',array('attributes' => array('dni','nyape','infracciones'=>array('nroInfraccion','monto')))));
            return $response;
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }

    }


    /**
     * FUNCION PARA BORRAR UN USUARIO.
     * @Route("/api/usuario/borrar/", name="borrarUsuario", methods={"DELETE"})
     */
    public function borrarUsuario(Request $request){
        try{
            $jsonRecibido = json_decode($request->getContent(), true);
            $dni = $jsonRecibido['dni'];
            $entityManager = $this->getDoctrine()->getManager();
            $usuario = $entityManager->getRepository(Usuarios::class)->find($dni);
            // Verifica si existe el usuario y retorna "false" en caso de no encontrar ningun registro.
            if (!$usuario) {
                throw new \Exception("Usuario con dni ".$dni." no encontrado");
            }
            // Se elimina el registro con el numero de dni encontrado.
            $entityManager->remove($usuario);
            $entityManager->flush();
            return $this->json(array('respuesta' => "Usuario con dni ".$dni." borrado"));
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }

   /**
     * Recibe por PUT via json el nombre del usuario a dar de alta
     * @Route("/api/usuarios/alta/", name="altaUsuario",methods={"PUT"})
     */
    public function altaUsuario(Request $request){
          try{
              $datarecibida = json_decode($request->getContent(), true);
              $entityManager = $this->getDoctrine()->getManager();
              $nombre=$datarecibida['nombre'];
              $usuario = new Usuarios();
              $usuario->setNyape($nombre);
              $entityManager->persist($usuario);
              $entityManager->flush();
              return $this->json(array('respuesta' => "Cargado nombre ". $nombre));
          }
          //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
          catch(\Exception $e){
              $response = new Response();
              $response->headers->set('Content-Type', 'application/json');
              //Ajusto el codigo de respuesta
              $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
              $response->setContent($this->json(array('error' => $e->getMessage())));
              return $response;
          }
    }

    /**
     * @Route("/api/v2/usuario/modificarnombre/{dni<\d+>}", name="modificarNombre",methods={"POST"})
     */
    public function modificarNombre(Request $request, $dni){
        try{
            $data = json_decode($request->getContent(), true);
            $entityManager = $this->getDoctrine()->getManager();
            $usuario = $entityManager->getRepository(Usuarios::class)->find($dni);
            if (!$usuario) {
                throw new \Exception("Usuario con dni ".$dni." no encontrado");
            }
            $nombre_viejo=$usuario->getNyape();
            $usuario->setNyape($data['nyape']);
            $entityManager->flush();
            return $this->json(array('respuesta' => "Modificado nombre de ". $dni ." desde ".$nombre_viejo." a ".$data['nyape']));
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }
    }

    /**
     * @Route("/api/v2/usuario/infraccion/agregar/", name="agregarInfraccion",methods={"PUT"})
     */
    public function agregarInfraccion(Request $request){
        try{
            $data = json_decode($request->getContent(), true);
            $entityManager = $this->getDoctrine()->getManager();
            $usuario = $entityManager->getRepository(Usuarios::class)->find($data['dni']);
            if (!$usuario) {
                throw new \Exception("Usuario con dni ".$data['dni']." no encontrado");
            }
            $infraccion = new Infracciones();
            $infraccion->setMonto($data['monto']);
            $infraccion->setDni($usuario);
            $entityManager->persist($infraccion);
            $entityManager->flush();
            return $this->json(array('respuesta' => "Cargado infraccion a DNI ". $data['dni']));
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }

    }
    /**
     * @Route("/api/v2/soap/{monto<\d+>}/{impuesto<\d+>}", name="soapRequest",methods={"GET"})
     */
    public function soapRequest($monto, $impuesto){
        try{

            $wsdl = "http://www.gnuno.com.ar/soap/server/afip.wsdl";
            $opciones = array('trace' => 1);
            $cliente = new \SoapClient($wsdl, $opciones);
            $importeFinal = json_encode(array("importe" => $cliente->calcularImpuesto($monto, $impuesto)));
           
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($importeFinal);
            return $response;
        }
        //Atrapo la excepcion, ATENTO a la "\" adelante de Exception!!!
        catch(\Exception $e){
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            //Ajusto el codigo de respuesta
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent($this->json(array('error' => $e->getMessage())));
            return $response;
        }

    }
}
