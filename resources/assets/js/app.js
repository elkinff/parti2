window.$ = window.jQuery = require('jquery');


// Vue 
require('./bootstrap');

window.Vue = require('vue');


import VueCurrencyFilter from 'vue-currency-filter';
import VeeValidate from 'vee-validate';
import InstantSearch from 'vue-instantsearch';

Vue.use(InstantSearch);

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
      required: (field) => "El campo " + field +" es requerido"
    }
  }
};
// console.log(VeeValidate.Validator);
VeeValidate.Validator.localize(dictionary);
VeeValidate.Validator.localize('es'); // now this validator will generate messages in arabic.

// Vue.component('example', require('./components/ExampleComponent.vue'));

VeeValidate.Validator.extend('prueba', {
    getMessage: field => `Deben ser multiplos de $10.000 ($20.000, $50.000)`,
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
    data: {
    	matchs: [],
    	auxMatch: {},
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

    },

    created() {
    	this.getMatchs();
        if (document.querySelector("#saldoUser")) {
            this.saldo_user = document.querySelector("#saldoUser").value;
        }
        //console.log(this.saldo_user);
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

        validateCreditoApuesta() {
            var apuestaUsuario = this.apuesta.replace(/,/g, '').replace(/\$/g, '');
            //console.log(apuestaUsuario);
            //console.log(this.saldo_user);

            if(this.saldo_user < parseInt(apuestaUsuario)){
                this.estado_pago = 3; //Sin pagar 
                return "No tienes crédito suficiente, puedes pagar directamente en el siguiente botón";
            }else {
                this.estado_pago = 0 //Pagado;
                return '';
            }
        }

    },

    methods: {
        validateBeforeSubmit() {
              this.$validator.validateAll().then((result) => {
                if (result) {
                    this.savaMatch();
                  return;
                }
                //alert('Correct them errors!');
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

        validacionHora(fechaMatch) {
            var d = new Date();
            var hora = d.getHours() +''+ d.getMinutes();
            if(fechaMatch.includes('Hoy ')) {
                fechaMatch = fechaMatch.slice(-5).replace(':','');
                if(hora >= fechaMatch){
                    return false;    
                }
            }else{
                return true;
            }
        },

    	detailMatch(match) {
    		console.log(match);
            this.apuesta = '';
            this.errors.clear();
    		this.auxMatch = match;
    	},

    	savaMatch() {
            this.loadingPago =  true;

    		var urlSaveMatch = 'api/publicar'; 
    		
            this.matchUser = this.auxMatch;
    		this.matchUser.valor = this.apuesta
    		this.matchUser.valor_ganado = this.totalGanancia;
            this.matchUser.id_retador = this.id_retador;
            this.matchUser.estado_pago = this.estado_pago;

            //console.log(this.matchUser);

    		axios.post(urlSaveMatch, this.matchUser).then(response => {


                this.link_compartir = response.data.link;

                //console.log(response.data);
                var equipoRetador = response.data.equipoRetador.nombre;

                //console.log(equipoRetador);

                //$("#modalCompartir").modal('show');

                var handler = ePayco.checkout.configure({
                    key: '68b310ef2761a73e4cc4c06b0631beba',
                    test: true
                });

                var data={
                  //Parametros compra (obligatorio)
                  name: "Publicación  Parti2",
                  description: "Acabas de realizar una publicación a favor de " + equipoRetador,
                  invoice: response.data.publicacion,//Id publicacion
                  currency: "cop",
                  amount: this.apuesta,
                  tax_base: "0",
                  tax: "0",
                  country: "co",
                  lang: "es",

                  //Onpage="false" - Standard="true"
                  external: "true",

                  //Atributos opcionales
                  extra1: response.data.publicacion,
                
                  confirmation: "http://secure2.payco.co/prueba_curl.php",
                  response: "http://secure2.payco.co/prueba_curl.php",

                }

                handler.open(data);

                this.loadingPago =  false;

                $("#modalApostar").modal('hide');

			})
			.catch(e => {
				console.log(e);
			});
            
           
    	},

        imageUrl(url) {
            return 'url("'+ url + '")';
        },

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
require('./functions');
require('./modal');
require('./sweetalert');









