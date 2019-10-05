<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
    <head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
    
    @foreach ($credito as $c)
	<div class="row">
        <div class="col md-8">
            <p class="font-weight-bold"> <font size="2">COOPERATIVA AGRARIA PRODUCTORES DE TARA DEL NORTE </font>  
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font size="3">RUC 20495964214</font >  <br>
            <font size="1">REFORESTACIÓN MANEJO, APROVECHAMIENTO  <br>Y COMERCIALIZACION DE TARA &nbsp; <br> 
            <font size="1">Jr. Amorin Bueno s/n - Pedro Gálvez - San Marcos - Cajamarca  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font size="3">N° </font ><br>
          Tef. : 076558336  </font></p>
          <hr>
          <p><pre><strong> RECIBO DE EGRESOS             |        POR :S/ {{round($c->montodesembolsado*$c->tipocambio,2)}}</strong></pre></p>
          <hr>
          <p><font size="2">Recibí de la Cooperativa Agraria Productos de Tara del Norte la cantidad de : <br>
            ___________________________________________________ y 00/100 Soles <br>
            <strong>Por Concepto de : </strong>
            <br>
            [ ] Adeltanto de Compra de tara <br>
            [ ] Pago por Compra <br>
            [ ] Pago de Saldo <br>
            [X] otros : Prestamo Kiva {{$c->idkiva}} al {{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} <br>
            </font>
        </p>
        <hr>
        <p><pre>San Marcos, {{$c->fechadesembolso}}                 Recibi Comborme 
                                        Firma
V°B° .............................      Nombre: {{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}}
APT DEL NORTE                           D.N.I: {{$c->dni}}
        </pre> 
         </p>
        </div>

        
  </div>
  @endforeach

  
    </body>

</html>