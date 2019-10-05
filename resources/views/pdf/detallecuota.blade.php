<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Credito</title>
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
            @foreach ($cuotas as $c)
                    <div class="coupon">
                   
                   
                    <div class="container" style="background-color:white">
                            <p>APT SAN MARCOS RUC: 20495964214</p>
                      
                    <p>NRO OPERACIÓN: {{$c->id}} -  {{$c->numerocuota}}
                    <br> {{$c->fechacancelacion}}
                     <br>DNI SOCIO  : {{$c->dni}}
                    <br>{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}}
                    <br>Obs: {{$c->descripcion}}
                    <br>N° CRED: {{$c->numeroprestamo}}
                    <br>PROD.CRED:CREDITO CONGARANTIA LIQUIDA/PLAZO</p>
                    <p>SALDO ANTERIOR N: $  {{$c->saldopendiente + $c->monto}} 
                    <br>MONTO A PAGAR N: S/ {{round(($c->monto)*($c->tipocambio),2)}}
                    <br>INTERES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     S/ {{ round(
                       (($c->montodesembolsado*($c->tasa/100))/$c->numerocuotas)*($c->tipocambio)
                       ,2)
                      }}
                    <br>OTROS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/ {{$c->otroscostos}}
                     
                    <br>TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                    {{round(
                      (($c->monto+(($c->montodesembolsado*($c->tasa/100))/$c->numerocuotas))*$c->tipocambio)+$c->otroscostos
                      ,2)
                    }} 
  
                      </p>
                      <p>
                         GRACIAS POR SU PREFERENCIA <br>
                         USUARIO: {{$c->usuario}} &nbsp;&nbsp;PASN

                          
                      </p>
                      <p>
                        DOC.IDE ..........................FIRMA...............................
                                             
                      </p>
                    
                    
                    </div>
                  
                  </div>
                  
                  <br><br>
                  <div class="coupon">
                   
                   
                   <div class="container" style="background-color:white">
                           <p>APT SAN MARCOS RUC: 20495964214</p>
                     
                   <p>NRO OPERACIÓN: {{$c->id}}
                   <br> {{$c->fechacancelacion}}
                    <br>DNI SOCIO  : {{$c->dni}}
                   <br>{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}}
                   <br>Obs: {{$c->descripcion}}
                   <br>N° CRED: {{$c->numeroprestamo}}
                   <br>PROD.CRED:CREDITO CONGARANTIA LIQUIDA/PLAZO</p>
                   <p>SALDO ANTERIOR N: $  {{$c->saldopendiente + $c->monto}} 
                   <br>MONTO A PAGAR N: S/ {{round(($c->monto)*($c->tipocambio),2)}}
                   <br>INTERES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    S/ {{ round(
                      (($c->montodesembolsado*($c->tasa/100))/$c->numerocuotas)*($c->tipocambio)
                      ,2)
                     }}
                   <br>OTROS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/ {{$c->otroscostos}}
                    
                   <br>TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                   {{round(
                     (($c->monto+(($c->montodesembolsado*($c->tasa/100))/$c->numerocuotas))*$c->tipocambio)+$c->otroscostos
                     ,2)
                   }} 
 
                     </p>
                     <p>
                        GRACIAS POR SU PREFERENCIA <br>
                        USUARIO: {{$c->usuario}} &nbsp;&nbsp;PASN

                         
                     </p>
                     <p>
                       DOC.IDE ..........................FIRMA...............................
                                            
                     </p>
                   
                   
                   </div>
                 
                 </div>
            @endforeach
    </body>
</html>