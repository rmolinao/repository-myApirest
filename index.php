<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my Api</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container ">
        <div class="card mt-3 mb-3 rounded-0 shadow ">
            <div class="card-header ">
                Api de Pruebas
            </div>
            <div class="card-body ms-2 me-2 ">
                <h6 class="card-title ">Auth-login</h6>
                <div class="row bg-body-tertiary p-3 rounded-0 mt-3 mb-3 border">
                    <div class="col-10 text-primary">
                        <span class="d-block mb-1">POST /auth</span>
                        <div>
                            {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"usuario" : "", -> Requerido<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"password" : "" -> Requerido<br>
                            }<br>
                        </div>
                    </div>
                </div>
                <h6 class="card-title ">Pacientes</h6>

                <div class="row bg-body-tertiary p-3 rounded-0 mt-3 mb-3 border">
                    <div class="col-10 text-primary">
                        <span class="d-block mb-1">GET /paciente?page=$numeroPagina</span>
                        <span class="d-block mb-1">GET /paciente?id=$idPaciente</span>
                    </div>
                </div>

                <div class="row bg-body-tertiary p-3 rounded-0 mt-3 mb-3 border">
                    <div class="col-10 text-primary">
                        <span class="d-block mb-1">POST /paciente</span>
                        <div>
                            {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"DNI" : "" -> Requerido,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Nombre" : "" -> Requerido,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Correo" : "" -> Requerido,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Direccion" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"CodigoPostal" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Telefono" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Genero" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Imagen" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"FechaNacimiento" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"token" : "" -> Requerido<br>
                            }<br>
                        </div>
                    </div>
                </div>

                <div class="row bg-body-tertiary p-3 rounded-0 mt-3 mb-3 border">
                    <div class="col-10 text-primary">
                        <span class="d-block mb-1">PUT /paciente?id=$idPaciente</span>
                        <div>
                            {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"DNI" : "" -> Requerido,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Nombre" : "" -> Requerido,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Correo" : "" -> Requerido,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Direccion" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"CodigoPostal" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Telefono" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Genero" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"FechaNacimiento" : "",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"token" : "" -> Requerido<br>
                            }<br>
                        </div>
                    </div>
                </div>

                <div class="row bg-body-tertiary p-3 rounded-0 mt-3 mb-2 border">
                    <div class="col-10 text-primary">
                        <span class="d-block mb-1">DELETE /paciente?id=$idPaciente</span>
                        <div>
                            {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"token" : "" -> Requerido<br>
                            }<br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>