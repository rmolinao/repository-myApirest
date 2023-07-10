<?php

namespace Controladores;

use DAO\Interfaces\IServices;
use Modelos\Entity;

use Modelos\Authentication;

class RestController extends Authentication
{


    private $requestMethod,
        $servicio;

    public function __construct(IServices $servicio)
    {
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
        $this->servicio = $servicio;
    }

    public function answerRequestMethod(): void
    {
        header("Content-type: application/json");
        $this->answerRequestMethodGET();
        $this->answerRequestMethodPOST();
        $this->answerRequestMethodPUT();
        $this->answerRequestMethodDELETE();
    }

    public function answerRequestMethodGET(): void
    {
        if ($this->requestMethod === "GET") {

            if (isset($_GET["id"])) {
                $data = $this->servicio->get(intval($_GET["id"]));
                echo self::status_Code_Response_200(null, null, 200, $data);
            } else {
                $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
                $datas = $this->servicio->getAll($page);
                echo self::status_Code_Response_200(null, null, 200, $datas);
            }
            return;
        }
    }

    public function answerRequestMethodPOST(): void
    {
        if ($this->requestMethod === "POST") {
            $bodyRaw = file_get_contents("php://input");
            $atributos = json_decode($bodyRaw, true);
            //aqui se debe colocar el codigo de la autenticacion
            $validacion = new Authentication();
            if ($validacion->validarTokent($atributos)) {
                //aqui trato la Imagen
                $atributos = $this->validarImagen($atributos);
                $entidad = new Entity($this->servicio->getEntityServiceName(), $atributos);
                $entity = $this->servicio->register($entidad);
                if (!empty($entity)) {
                    echo self::status_Code_Response_200(
                        "register Ok",
                        "se guardaron el elemento  correctamente",
                        201,
                        ["element" => $entity->attributelist]
                    );
                }
            }

            return;
        }
    }
    public function answerRequestMethodPUT(): void
    {
        if ($this->requestMethod === "PUT") {
            if (!isset($_GET["id"])) {
                echo self::status_Code_Response_400('error parametro', 'se requiere el parametro id en la direccion URL');
                return;
            }
            $bodyRaw = file_get_contents("php://input");
            $atributos = json_decode($bodyRaw, true);
            $validacion = new Authentication();
            if ($validacion->validarTokent($atributos)) {

                $entidad = new Entity($this->servicio->getEntityServiceName(), $atributos);
                $entity = $this->servicio->update($entidad, intval($_GET["id"]));
                if (!$entity) {
                    echo self::status_Code_Response_200(
                        "notificacion",
                        "no se encontraron nuevos dados, no se realizaron cambios",
                        200
                    );
                    return;
                }
                echo self::status_Code_Response_200(
                    "update Ok",
                    "se actualizo el elemento  correctamente",
                    200,
                    ["element" => $entity->attributelist]
                );
            }
            return;
        }
    }

    private function validarImagen(array $atributos)
    {
        if (!isset($atributos['Imagen'])) {
            $atributos['Imagen'] = null;
            return $atributos;
        }
        $atributos['Imagen'] = $this->procesarImagen($atributos['Imagen']);
        return $atributos;
    }

    private function procesarImagen($imagen)
    {
        $direccion = dirname(__DIR__)."\public\image\\";
        $partes = explode(';base64,',$imagen);
        $extension = explode('/',mime_content_type($imagen))[1];
        $imagen_base64 = base64_decode($partes[1]);
        $file = $direccion.uniqid().".".$extension;
        file_put_contents($file,$imagen_base64);
        return $file;

    }

    public function answerRequestMethodDELETE(): void
    {
        if ($this->requestMethod === "DELETE") {
            if (!isset($_GET["id"])) {
                if(isset(getallheaders()['id'])){
                    $_GET["id"]= getallheaders()['id'];
                }
                else {
                    echo self::status_Code_Response_400('no existe el parametro id', 'no hadeclarado el parametro id en la ruta de la petiicon');
                    return;
                }
            }

            $bodyRaw = file_get_contents("php://input");
            $token = json_decode($bodyRaw, true);

            if (!isset($token['token'])) {
                if(isset(getallheaders()['token']))
                    $token = getallheaders();
            }

            $validacion = new Authentication();

            if ($validacion->validarTokent($token)) {

                $atributos = $this->servicio->get(intval($_GET["id"]));
                $entity = new Entity($this->servicio->getEntityServiceName(),$atributos);

                $action = $this->servicio->delete(intval($_GET["id"]));

                if ($action == false) {
                    echo self::status_Code_Response_200(
                        "no existe el elemento",
                        "el elemento que desea eliminar no existe",
                        201
                    );
                    return;
                }
                echo self::status_Code_Response_200(
                    "delete Ok",
                    "se elimino el elemento correctamente",
                    200,
                    ["element" => $entity->attributelist]

                );
                return;
            }

        }

    }
}