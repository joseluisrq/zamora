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
                <h4>Reporte de Socios</h4>
            </div>
           


            <h4>Detalle de Socios </h4>
                <table style="width:100%">
                    <tr>
                        <td style="width:5%">Id Socio</th>
                        <td style="width:17%">DNI</th>
                       <td style="width:17%">Nombres</th>
                       <td style="width:17%">Dirección</th>                       
                       <td style="width:17%">Teléfono</th>
                       <td style="width:17%">Email</th>
                       <td style="width:17%">Estado</th>
                    
                                             
                       
                    </tr>
                                    
                
                    @foreach ($socios as $c)
                    <tr>
                        <td style="width:5%">{{$c->id}}</td>
                        <td style="width:5%">{{$c->dni}}</td>
                        <td style="width:5%"><font size="1">{{$c->nombre}} {{$c->apellidos}}</font></td>
                        <td style="width:5%"><font size="1">{{$c->direccion}}</font></td>
                        <td style="width:5%">{{$c->telefono}}</td>
                        <td style="width:5%">{{$c->email}}</td>
                        <td style="width:5%;size">
                        @if($c->estado==1)
                        Activo
                        @endif
                        @if($c->estado==0)
                        Inactivo
                        @endif
                        </td>
                        

                        
                    </tr>
                    @endforeach
                  
                  

                </table>
        
        </div>
        
    </div>
   
</html>