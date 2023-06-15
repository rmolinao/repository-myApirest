<?php

namespace Controladores;

use DAO\Interfaces\IServices;
use Modelos\Entity;
use Modelos\RestApiSpecifications;

class RestController
{

    use RestApiSpecifications;

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
            return;
        }
    }
    public function answerRequestMethodPUT(): void
    {
        if ($this->requestMethod === "PUT") {
            if (isset($_GET["id"])) {
                $bodyRaw = file_get_contents("php://input");
                $atributos = json_decode($bodyRaw, true);
                $entidad = new Entity($this->servicio->getEntityServiceName(), $atributos);
                $entity = $this->servicio->update($entidad,intval($_GET["id"]));
                if (!empty($entity)) {
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
    }

    public function answerRequestMethodDELETE(): void
    {
        if ($this->requestMethod === "DELETE") {
            if (isset($_GET["id"])) {
                $atributos = $this->servicio->get(intval($_GET["id"]));
                $entity = new Entity($this->servicio->getEntityServiceName(),$atributos);

                $action = $this->servicio->delete(intval($_GET["id"]));
                if ($action) {
                    echo self::status_Code_Response_200(
                        "delete Ok",
                        "se elimino el elemento correctamente",
                        201,
                        ["element" => $entity->attributelist]

                    ); 
                }
                return;  
            }
        }
        
    }
}