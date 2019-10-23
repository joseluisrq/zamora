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
                        N° CUENTA: {{ $mov->numerocuenta }}<br><br>
                        SOCIO :  {{ $mov->nombre . ' ' . $mov->apellidos }}<br><br>
                        OPERACIÓN:  @if ($mov->tipomovimiento == 0) RETIRO
                                    @else APORTE
                                    @endif
                                    <br><br>
                    </p>
                  
                    <p>
                        DNI SOCIO  : {{$mov->dni}}
                        <br>MONTO DE OPERACIÓN N: S/. {{ $mov->monto }}
                        <br>Observaciones: {{$mov->descripcion}}
                        <br>Fecha de registro de la operación: {{$mov->fecharegistro}}
                    </p>
                    <p>
                        GRACIAS POR SU PREFERENCIA <br>
                        USUARIO(CAJERO): {{$mov->usuario}}
                    </p>
                    <p>
                        DOC.IDE ..........................FIRMA...............................
                  </p>
                </div>
            </div>
    </body>
</html>