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
                   
                </table>
               
           
           
        </div>
        
    </div>


    <SCRIPT language=JavaScript>
        var FRANCES = false;

        var TIN = 0;
        var TA = 0;
        var TAN = 0;
        var AA = 0;
        var CUOTA = "";
        var I = 0;
        var AN = 0;
        var IN = 0;
        var A1 = 0;
        var CP2 = 0;
        var POT = 0;
        var CP1 = 0;

     
            // DATOS DEL FORMULARIO
            var FRANCES = false;

            var TIN = 0;
            var TA = 0;
            var TAN = 0;
            var AA = 0;
            var CUOTA = "";
            var I = 0;
            var AN = 0;
            var IN = 0;
            var A1 = 0;
            var CP2 = 0;
            var POT = 0;
            var CP1 = 0;
            var C = "<?php echo $c->montodesembolsado; ?>";
            var J = "<?php echo $c->tasa; ?>" / 100;
            var N ="<?php echo $c->numerocuotas; ?>" ;
            var D = 0;

            N = Math.round(N);
            var M = "<?php echo $c->periodo; ?>";
            var DETALLE = true;
            var FRANCES = true;

            var INCARENCIA = true;
            var DD = 2;
            if (M == 1) {
                CUOTA = "ANUALES"
            }
            if (M == 2) {
                CUOTA = "SEMESTRALES"
            }
            if (M == 4) {
                CUOTA = "TRIMESTRALES"
            }
            if (M == 12) {
                CUOTA = "MENSUALES"
            }


            if (FRANCES) {
                I = Math.pow(1 + J, 1 / M) - 1;
                AN = 0;
                IN = 0;
                A1 = 0;
                CP2 = C;
                POT = parseInt(D) - N;
                TIN = 0;
                TA = 0;
                TAN = 0;

             document.write(
                    `<center>
                        <table border="0" bgcolor="white" width="100%">
                           <tr><td><center><font size="+0" face="Arial" color="#000000"><b>´PRESTAMO -CALCULO<br><font size="2" color="#000000">Prestamo duracion ` + Math.round(N * 10 / M) / 10 + ` años</td></tr></table></center>
                    `);
                document.write('<P>');
                document.write('<div align="center"><center><table border="1" bgcolor="white" width="50%"><tr><td align="right"><font face="Verdana" size="2" color="black"><b>Monto:</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + C + '</td></tr><tr><td align="right"><font face="Verdana" size="2" color="black"><b>T.A.E en %</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + J * 100 + '</td></tr><tr><td align="right"><font face="Verdana" size="2" color="black"><b>Periodo de cuotas</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + CUOTA + '</td></tr><tr><td align="right"><font face="Verdana" size="2" color="black"><b>Número de Cuotas: </td><td align="center"><font face="Verdana" size="2" color="black"><b>' + N + '</td></tr></table></center></div>');
                document.write('<P>');

                //Vista
                if (DETALLE) {
                /*    document.write('<center><table border="1" bgcolor="white"><tr bgcolor="white"><td align="center"><font face="Verdana" size="2" color="000000"><b>PERIODO</td><td align="center"><font face="Verdana" size="2" color="000000"><b>CUOTAS</td><td align="center"><font face="Verdana" size="2" color="000000"><b>INTERESES</td><td align="center"><font face="Verdana" size="2" color="000000"><b>AMORTIZACION</td><td align="center"><font face="Verdana" size="2" color="000000"><b>CAPITAL PENDIENTE</td></tr>');
                */ }
                for (var K = 0; K <= N; K++) {

                    TIN = TIN + IN;
                    TA = TA + A1;
                    TAN = TAN + AN;
                    if (DETALLE) {
                     document.write('<tr><td align="center"><font face="Verdana" size="2" color="black"><b>' + K + '</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + deci(AN, DD) + '</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + deci(IN, DD) + '</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + deci(A1, DD) + '</td><td align="center"><font face="Verdana" size="2" color="black"><b>' + deci(CP2, DD) + '</td></tr>');
                   }
                    if (K < D) {
                        if (INCARENCIA) {
                            AN = C * I;
                            IN = C * I;
                            A1 = 0;
                            CP2 = C;
                        }
                        if (!INCARENCIA) {
                            AN = 0;
                            IN = 0;
                            CP2 = C * Math.pow(1 + I, K);
                        }
                    }
                    if (K == D) {
                        if (INCARENCIA) {
                            AN = (C * I) / (1 - Math.pow(1 + I, POT));
                            IN = C * I;
                            A1 = AN - IN;
                            CP2 = C - A1;
                            CP1 = CP2;
                        }
                        if (!INCARENCIA) {
                            CP1 = C * Math.pow(1 + I, D);
                            AN = (CP1 * I) / (1 - Math.pow(1 + I, POT));
                            IN = CP1 * I;
                            A1 = AN - IN;
                            CP2 = CP1 - A1
                        }
                    }

                    if (K > D) {
                        IN = CP1 * I;
                        A1 = AN - IN;
                        CP2 = CP1 - A1;
                        CP1 = CP2;
                    }

                }
                if (DETALLE) {

                document.write('<tr bgcolor="white"><td align="center"><font face="Verdana" size="2" color="000000"><b>TOTALES:</td><td align="center"><font face="Verdana" size="2" color="000000"><b>' + deci(TAN, DD) + '</td><td align="center"><font face="Verdana" size="2" color="000000"><b>' + deci(TIN, DD) + '</td><td align="center"><b><font face="Verdana" size="2" color="000000"><b>' + deci(TA, DD) + '</td><td align="center">&nbsp;</td></tr>');
                    document.write('</table></center>');
                }

                if (!DETALLE) {
                  document.write('<center><table border="1" width="50%"><tr bgcolor="white"><td align="center">&nbsp;</td><td align="center"><font face="Verdana" size="2" color="000000"><b>CUOTAS</td><td align="center"><font face="Verdana" size="2" color="000000"><b>INTERESES</td><td align="center"><font face="Verdana" size="2" color="000000"><b>AMORTIZACION</td></tr>');
                    document.write('<tr bgcolor="#007bce"><td align="center"><font face="Verdana" size="2" color="ffff00"><b>TOTALES:</td><td align="center"><font face="Verdana" size="2" color="ffff00"><b>' + deci(TAN, DD) + '</td><td align="center"><font face="Verdana" size="2" color="ffff00"><b>' + deci(TIN, DD) + '</td><td align="center"><font face="Verdana" size="2" color="ffff00"><b>' + deci(TA, DD) + '</td></tr>');
                    document.write('</table></center>');
                     }
            }

            function deci(GG, KK) {
                return (Math.round(GG * Math.pow(10, KK)) / Math.pow(10, KK))
            }
      

        //-->
    </SCRIPT>


    @endforeach
</html>