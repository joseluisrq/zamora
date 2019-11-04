@extends('principal')


@section('contenido')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">

        @if(Auth::check()) <!--si el usuario esta autentificado-->
                    @if (Auth::user()->idrol == 1)
                    <template v-if="menu==0">
                        <example-component :ruta="ruta"></example-component>
                    </template>

                    <template v-if="menu==30">
                            <nuevocredito :ruta="ruta"></nuevocredito>
                    </template>
                    <template v-if="menu==31">
                            <simularcreditos :ruta="ruta"></simularcreditos>
                    </template>
                    <template v-if="menu==40">
                            <listarcredito :ruta="ruta"  :rol="1"></listarcredito>
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
                        <listarpersonas :key="1" :ruta='ruta' :tipo="0"  :rol="1"></listarpersonas>
                    </template>
                    <template v-if="menu==3">
                        <registrarpersona :key="2" :ruta='ruta' :tipo="0" :registrar="1"></registrarpersona>
                    </template>
                    <template v-if="menu==4">
                        <aportes :ruta="ruta"></aportes>
                    </template>
                    {{-- FIN SOCIOS --}}
                    
                

                    <template v-if="menu==16">
                        <reportes :ruta="ruta" :rol="1"></reportes>
                    </template>

                    {{-- INICIO MENU ACCESO --}}
                    <template v-if="menu==20">
                        <listarpersonas :key="3" :ruta='ruta' :tipo="1"  :rol="1"></listarpersonas>
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
                    
                    <!--Caja-->
                      <!--Caja-->
                      <template v-if="menu==77">
                        <cajaadmin :ruta='ruta'/>
                    </template>


                    @elseif (Auth::user()->idrol == 2)
                    <template v-if="menu==0">
                        <example-component :ruta="ruta"></example-component>
                    </template>

                    <template v-if="menu==30">
                            <nuevocredito :ruta="ruta"></nuevocredito>
                    </template>
                    <template v-if="menu==31">
                            <simularcreditos :ruta="ruta"></simularcreditos>
                    </template>
                    <template v-if="menu==40">
                            <listarcredito :ruta="ruta" :rol="2"></listarcredito>
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
                        <listarpersonas :key="1" :ruta='ruta' :tipo="0" :rol="2"></listarpersonas>
                    </template>
                    <template v-if="menu==3">
                        <registrarpersona :key="2" :ruta='ruta' :tipo="0" :registrar="1"></registrarpersona>
                    </template>
                    <template v-if="menu==4">
                        <aportes :ruta="ruta"></aportes>
                    </template>
                    {{-- FIN SOCIOS --}}
                    
            

                    {{-- INICIO MENU ACCESO --}}
                    <template v-if="menu==20">
                        <listarpersonas :key="3" :ruta='ruta' :tipo="1" :rol="2"></listarpersonas>
                    </template>
                    <template v-if="menu==21">
                        <registrarpersona :key="4" :ruta='ruta' :tipo="1" :registrar="1"></registrarpersona>
                    </template>

                    <template v-if="menu==16">
                        <reportes :ruta="ruta" :rol="1"></reportes>
                    </template>

                   

                  
                    {{-- FIN ACCESO --}}

                 

                    @elseif (Auth::user()->idrol == 3)
                    <template v-if="menu==0">
                        <example-component :ruta="ruta"></example-component>
                    </template>
                    <template v-if="menu==15">
                        <caja :ruta='ruta'/>
                    </template>
                    <template v-if="menu==40">
                            <listarcredito :ruta="ruta" :rol="3"></listarcredito>
                    </template>
                    <template v-if="menu==100">
                            <pagar :ruta="ruta"></pagar>
                    </template>
                    
                    {{-- INICIO MENU AHORROS --}}
                    <template v-if="menu==70">
                        <registrarmovimiento :ruta="ruta"/>
                    </template>
                   
                    <template v-if="menu==72">
                        <listarcuentas :ruta="ruta"></listarcuentas>
                    </template>
                    {{-- FIN AHORROS --}}
                    
                    
                    {{-- INICIO MENU SOCIOS --}}
                    <template v-if="menu==2">
                        <listarpersonas :key="1" :ruta='ruta' :tipo="0" :rol="3"></listarpersonas>
                    </template>
                   
                    <template v-if="menu==4">
                        <aportes :ruta="ruta"></aportes>
                    </template>
                    {{-- FIN SOCIOS --}}
                    
                   
                    {{-- INICIO MENU ACCESO --}}
                    <template v-if="menu==20">
                        <listarpersonas :key="3" :ruta='ruta' :tipo="1" :rol="3"></listarpersonas>
                    </template>
                
                    @else
                
                    @endif

        @endif

          

        </div>
    </div>
</div>
@endsection