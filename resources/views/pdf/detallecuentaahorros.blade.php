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
                    <h4>Boucher de Movimiento</h4>
                </div>
                <p class="bg-light">
                    <strong>N° CUENTA: {{ $cuenta->numerocuenta }}</strong>
                    <hr>
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
                    <br><strong>DATOS DE LA CUENTA:</strong>
                    <br><strong>Tipo cuenta: </strong>
                        @if($cuenta->tipocuenta == 1) Cuenta Ahorros
                        @else Cuenta a Plazo Fijo
                        @endif
                    <br>
                    @if($cuenta->tipocuenta == 1) Saldo efectivo: 
                    @else Capital: 
                    @endif
                    S/. {{ $cuenta->saldoefectivo }}
                    <br>Tasa: {{ $cuenta->tasa }} %
                    <br>Observaciones: {{ $cuenta->descripcion }}
                    <br>Fecha de apertura de la cuenta: {{$cuenta->fechaapertura}}
                </p>
                <p>
                    CREADO POR (USUARIO): {{ $cuenta->usuario }}
                    <br>GRACIAS POR SU PREFERENCIA
                </p>
            </div>
        </div>
    </body>
</html>