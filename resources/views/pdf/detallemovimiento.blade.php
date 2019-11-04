<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boucher de Movimiento</title>
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
                        <div align='center'>
                            <strong>
                                @if($tipocuenta == 1)
                                    CUENTA DE AHORROS
                                @else
                                    CUENTA A PLAZO FIJO
                                @endif
                            </strong>
                            <hr>
                        </div>
                        <br>
                        <strong>N° CUENTA:</strong> {{ $mov->numerocuenta }}<br><br>
                        DNI SOCIO  : {{$mov->dni}}<br>
                        SOCIO :  {{ $mov->nombre . ' ' . $mov->apellidos }}<br>
                        OPERACIÓN:  @if ($mov->tipomovimiento == 0) RETIRO
                                    @else APORTE
                                    @endif
                    </p>
                  
                    <p>
                        MONTO DE OPERACIÓN N: S/. {{ $mov->monto }}
                        @if($tipocuenta == 2){{-- Si se trata de cuenta a plazo fijo --}}
                            <br><strong>DEPÓSITO ACTUAL</strong>
                            <br>Plazo fijo desde {{ $min_dias }} 
                            @if($min_dias == 361)
                                días a más de un año.
                            @else
                                hasta {{ $max_dias }} días.
                            @endif
                            <br>Fecha inicio: ......................... {{ $fecha_inicio }}
                            <br>Fecha fin del plazo: .............. {{ $fecha_fin }}
                        @endif
                        <br>
                        <br>Observaciones: {{ $mov->descripcion }}
                        <br>Fecha de registro de la operación: {{ $mov->fecharegistro }}
                    </p>
                    <p>
                        USUARIO(CAJERO): {{ $mov->usuario }}
                    </p>
                    <p>
                        DOC.IDE ..........................      FIRMA...............................
                  </p>
                  <div align="center">
                      <p><strong>GRACIAS POR SU PREFERENCIA</strong></p>
                  </div>
                </div>
            </div>
    </body>
</html>