<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Cronograma de Pagos</title>
    <style>
     body {
            margin: 20px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
    }
    </style>
    <body>
        @foreach ($credito as $c)
       
        <div class="book">
         <div class="page">
            <div align='center'>
                <img src="./images/logo.png" width="120px" alt="">
                <h4> Contrato de Crédito/Pagaré</h4>
            </div>
            <p>
                ID CRÉDITO :  {{$c->numeroprestamo}}<br><br>
                ID SOCIO:  {{$c->dni}}<br><br>
               
            </p>
             <p>
                  Yo,  {{$c->nombre}}  {{$c->apellidos}} con DNI  N° 
                   {{$c->dni}}; entiendo y estoy de acuerdo realizar los pagos en acuerdo con los
                    términos y condiciones 
            </p>
            <p> Firma de Acreditado ______________________________  &nbsp;&nbsp;&nbsp; Fecha {{date('d/m/Y')}}</p>
            <p> [Representante de Cooperativa Zamora] </p>
            <p>Firma ______________________________  &nbsp;&nbsp;&nbsp; Fecha {{date('d/m/Y')}} </p>
            

            <h4> I.Términos de Préstamo</h4>
            <table  style="width:100%">
                <tr>
                    <td style="width:35%">Monto de Prestamo y moneda</td>
                    <td style="width:15%">S/ {{$c->montodesembolsado}}</td>
                    <td style="width:35%">Fecha de desembolso</td>
                    <td style="width:15%">{{$c->fechadesembolso}}</td>
                </tr>
                <tr>
                    <td style="width:35%">Tasa de Interes (Especificar si es Fija/Sobre Saldo/No aplicable)</td>
                    <td style="width:15%">Fija {{$c->tasa}} % mensual</td>
                    <td style="width:35%">Fecha de vencimiento</td>
                    <td style="width:15%"> 
                    <?php $fecha='';?>
                    @foreach ($cuotas as $cuot)
                     <?php if($cuot->numerodecuota==$c->numerocuotas) $fecha=$cuot->fechapago;?>
                     @endforeach
                     <?php echo $fecha;?>
                </td>
                </tr>

                <tr>  
                    <td style="width:35%">Frecuencia de Pagos (Semana, Mensual,etc)</td>
                    <td style="width:15%">
                    <?php
                    if($c->periodo==12)echo "Mensual";
                 
                    elseif($c->periodo==4)echo "Trimestral";
                    elseif($c->periodo==6)echo "Semestral";
                    elseif($c->periodo==1)echo "Anual";
                    ?>
                   
                
                </td>
                    <td style="width:35%">Cargos y otroscostos</td>
                    <td style="width:15%">
                  
                    </td>                         
                    
                </tr>
            </table>


            <h4>II.Plan de Pagos </h4>
                <table style="width:100%">
                    <tr>
                        <td style="width:5%">#</th>
                       <td style="width:17%">Fecha de Pago</th>                      
                       <td style="width:17%">Cuota</th>
                       <td style="width:17%">Interes</th>
                        <td style="width:17%">Amortización</th>
                        <td style="width:17%">Capital Pendiente</th>                        
                       
                    </tr>
                    <tr>
                         <td style="width:5%"></td>
                        <td style="width:17%">{{$c->fechadesembolso}}</td>
                        <td style="width:17%">0.00</td>                       
                        <td style="width:17%">0.00</td>
                        <td style="width:17%">0.00</td>  
                        <td style="width:17%">{{$c->montodesembolsado}}</td>                  
                       
                        
                    </tr>
                   
                    @foreach ($cuotas as $cuot)
                   
                    <tr>
                        <td style="width:5%">{{$cuot->numerodecuota}}</td>
                        <td style="width:17%">{{$cuot->fechapago}}</td>
                        <td style="width:17%">{{$cuot->monto}}</td>
                        <td style="width:17%">{{$cuot->interes}}</td>
                        <td style="width:17%">{{$cuot->amortizacion}}</td>
                        <td style="width:17%">{{$cuot->saldopendiente}}</td>
                        
                    </tr>
                    @endforeach
                    <tr>
                         <td style="width:5%"><strong></strong></td>
                        <td style="width:17%"><strong>TOTAL</strong> </td>
                       
                        <td style="width:17%"><strong>{{$c->montodesembolsado+$c->credinteres}}</strong></td>
                        <td style="width:17%"><strong>{{$c->credinteres }}</strong></td>
                        <td style="width:17%"><strong>{{$c->montodesembolsado }}<</strong></td>
                        <td style="width:15%"><strong>0</strong></td>
                    </tr>

                </table>
           
            <p>
                Si tiene cualquier pregunta o queja acerca de un producto , nuestro servicio, o un empleado por 
                favor llame [ Cooperatvia Zamora : correo electrónico zamora@gmail.com o teléfono fijo 076-558336]
            </p><br>
            <p>
                Teléfono del Cliente : .... {{ $c->telefono}}
            </p>
        </div>
        
    </div>
    @endforeach
</html>