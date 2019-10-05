<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Parte </title>
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
                      
                    <p>NRO OPERACIÓN: {{$c->id}} -  {{$c->numerocuota}} -{{$c->idporcion}}
                    <br> {{$c->pfechacancelacion}}
                     <br>DNI SOCIO  : {{$c->dni}}
                    <br>{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}}
                    <br>Obs: {{$c->pdescripcion}}
                    <br>N° CRED: {{$c->numeroprestamo}}
                    <br>PROD.CRED:CREDITO CONGARANTIA LIQUIDA/PLAZO</p>
                    <p>SALDO ANTERIOR N: $  {{$c->saldopendiente + $c->monto+$c->pmonto}} 
                    <br>MONTO A PAGAR N: S/ {{round((($c->pmonto))*($c->tipocambio),2)}}
                   
                    <br>INTERES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                    <?php
                      $int=round((($c->pmonto*$c->tasa)/(100-$c->tasa)*$c->tipocambio),2);
                      echo $int
                    ?>
                    <br>OTROS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     S/ {{$c->potroscostos}}
                     
                    <br>TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                    {{round(
                     ($c->pmonto*$c->tipocambio)+($int)+$c->potroscostos
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
                     
                   <p>NRO OPERACIÓN: {{$c->id}} -  {{$c->numerocuota}} -{{$c->idporcion}}
                   <br> {{$c->pfechacancelacion}}
                    <br>DNI SOCIO  : {{$c->dni}}
                   <br>{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}}
                   <br>Obs: {{$c->pdescripcion}}
                   <br>N° CRED: {{$c->numeroprestamo}}
                   <br>PROD.CRED:CREDITO CONGARANTIA LIQUIDA/PLAZO</p>
                   <p>SALDO ANTERIOR N: $  {{$c->saldopendiente + $c->monto+$c->pmonto}} 
                   <br>MONTO A PAGAR N: S/ {{round((($c->pmonto))*($c->tipocambio),2)}}
                  
                   <br>INTERES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                   <?php
                     $int=round((($c->pmonto*$c->tasa)/(100-$c->tasa)*$c->tipocambio),2);
                     echo $int
                   ?>
                   <br>OTROS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    S/ {{$c->potroscostos}}
                    
                   <br>TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                   {{round(
                    ($c->pmonto*$c->tipocambio)+($int)+$c->potroscostos
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