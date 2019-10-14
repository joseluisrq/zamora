/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//creditos
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('nuevocredito', require('./components/creditos/NuevoCredito.vue').default);
Vue.component('listarcredito', require('./components/creditos/ListarCredito.vue').default);
Vue.component('detallecredito', require('./components/creditos/DetalleCredito.vue').default);
Vue.component('pagar', require('./components/creditos/Pagar.vue').default);
Vue.component('pagarcuota', require('./components/creditos/PagarCuota.vue').default);



//Personas
Vue.component('registrarpersona', require('./components/personas/PersonaRegistro.vue').default);
Vue.component('listarpersonas', require('./components/personas/PersonaLista.vue').default);
Vue.component('detallepersona', require('./components/personas/PersonaDetalle.vue').default);
Vue.component('listaroles', require('./components/personas/RolesLista.vue').default);


Vue.component('crearcuentaahorro', require('./components/ahorros/CrearCuentaAhorro.vue').default);
Vue.component('aportes', require('./components/aportes/Aportes.vue').default);


Vue.component('simularcreditos', require('./components/creditos/SimularCreditos.vue').default);


//Ahorros
Vue.component('listarcuentas', require('./components/ahorros/ListaCuentas.vue').default);
Vue.component('detallecuenta', require('./components/ahorros/DetalleCuentaAhorro.vue').default);
Vue.component('crearcuentaahorro', require('./components/ahorros/CrearCuentaAhorro.vue').default);
Vue.component('registrarmovimiento', require('./components/ahorros/RegistrarMovimiento.vue').default);

// CONFIGURACIONES DE TASAS
Vue.component('configuraciones', require('./components/configuracion/Configuracion.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        menu: 100,
        ruta: 'http://127.0.0.1:8000',

    },

});