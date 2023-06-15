<?php

namespace Modelos;

trait RestApiSpecifications
{

    public static function testRequestPost(array $attributes = null): string
    {

        if ($attributes != null) {
            return json_encode([
                "data" => [
                    "type" => "test",
                    "id" => shuffle(range(1, 13)),
                    "attributes" => $attributes
                ]
            ]);
        }

        return json_encode([
            "data" => [
                "type" => "test",
                "id" => rand(1, 1000),
                "attributes" => [
                    "content" => "estas realizando una solicitud POST"
                ]
            ]
        ]);
    }

    static public function status_Code_Response_500(
        string $title = "Error Interno",
        string $detail = "se presento un inconveniete al insertar los registros",
        int $code = 500
    ): string {
        http_response_code($code);
        return json_encode([
            "errors" => [
                "status" => http_response_code(),
                "title" => $title,
                "detail" => $detail
            ],
        ]);
    }

    static public function status_Code_Response_400(
        string $title = "Invalid record",
        string $detail = "Registro invalido",
        int $code = 400
    ): string {
        http_response_code($code);
        return json_encode([
            "errors" => [
                "status" => http_response_code(),
                "title" => $title,
                "detail" => $detail
            ],
        ]);
    }

    static public function status_Code_Response_200(
        string $title = null,
        string $content = null,
        int $code = 200,
        array $attributes = null
    ): string {
        http_response_code($code);
        // if ($attributes === null) {
            $attributes["title"] = $title;
            $attributes["content"] = $content;
        // }
        return json_encode([
            "state"=>http_response_code(),
            "data" => [
                "type" => "response",
                "id" => rand(1, 1000) ,
                "attributes" => $attributes
            ]
        ]);
    }
}
