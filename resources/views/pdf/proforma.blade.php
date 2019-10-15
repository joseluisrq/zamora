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
                <h4> Proforma para prestamo Personal</h4>
            </div>
            <p>
                ID CRÉDITO (Simulación) :  {{$c->id}}<br><br>
               DNI SOLICITANTE:  {{$c->dni}}<br><br>
               NOMBRES SOLICITANTE:  {{$c->nombresapellidos}}<br><br>
               
            </p>
     

            <h4> I.Términos de Préstamo</h4>
            <table  style="width:100%">
                <tr>
                    <td style="width:35%">Monto de Prestamo y moneda</td>
                    <td style="width:15%">S/ {{$c->montodesembolsado}}</td>
                  
                </tr>
                <tr>
                   
                    <td style="width:35%">Fecha de desembolso</td>
                    <td style="width:15%">{{$c->fechadesembolso}}</td>
                </tr>
                <tr>
                    <td style="width:35%">Tasa de Interes (Especificar si es Fija/Sobre Saldo/No aplicable)</td>
                    <td style="width:15%">Fija {{$c->tasa}} % anual</td>
                   
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
                                  
                    
                </tr>
           


             
                        <?php
                                $TIN = 0;
                                $TA = 0;
                                $TAN = 0;
                                $AA = 0;
                                $CUOTA = "";
                                $I = 0;
                                $AN = 0;
                                $IN = 0;
                                $A1 = 0;
                                $CP2 = 0;
                                $POT = 0;
                                $CP1 = 0;
                                $C =  $c->montodesembolsado;
                                $J =  $c->tasa/ 100;
                                $N = $c->numerocuotas;
                                $D = 0;


                                
                                $N =round($N,2);
                                $M = $c->periodo;
                            
                            

                            
                                $DD = 2;
                                if ($M == 1) {
                                    $CUOTA = "ANUALES";
                                }
                                if ($M == 2) {
                                    $CUOTA = "SEMESTRALES"
                                    ;
                                }
                                if ($M == 4) {
                                    $CUOTA = "TRIMESTRALES";
                                }
                                if ($M == 12) {
                                    $CUOTA = "MENSUALES";
                                }

                                

                                    $I = (pow((1 + $J), 1 / $M)) - 1;
                                    $AN = 0;
                                    $IN = 0;
                                    $A1 = 0;
                                    $CP2 = $C;
                                    $POT = $D-$N;
                                    $TIN = 0;
                                    $TA = 0;
                                    $TAN = 0;
                                
                                    for ($K = 0; $K<=$N; $K++) {

                                        $TIN = $TIN + $IN;
                                        $TA = $TA + $A1;
                                        $TAN = $TAN + $AN;
                                        if ($K < $D) {
                                        
                                                $AN = $C * $I;
                                                $IN = $C * $I;
                                                $A1 = 0;
                                                $CP2 = $C;
                                            
                                        }
                                        if ($K == $D) {
                                        
                                                $AN = ($C * $I) / (1 - pow((1 + $I), $POT));
                                                $IN = $C * $I;
                                                $A1 = $N - $IN;
                                                $CP2 = $C - $A1;
                                                $CP1 = $CP2;
                                        

                                        if ($K > $D) {
                                            $IN = $CP1 * $I;
                                            $A1 = $AN - $IN;
                                            $CP2 = $CP1 - $A1;
                                            $CP1 = $CP2;
                                        }

                                    } 
                                    
                                    }


                        
                        ?>  

                          
                 <tr>
                    <td style="width:35%">{{ $c->numerocuotas}} Cuotas de </td>
                    <td style="width:15%">S/ <?php echo  round($AN,2)?></td>
                 </tr>
                 <tr>
                    <td style="width:35%">Interes Total</td>
                    <td style="width:15%">S/ <?php echo round($TIN,2) ?></td>
                 </tr>
                 <tr>
                    <td style="width:35%">Total a Pagar</td>
                    <td style="width:15%">S/ <?php echo round($TIN+$c->montodesembolsado,2) ?></td>
                 </tr>
            </table>
        </div>
        
    </div>



    @endforeach
</html>