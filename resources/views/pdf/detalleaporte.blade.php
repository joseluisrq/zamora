<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boucher de Aporte</title>
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
        @foreach ($aporte as $apte)
            <div class="coupon">
                <div class="container" style="background-color:white">
                    <div align='center'>
                        <img src="./images/logo.png" width="120px" alt="">
                        <h4>Boucher de Aporte</h4>
                    </div>
                    <p>
                        SOCIO :  {{ $apte->nombre . ' ' . $apte->apellidos }}<br><br>
                        DIRECCIÓN SOCIO:  {{ $apte->direccion }}
                    </p>
                  
                    <p>NRO OPERACIÓN: {{$apte->id}}
                        <br>DNI SOCIO  : {{$apte->dni}}
                        <br>MONTO DE APORTE N: S/. {{ $apte->monto }}
                        <br>TASA:  {{ $apte->tasa}} %
                        <br>Observaciones: {{$apte->descripcion}}
                        <br>Fecha de registro de aporte: {{$apte->fecharegistro}}
                    </p>
                    <p>
                        USUARIO(CAJERO): {{$apte->usuario}}
                    </p>
                    <p>
                        DOC.IDE ..........................FIRMA...............................
                  </p>
                  <div align="center">
                      <p><strong>GRACIAS POR SU PREFERENCIA</strong></p>
                  </div>
                </div>
            </div>
        @endforeach
    </body>
</html>