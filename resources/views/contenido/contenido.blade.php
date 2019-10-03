@extends('principal')


@section('contenido')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">

            <template v-if="menu==0">
                   <example-component></example-component>
            </template>

            <template v-if="menu==30">
                    <nuevocredito></nuevocredito>
             </template>
             <template v-if="menu==40">
                    <listarcredito :ruta="ruta"></listarcredito>
             </template>


            
             {{-- INICIO OPCIÓN SOCIOS --}}
            <template v-if="menu==2">
                <listarpersonas :key="1" :ruta='ruta' :tipo="0"></listarpersonas>
            </template>
            <template v-if="menu==3">
                <registrarpersona :key="2" :ruta='ruta' :tipo="0" :registrar="1"></registrarpersona>
            </template>
            {{-- FIN OPCIÓN SOCIOS --}}

            <template v-if="menu==15">
                    <h1>Caja</h1>
             </template>

             <template v-if="menu==16">
                    <h1>Reportes</h1>
             </template>

             {{-- INICIO OPCIÓN ACCESO --}}
             <template v-if="menu==20">
                <listarpersonas :key="3" :ruta='ruta' :tipo="1"></listarpersonas>
            </template>
             <template v-if="menu==21">
                <registrarpersona :key="4" :ruta='ruta' :tipo="1" :registrar="1"></registrarpersona>
            </template>
            <template v-if="menu==22">
                <listaroles :ruta="ruta"/>
            </template>
             {{-- FIN OPCIÓN ACCESO --}}

        </div>
    </div>
</div>
@endsection