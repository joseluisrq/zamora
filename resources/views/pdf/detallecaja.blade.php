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
        @foreach ($caja as $c)
       
        <div class="book">
         <div class="page">
            <div align='center'>
                <img src="./images/logo.png" width="120px" alt="">
                <h4> Detalle de Caja</h4>
            </div>
            <p>
                ID CAJA :  {{$c->id}}<br><br>
                CAJERO:  {{$c->nombre}} {{$c->apellidos}}<br> 
                FECHA APERTURA:  {{$c->fechaapertura}} <br> 
                FECHA CIERRE :  {{$c->fechacierre}} <br><br> 

                MONTO INICIAL: S/  {{$c->montoinicial}} <br> 
                MONTO RECAUDADO: S/  {{$c->montorecaudado}} <br><br>
                <?php
                    $total=round($c->montorecaudado+$c->montoinicial,2);
                    echo  " TOTAL CAJA : S/ .$total."
                ?>
                 <br>  

            </p>
          
         


            <h4>Detalle de Movimientos - CANTIDAD DE MOVIMIENTOS {{$cantidaddemovimmientos}}</h4>
                <table style="width:100%">
                    <tr>
                        <td style="width:5%">Id Movimiento</th>
                       <td style="width:17%">Tipo de Movimiento</th>
                       <td style="width:17%">Movimiento</th>                       
                       <td style="width:17%">Monto</th>
                       <td style="width:17%">Fecha</th>
                                             
                       
                    </tr>
                                    
                    @foreach ($detallecaja as $detalle)
                   
                    <tr>
                        <td style="width:5%">{{$detalle->idmovimiento}}</td>

                        @if($detalle->tipo == 1) 
                        <td style="width:17%">Aportes de Socios</td>
                        @endif
                        @if($detalle->tipo == 2) 
                        <td style="width:17%">Cuentas de Ahorro</td>
                        @endif
                        @if($detalle->tipo == 3) 
                        <td style="width:17%">Pago de Cuotas</td>
                        @endif
                        @if($detalle->tipo == 4) 
                        <td style="width:17%">Desembolso de Créditos</td>
                        @endif


                        @if($detalle->estado == 1) 
                        <td style="width:17%">Abono</td>
                        @endif
                        @if($detalle->estado == 0) 
                        <td style="width:17%;color:red">Retiro</td>
                        @endif
                    

                        <td style="width:17%">S/ {{$detalle->monto}}</td>
                        <td style="width:17%">{{$detalle->fecha}}</td>
                       
                        
                    </tr>
                    @endforeach
                  

                </table>
        
        </div>
        
    </div>
    @endforeach
</html>