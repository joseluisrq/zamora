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
             <template v-if="menu==31">
                    <simularcreditos></simularcreditos>
             </template>
             <template v-if="menu==40">
                    <listarcredito :ruta="ruta"></listarcredito>
             </template>
             <template v-if="menu==100">
                    <pagar :ruta="ruta"></pagar>
             </template>
            
             {{-- INICIO MENU AHORROS --}}
             <template v-if="menu==70">
                <registrarmovimiento :ruta="ruta"/>
             </template>
             <template v-if="menu==71">
                <crearcuentaahorro :ruta="ruta"></crearcuentaahorro>
             </template>
             <template v-if="menu==72">
                <listarcuentas :ruta="ruta"></listarcuentas>
             </template>
             {{-- FIN AHORROS --}}
            
            
             {{-- INICIO MENU SOCIOS --}}
            <template v-if="menu==2">
                <listarpersonas :key="1" :ruta='ruta' :tipo="0"></listarpersonas>
            </template>
            <template v-if="menu==3">
                <registrarpersona :key="2" :ruta='ruta' :tipo="0" :registrar="1"></registrarpersona>
            </template>
            <template v-if="menu==4">
                <aportes :ruta="ruta"></aportes>
            </template>
            {{-- FIN SOCIOS --}}
            
            <template v-if="menu==15">
                    <h1>Caja</h1>
             </template>

             <template v-if="menu==16">
                    <h1>Reportes</h1>
             </template>

             {{-- INICIO MENU ACCESO --}}
             <template v-if="menu==20">
                <listarpersonas :key="3" :ruta='ruta' :tipo="1"></listarpersonas>
            </template>
             <template v-if="menu==21">
                <registrarpersona :key="4" :ruta='ruta' :tipo="1" :registrar="1"></registrarpersona>
            </template>
            <template v-if="menu==22">
                <listaroles :ruta="ruta"/>
            </template>
             {{-- FIN ACCESO --}}

             {{-- INICIO CONFIGURACIÓN --}}
            <template v-if="menu==90">
                <configuraciones :ruta='ruta'/>
            </template>
            {{-- FIN CONFIGURACIÓN --}}

        </div>
    </div>
</div>
@endsection