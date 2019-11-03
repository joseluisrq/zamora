<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información de la Cuenta</title>
    <style>
      body {
            font-family: Arial;
            }

            .coupon {
            border: 1px dotted #bbb;
            width: 65%;
            border-radius: 1px;
            margin: 0 auto;
            max-width: 600px;
            }

            .container {
            padding: 2px 16px;
            background-color: #f1f1f1;
            }

            .promo {
            background: #ccc;
            padding: 3px;
            }

            .expire {
            color: red;
            }
            p{
                line-height: 150%  ;
            }
    </style>
    <body>
        <div class="coupon">
            <div class="container" style="background-color:white">
                <div align='center'>
                    <img src="./images/logo.png" width="120px" alt="">
                    <h4>Información de la cuenta</h4>
                </div>
                <p class="bg-light">
                    <strong>N° CUENTA: {{ $cuenta->numerocuenta }}</strong>
                    <hr>
                </p>

                <p>
                    <br><strong>DATOS DE LA CUENTA:</strong>
                    <br><strong>Tipo cuenta: </strong>
                        @if($cuenta->tipocuenta == 1) Cuenta Ahorros
                        @else Cuenta a Plazo Fijo
                        @endif
                    <br>
                    @if($cuenta->tipocuenta == 1) 
                        Saldo efectivo: S/. {{ $cuenta->saldoefectivo }}
                        <br>Tasa: {{ $cuenta->tasa }} %
                        <br>Observaciones: {{ $cuenta->descripcion }}
                        <br>Fecha de apertura de la cuenta: {{$cuenta->fechaapertura}}
                    @else 
                        Capital: S/. {{ $cuenta->saldoefectivo }}
                        <br>Observaciones: {{ $cuenta->descripcion }}
                        <br>Fecha de apertura de la cuenta: {{$cuenta->fechaapertura}}
                        <br><br><strong>DEPÓSITO ACTUAL</strong>
                        <br>Plazo fijo desde {{ $min_dias }} 
                        @if($min_dias == 361)
                            días a más de un año.
                        @else
                            hasta {{ $max_dias }} días.
                        @endif
                        <br>Tasa: {{ $datos_plazo_fijo->tasa }} %
                        <br>Monto: S/. {{ $datos_plazo_fijo->monto }}
                        <br>Fecha inicio: {{ $datos_plazo_fijo->fecha_inicio }}
                        <br>Fecha fin: {{ $datos_plazo_fijo->fecha_fin }}
                    @endif
                </p>

                <p>
                    <strong>DATOS DEL SOCIO:</strong>
                    <br>DNI: {{ $cuenta->dni }}
                    <br>Nombre:  {{ $cuenta->nombre . ' ' . $cuenta->apellidos }}
                    <br>Fecha nacimiento: {{ $cuenta->fechanacimiento }}
                    <br>Departamento: {{ $cuenta->departamento }}
                    <br>Ciudad: {{ $cuenta->ciudad }}
                    <br>Direccion: {{ $cuenta->direccion }}
                    <br>Teléfono: {{ $cuenta->telefono }}
                    <br>
                    @if($cuenta->email) Email: {{ $cuenta->email }}
                    @endif
                    <br>
                </p>

                <p>
                    CREADO POR (USUARIO): <strong>{{ $cuenta->usuario }}</strong>
                </p>

                <div align="center">
                    <p><strong>GRACIAS POR SU PREFERENCIA</strong></p>
                </div>

            </div>
        </div>
    </body>
</html>