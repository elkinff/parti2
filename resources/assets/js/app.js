window.$ = window.jQuery = require('jquery');
// Vue
require('./bootstrap');

window.Vue = require('vue');

import VueCurrencyFilter from 'vue-currency-filter';
import VeeValidate from 'vee-validate';
import vueSlider from 'vue-slider-component';

Vue.use(VeeValidate);

Vue.use(VueCurrencyFilter, 
{
  symbol : '$', 
  thousandsSeparator: ',',
  fractionCount: 0,
  fractionSeparator: ',',
  symbolPosition: 'front',
  symbolSpacing: false
});

const dictionary = {
  es: {
    messages: {
      required: (field) => "El campo " + field +" es requerido",
      digits: (field, digits) => "El campo " + field +" debe tener " + digits + " dígitos",
    }
  }
};
// console.log(VeeValidate.Validator);
VeeValidate.Validator.localize(dictionary);
VeeValidate.Validator.localize('es'); // now this validator will generate messages in arabic.

// Vue.component('example', require('./components/ExampleComponent.vue'));

VeeValidate.Validator.extend('prueba', {
    getMessage: field => `Deben ser múltiplos de $10.000 ($20.000, $50.000)`,
    validate: value => {
        value = value.replace(/,/g, '').replace(/\$/g, '');
        if( value!= 0 && (value % 10000) == 0 && value !== '$0' ){
            //console.log(value);
            return true;
        }else {
            return false;
        }
    }
});

