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
       
       
        <div class="book">
         <div class="page">
            <div align='center'>
                <img src="./images/logo.png" width="120px" alt="">
                <h4>Reporte de Cajas</h4>
            </div>
            <p>
             @foreach ($sumamonto as $sm)
            MONTO TOTAL RECAUDADO: {{$sm->MontoRecaudado}}<br>
            <?php
                $MontoRecaudado=$sm->MontoRecaudado;              
            ?>
            @endforeach

            @foreach ($inicial as $si)
            MONTO INCIAL DE CAJA: {{$si->MontoInicial}}
            <?php
                $MontoInicial=$si->MontoInicial;               
            ?>
            @endforeach
        <br>
           <?php
                $totalCajas=$MontoRecaudado+$MontoInicial;
                echo "Total ".$totalCajas;
            ?>
                 <br><br>
               
                 <br>  

            </p>       
         


            <h4>Detalle de Cajas</h4>
                <table style="width:100%">
                    <tr>
                        <td style="width:5%">Id Caja</th>
                       <td style="width:17%">Fecha de Apertura</th>
                       <td style="width:17%">Fecha de Cierre</th>                       
                       <td style="width:17%">Monto Inicial</th>
                       <td style="width:17%">Monto Recaudado</th>
                       <td style="width:17%">Total</th>
                       <td style="width:17%">Cajero</th>
                                             
                       
                    </tr>
                                    
                
                    @foreach ($caja as $c)
                    <tr>
                        <td style="width:5%">{{$c->id}}</td>
                        <td style="width:5%">{{$c->fechaapertura}}</td>
                        <td style="width:5%">{{$c->fechacierre}}</td>
                        <td style="width:5%">{{$c->montoinicial}}</td>
                        <td style="width:5%">{{$c->montorecaudado}}</td>
                        <td style="width:5%">
                        <?php
                        $total=$c->montoinicial+$c->montorecaudado;
                        echo $total
                        ?>
                        </td>
                        <td style="width:5%">{{$c->nombre}} {{$c->apellidos}}</td>

                        
                    </tr>
                    @endforeach
                  
                  

                </table>
        
        </div>
        
    </div>
   
</html>