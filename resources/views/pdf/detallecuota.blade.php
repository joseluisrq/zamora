<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boucher - Cooperativa Zamora</title>
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
                      <p>Cooperativa ZAMORA</p>
                
              <p>NRO OPERACIÓN: {{$c->id}} -  {{$c->numerodecuota}}
              <br> {{$c->fechacancelo}}
               <br>DNI SOCIO  : {{$c->sociodni}}
              <br>{{$c->socionombre}} {{$c->socioapellidos}} 
              <br>Obs: {{$c->descripcion}}
              <br>N° CRED: {{$c->numeroprestamo}}
                <br>
              <br>MONTO A PAGAR N: S/ {{$c->monto}}
              <br>INTERES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
               S/ {{ $c->interes }}
               <?php
               if($c->estado_mora=="1"){ ;?>
              <br>MORA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/ {{$c->mora}}
              <?php 
                 }
              ;?>
              <br>TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
              {{
                $c->monto+$c->mora
           
              }} 

                </p>
                <p>SALDO PENDIENTE N: S/  {{$c->saldopendiente}} 
           
                <p>
                   GRACIAS POR SU PREFERENCIA <br>
                   CAJERO: {{$c->cajeronombre}}  {{$c->cajeroapellidos}} &nbsp;&nbsp;

                    
                </p>
                <p>
                  DOC.IDE ..........................FIRMA...............................
                                       
                </p>
              
              
              </div>
            
            </div>
                  
                  <br>
                  <div class="coupon">
                   
                   
                    <div class="container" style="background-color:white">
                            <p>Cooperativa ZAMORA</p>
                      
                    <p>NRO OPERACIÓN: {{$c->id}} -  {{$c->numerodecuota}}
                    <br> {{$c->fechacancelo}}
                     <br>DNI SOCIO  : {{$c->sociodni}}
                    <br>{{$c->socionombre}} {{$c->socioapellidos}} 
                    <br>Obs: {{$c->descripcion}}
                    <br>N° CRED: {{$c->numeroprestamo}}
                 <br>
                     <br>MONTO A PAGAR N: S/ {{$c->monto}}
                    <br>INTERES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     S/ {{ $c->interes }}
                     <?php
                     if($c->estado_mora=="1"){ ;?>
                    <br>MORA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/ {{$c->mora}}
                    <?php 
                       }
                    ;?>
                    <br>TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: S/
                    {{
                      $c->monto+$c->mora
                 
                    }} 
      
                      </p>
                      <p>SALDO PENDIENTE N: S/  {{$c->saldopendiente}} 
                 
                      <p>
                         GRACIAS POR SU PREFERENCIA <br>
                         CAJERO: {{$c->cajeronombre}}  {{$c->cajeroapellidos}} &nbsp;&nbsp;
      
                          
                      </p>
                      <p>
                        DOC.IDE ..........................FIRMA...............................
                                             
                      </p>
                    
                    
                    </div>
                  
                  </div>
            @endforeach
    </body>
</html>