// Vista de publicar
const app = new Vue({
    el: '#app',
    components: {
        vueSlider
    },

    data: {
        baseUrl: '',
        urlPasarela: 'https://app.parti2.com',
        matchs: [],
        auxMatch: {},
        
        auxMatch2: {
            equipo_local: {
                nombre: '',
                escudo:'',
                seleccionado:'',
            },
            equipo_visitante: {
                nombre: '',
                escudo:'',
                seleccionado:'',
            }
        },

        banderaDetalle: false, 

        apuesta:'',
        ganacia_apuesta:'',
        retencion_parti2 : '5',
        
        search:'',
        checkedLigas: [],
        searchDate:'',

        matchUser: {},
        saldo_user: '',
        estado_pago: '',

        id_retador: '',

        clickHoyState : 0,

        loading: false,

        loadingPago : false,

        link_compartir : '',

        // MUro

        publicaciones:[],

        valor_minino:0,
        valor_maximo:500,

        precio_apuesta: {
            value: [10000, 500000],
            width: '80%',
            height: 8,
            dotSize: 16,
            min: 10000,
            max: 500000,
            disabled: false,
            show: true,
            tooltip: 'always',
            formatter: (v) => `$${Math.round(v).toLocaleString()}`,

            bgStyle: {
                backgroundColor: '#999',
            },
            tooltipStyle: {
                fontSize: '14px',
            },
            processStyle: {
                backgroundColor: '#fff'
            }
        },

        creditoAgregar:'',
        errorCredito:'',
        valorRetiroCredito:'',
        creditoRetirar:'',
        errorRetirar:'',

    },

    created() {
        this.getPublicaciones();
        this.getMatchs();

         if (document.querySelector("#saldoUser")) {
            this.saldo_user = document.querySelector("#saldoUser").value;
        }

        if (document.querySelector("#valor_minimo")) {
            this.precio_apuesta.min = parseInt(document.querySelector("#valor_minimo").value);
        }

        if (document.querySelector("#valor_maximo")) {
            this.precio_apuesta.max = parseInt(document.querySelector("#valor_maximo").value);
        }

        if (document.querySelector("#valor_maximo")) {
            this.precio_apuesta.value = [ parseInt(document.querySelector("#valor_minimo").value), parseInt(document.querySelector("#valor_maximo").value) ];
        }

    },

    computed:{
        totalGanancia() {
            var apuestaUsuario = this.apuesta.replace(/,/g, '').replace(/\$/g, '');

            var porcentajeParti2 = (apuestaUsuario * 2 / 100) * this.retencion_parti2;
            
            return (apuestaUsuario * 2) - porcentajeParti2;
        },

        filteredMatch(){

            var self=this;
            if (!this.checkedLigas.length){
                return this.matchs
                .filter(match => match.homeTeamName.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 || match.awayTeamName.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 )
                .filter(match => match.date.slice(0,10).indexOf(self.searchDate)>=0)
                .filter(match => this.validacionHora(match.date_show))
            }

            return this.matchs
                .filter(match => match.homeTeamName.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 || match.awayTeamName.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 )
                .filter(match => self.checkedLigas.includes(match.league))
                .filter(match => match.date.slice(0,10).indexOf(self.searchDate)>=0)
                .filter(match => this.validacionHora(match.date_show))

        },

        // --- Filter Matchs
        filteredPublicaciones(){
            var self=this;
            if (!this.checkedLigas.length){
                return this.publicaciones
                .filter(match => match.equipo_local.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 || match.equipo_visitante.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 )
                .filter(match => match.valor >= this.precio_apuesta.value[0] && match.valor <= this.precio_apuesta.value[1])
                .filter(match => match.partido.fecha_inicio.slice(0,10).indexOf(self.searchDate)>=0)
                .filter(match => this.validacionHora(match.partido.fecha_inicio))
            }

            
            return this.publicaciones
                .filter(match => match.equipo_local.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 || match.equipo_visitante.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(self.search.toLowerCase())>=0 )
                .filter(match => match.valor >= this.precio_apuesta.value[0] && match.valor <= this.precio_apuesta.value[1])
                .filter(match => self.checkedLigas.includes(match.partido.id_liga.toString()))
                .filter(match => match.partido.fecha_inicio.slice(0,10).indexOf(self.searchDate)>=0)
                .filter(match => this.validacionHora(match.partido.fecha_inicio))
        

        },

        validateCreditoApuesta() {
            var apuestaUsuario = this.apuesta.replace(/,/g, '').replace(/\$/g, '');

            if(this.saldo_user < parseInt(apuestaUsuario)) {
                this.estado_pago = 7; //Sin pagar 
                return "No tienes crédito suficiente, el saldo restante lo puedes pagar directamente en el siguiente botón";
            }else {
                this.estado_pago = 0 //Pagado;
                return '';
            } 
        },

        validateRetiroCredito() {
            // Remoción de puntos y signo pesos. 
            var creditoRetirarFormat = this.creditoRetirar.replace(/,/g, '').replace(/\$/g, '');
            if(parseInt(creditoRetirarFormat) > parseInt(this.saldo_user) ) {
                this.errorRetirar = false;
                return "No tienes crédito suficiente, el valor del retiro debe ser menor o igual a tu saldo";;
            }else {
                
                this.errorRetirar = true;
                return ''; 
            }
        },

    },

    methods: {
        validateBeforeSubmit() {
              this.$validator.validateAll().then((result) => {
                if (result) {
                    this.saveMatch();
                  return;
                }
                //'Correct them errors!';
            });
        },


        validateBeforeSubmitRetirar() {
            
            this.$validator.validateAll().then((result) => {
                if (result && this.errorRetirar) {
                    document.querySelector("#formRetirarCredito").submit();
                  return;
                }
            });
        }, 


        getMatchs() {
            this.loading = true;

            var urlMatchs = 'partidos';
            axios.get(urlMatchs).then(response => {
                this.matchs = response.data;
                this.loading = false;
            })
            .catch(e => {
                console.log(e);
            });
        },

        // Get matchs
        getPublicaciones() {
            this.loading = true;

            var urlMatchs = 'publicaciones';
            axios.get(urlMatchs).then(response => {
                this.publicaciones = response.data;

                this.loading = false;
            })
            .catch(e => {
                console.log(e);
            });
        },
        
        // Validar que le partido no halla empezado de acuerdo con la hora del sistema
        validacionHora(fechaMatch) {
            var d = new Date();

            var hora = d.getHours() +''+ (d.getMinutes()<10?'0':'') + d.getMinutes();
            
            //console.log(hora);

            if(fechaMatch.includes('Hoy ')) {
                fechaMatch = fechaMatch.slice(-5).replace(':','');
                
                // Prueba hora vs fecha
                console.log("La fecha del partido es : " + fechaMatch);
                console.log("la hora del partido es :  " ,  hora)

                if(parseInt(hora) >= parseInt(fechaMatch)){
                    console.log("la hora es menor");
                    return false;    
                }else {
                    return true;
                }
            }else{
                return true;
            }
        },


        detailMatch(match) {
            console.log(match);

            var ele = document.getElementsByName("equipo");

            for(var i=0;i<ele.length;i++){
                ele[i].checked = false;
            }

            $(".img-check").removeClass("check");
            
            this.id_retador = '';
            this.errors.clear();
            this.auxMatch = match;
            this.apuesta = '';
            //this.auxMatch2 = match;
        },

        // Match
        detailPublicacion(match, bandera) {
            console.log(match);
            //console.log("la bandera es" , bandera);
            if(bandera == 'detalle' ) {
                this.banderaDetalle =  true;
            }else {
                this.banderaDetalle =  false;
            }
            var porcentajeParti2 = (match.valor * 2 / 100) * this.retencion_parti2;
            var ganancia_match = ( match.valor * 2 ) - porcentajeParti2;

            this.auxMatch2 = match;
            this.auxMatch2.ganancia_match = ganancia_match;

        },

        //Publicacion de un macth
        saveMatch() {
            this.loadingPago =  true;
            var apuestaUsuario = this.apuesta.replace(/,/g, '').replace(/\$/g, '');
            var valor_apuesta = 0;//Valor apuesta en pago epayco
            var bandera_pasarela = false;
            
            if(parseInt(this.saldo_user) > parseInt(apuestaUsuario)) {
                //console.log("bandera_pasarela es falsa " + this.saldo_user + ", " + apuestaUsuario);                
                bandera_pasarela = false;
                valor_apuesta = this.saldo_user - apuestaUsuario ;    
            }else {
                //console.log("bandera_pasarela es verdadera " + this.saldo_user + ", " + apuestaUsuario);             
                bandera_pasarela = true;
                valor_apuesta = apuestaUsuario - this.saldo_user ;    
            }

            var impuesto_payco = ((valor_apuesta / 100 ) * 2.99 + 900) ;

            var impuesto_payco_iva = impuesto_payco * 0.19;

            var valor_base  = valor_apuesta + (impuesto_payco + impuesto_payco_iva);//Valor con impuesto mnos de rete fuente

            var impuesto_rete_fuente = (valor_base / 100) * 1.5;

            var valor_total_payco = +valor_base + +impuesto_rete_fuente;


            var urlSaveMatch = 'api/publicar'; 
            
            this.matchUser = this.auxMatch;
            this.matchUser.valor = this.apuesta
            this.matchUser.valor_ganado = this.totalGanancia;
            this.matchUser.id_retador = this.id_retador;
            this.matchUser.estado_pago = this.estado_pago;

            console.log(this.estado_pago);

            axios.post(urlSaveMatch, this.matchUser).then(response => {


                this.link_compartir = response.data.link;

                this.saldo_user = response.data.saldo;

                //console.log(response.data);
                var equipoRetador = response.data.equipoRetador.nombre;

                // Impresiones de prueba
                console.log("El valor total es: ", valor_apuesta + (impuesto_payco + impuesto_payco_iva));
                
                console.log("El valor de los impuestos es:" ,  impuesto_payco + impuesto_payco_iva + impuesto_rete_fuente);

                console.log("El valor de la rete fuente es:" , impuesto_rete_fuente);

                console.log("El valor total enviado a payco es igual a " , valor_total_payco);

                console.log("El valor total de la apuesta menos el impuesto es ", valor_total_payco - (impuesto_payco + impuesto_payco_iva + impuesto_rete_fuente));

            
                if (bandera_pasarela && valor_apuesta !=0 && valor_apuesta > 0) {
                    var handler = ePayco.checkout.configure({
                        key: 'cc6dfc520c35ec628e622bcf782a5f01',
                        test: false
                    });
                    
                    var data={
                        //Parametros compra (obligatorio)
                        name: "Publicación  Parti2",
                        description: "Acabas de realizar una publicación a favor de " + equipoRetador.replace('&',''),
                        invoice: response.data.publicacion.toString(),//Id publicacion
                        currency: "cop",
                        amount: valor_total_payco.toFixed(2)  ,
                        tax_base: valor_apuesta.toFixed(2),
                        tax: (+impuesto_payco + +impuesto_payco_iva + +impuesto_rete_fuente).toFixed(2),
                        country: "co",
                        lang: "es",
                        //Onpage="false" - Standard="true"
                        external: "true",
                        //Atributos opcionales
                        extra1: "publicacion",
                        extra2: "extra2",
                        extra3: "extra3",

                        confirmation: this.urlPasarela + "/api/publicar/confirmacion",
                        response: this.urlPasarela + "/api/publicaciones/respuestaPasarela",
                    }


                    // var data_funciona= {
                    //    //Parametros compra (obligatorio)
                    //    name: "Publicación  Parti2",
                    //    description: "Acabas de realizar una publicación a favor de Real Sociedad de Fútbol",
                    //    invoice: "10",
                    //    currency: "cop",
                    //    amount: "11598.21" ,
                    //    tax_base: "11598.21",
                    //    tax: "1598.21",
                    //    country: "co",
                    //    lang: "es",

                    //    //Onpage="false" - Standard="true"
                    //    external: "true",


                    //    //Atributos opcionales
                    //    extra1: "extra1",
                    //    extra2: "extra2",
                    //    extra3: "extra3",
                    //    confirmation: "https://app.parti2.com/api/publicar/confirmacion",
                    //    response: "https://app.parti2.com/api/publicaciones/respuestaPasarela",
                    // }

                    console.log(data);

                    handler.open(data);
                }else {
                    this.loadingPago =  false;
                    $("#modalApostar").modal('hide');
                    $("#modalCompartir").modal('show');
                }

            })
            .catch(e => {
                console.log(e);
            });
           
        },

        // Match publicacion
        savePublicacion() {
            this.loadingPago = true;
            var urlSavePublicacion = '/publicaciones/match';
        
            var apuestaUsuario = this.auxMatch2.valor;
            var valor_apuesta = 0;//Valor apuesta en pago epayco
            var bandera_pasarela = false;
            
            if(parseInt(this.saldo_user) > parseInt(apuestaUsuario)) {
                valor_apuesta = this.saldo_user - apuestaUsuario ;    
            }else {
                bandera_pasarela = true;
                valor_apuesta = apuestaUsuario - this.saldo_user ;    
            } 
            var equipoSeleccionado ;//Equipo contrario
            if(this.auxMatch2.equipo_local.seleccionado)  {
                equipoSeleccionado  = this.auxMatch2.equipo_visitante.nombre;
            }else {
                equipoSeleccionado  = this.auxMatch2.equipo_local.nombre;
            }

            var impuesto_payco = ((valor_apuesta / 100 ) * 2.99 ) + 900 ;
            var impuesto_payco_iva = impuesto_payco * 0.19;


            var valor_base  = valor_apuesta + (impuesto_payco + impuesto_payco_iva);//Valor con impuesto mnos de rete fuente

            var impuesto_rete_fuente = (valor_base / 100) * 1.5;

            var valor_total_payco = +valor_base + +impuesto_rete_fuente;

            var idUsuario = document.querySelector('#idUsuario').value;

            
            this.matchUser = this.auxMatch2;
            if (bandera_pasarela) {
                this.estado_pago = 3
            }else {
                this.estado_pago = 0
            }

            this.matchUser.estado_pago = this.estado_pago;

            if (bandera_pasarela && valor_apuesta != 0 ) {
                
                var handler = ePayco.checkout.configure({
                    key: 'cc6dfc520c35ec628e622bcf782a5f01',
                    test: false
                });

                var data={
                    //Parametros compra (obligatorio)
                    name: "Match Parti2",
                    description: "Acabas de realizar un Match en Parti2, a favor del equipo " + equipoSeleccionado ,
                    invoice: this.auxMatch2.id.toString(),//Id publicacion
                    currency: "cop",
                    amount: valor_total_payco.toFixed(2) ,
                    tax_base: valor_apuesta.toFixed(2),
                    tax: (+impuesto_payco + +impuesto_payco_iva + +impuesto_rete_fuente).toFixed(2) ,
                    country: "co",
                    lang: "es",
                    //Onpage="false" - Standard="true"
                    external: "true",
                    //Atributos opcionales
                    extra1: "match",
                    extra2: idUsuario,
                    extra3: valor_apuesta,
                    confirmation: this.urlPasarela + "/api/publicar/confirmacion",
                    response: this.urlPasarela + "/api/publicaciones/respuestaPasarela",
                }

                handler.open(data);

            }else {
                // Save Match
                axios.post(this.baseUrl + urlSavePublicacion, this.matchUser).then(response => {
                    //console.log("" + response.data.saldo);
                    this.saldo_user = response.data.saldo;
                    $("#modalApostar").modal('hide');
                    if(this.banderaDetalle) {
                        
                        swal("Felicidades!", "Se ha creado el match satisfactoriamente!", "success").then(() => {
                            window.location.reload();
                        });

                    }else {
                        this.getPublicaciones();
                        swal("Felicidades!", "Se ha creado el match satisfactoriamente!", "success");
                    }
                    this.loadingPago =  false;
                })
                .catch(e => {
                    console.log(e);
                });
            }
        },

        agregarCredito() {

            this.loadingPago = true;
            
            var impuesto_payco;
            var impuesto_payco_iva;

            var urlAgregarCredito = '/credito/agregar';

            var radios = document.getElementsByName('creditoAgregar');
            var creditoAgregarOpcion;
            for (var i = 0, length = radios.length; i < length; i++) {
                if (radios[i].checked) {
                    creditoAgregarOpcion = radios[i].value;
                    break;
                }
            }

            var idUsuario = document.querySelector('#idUsuario').value;
            
            var creditoAgregarValor = this.creditoAgregar.replace(/,/g, '').replace(/\$/g, '');
            var creditoAgregarFinal;

            if (creditoAgregarOpcion == 'valor') {
                creditoAgregarFinal = creditoAgregarValor;
                impuesto_payco = ((creditoAgregarValor / 100 ) * 2.99 ) + 900 ;
                
            }else {
                creditoAgregarFinal = creditoAgregarOpcion;
                impuesto_payco = ((creditoAgregarOpcion / 100 ) * 2.99 ) + 900 ;
            }
            impuesto_payco_iva = impuesto_payco * 0.19;


            var valor_base  = +creditoAgregarFinal + (+impuesto_payco + +impuesto_payco_iva);//Valor con impuesto mnos de rete fuente

            var impuesto_rete_fuente = (valor_base / 100) * 1.5;

            var valor_total_payco = + valor_base + +impuesto_rete_fuente;

          // Impresiones de prueba
            console.log("el valor del credito a agregar es " , creditoAgregarFinal);
            console.log("El valor total es: ", valor_base);
            console.log("El valor de los impuestos es:" ,  impuesto_payco + impuesto_payco_iva)
            console.log("El valor de la rete fuente es:" , impuesto_rete_fuente);
            console.log("El valor total enviado a payco es igual a " , valor_total_payco);

            var handler = ePayco.checkout.configure({
                key: 'cc6dfc520c35ec628e622bcf782a5f01',
                test: false
            });

            var objectCredito = {
                valor : creditoAgregarFinal,
                id_usu  : idUsuario,
            }    

            if(creditoAgregarFinal && creditoAgregarFinal!=0) {
               
                axios.post(this.baseUrl + urlAgregarCredito, objectCredito).then(response => {

                    var data={
                        //Parametros compra (obligatorio)
                        name: "Crédito Parti2",
                        description: "Agregar crédito a tu saldo de Parti2",
                        invoice: this.auxMatch2.id.toString(),//Id publicacion
                        currency: "cop",
                        amount: parseInt(valor_total_payco).toFixed(2) ,
                        tax_base: creditoAgregarFinal.toFixed(2),
                        tax: (+impuesto_payco + +impuesto_payco_iva + +impuesto_rete_fuente).toFixed(2),
                        country: "co",
                        lang: "es",
                        //Onpage="false" - Standard="true"
                        external: "true",
                        //Atributos opcionales
                        extra1: idUsuario,
                        extra2: response.data.id,
                        extra3: creditoAgregarFinal,
                        confirmation: this.urlPasarela + "/api/credito/agregar/confirmacion",
                        response: this.urlPasarela + "/api/credito/agregar/respuesta",
                    }

                    handler.open(data);
                    
                })
                .catch(e => {
                    console.log(e);
                });

            }else {
                this.errorCredito = "Debes seleccionar una opción o ingresar un valor";
            }

        },     

        // Rutas dinamicas para las imagenes 
        imageUrl(url) {
            return 'url("'+ url + '")';
        },

        // Filtro de los partidos por dia y fecha
        filterDia(dia) {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            if(dd<10) {
                dd = '0'+dd
            } 
            if(mm<10) {
                mm = '0'+mm
            } 
            today = yyyy + '-' + mm + '-' + dd;
            
            // var tomorrow = new Date() 
            // tomorrow = yyyy + '-' + mm + '-' + (dd + 1);

            if(this.clickHoyState == 0) {
                this.searchDate = today;    
                this.clickHoyState = 1;
            }else {
                this.searchDate = '';
                this.clickHoyState = 0;
            }
        },
    }

});


require('./framy');
//require('./hammer.min.js');
require('./functions');
require('./modal');
require('./sweetalert');


