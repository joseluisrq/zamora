@extends('principal')


@section('contenido')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">

            <template v-if="menu==0">
                   <example-component></example-component>
            </template>

            <template v-if="menu==15">
                    <h1>Caja</h1>
             </template>

             <template v-if="menu==16">
                    <h1>Reportes</h1>
             </template>

        </div>
    </div>
</div>
@endsection