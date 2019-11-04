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
        <div class="coupon">
            <div class="container" style="background-color:white">
                <div align='center'>
                    <img src="./images/logo.png" width="120px" alt="">
                    @if($aporte->tipooperacion == 1)
                        <h4>Boucher de Aporte</h4>
                    @else
                        <h4>Boucher de retiro de interes de Aporte</h4>
                    @endif
                    <hr>
                </div>
                <p>
                    <strong>DATOS DEL SOCIO</strong><br>
                    DNI: {{$aporte->dni}}<br>
                    SOCIO:  {{ $aporte->nombre . ' ' . $aporte->apellidos }}<br>
                    DIRECCIÓN:  {{ $aporte->direccion }}
                </p>
                
                <p>
                    @if($aporte->tipooperacion == 1)
                        <strong>DATOS DEL APORTE</strong>
                    @else
                        <strong>DATOS DEL RETIRO DE INTERÉS DE APORTE</strong>
                    @endif
                    <br>
                    Monto: S/ {{ $aporte->monto }}<br>
                    @if($aporte->tipooperacion == 1) Tasa:  {{ $aporte->tasa}} %<br>
                    @endif
                    Observaciones: {{$aporte->descripcion}}<br>
                    Fecha de registro de aporte: {{$aporte->fecharegistro}}
                </p>
                <p>
                    USUARIO(CAJERO): {{$aporte->usuario}}
                </p>
                <p>
                    DOC.IDE ..........................FIRMA...............................
              </p>
              <div align="center">
                  <p><strong>GRACIAS POR SU PREFERENCIA</strong></p>
              </div>
            </div>
        </div>
    </body>
</html>