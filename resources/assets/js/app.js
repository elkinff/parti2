window.$ = window.jQuery = require('jquery');


// Vue 
require('./bootstrap');

window.Vue = require('vue');


import VueCurrencyFilter from 'vue-currency-filter';
import VeeValidate from 'vee-validate';

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
            console.log(value);
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

    	matchUser: {},
        prueba:'',

        errorsForm:{
            apuesta:''
        },



    },

    created() {
    	this.getMatchs();
    },

    computed:{
	 	totalGanancia() {
            var apuestaUsuario = this.apuesta.replace(/,/g, '').replace(/\$/g, '');

	 		var porcentajeParti2 = (apuestaUsuario * 2 / 100) * this.retencion_parti2;
            
	    	return (apuestaUsuario * 2) - porcentajeParti2;

	    },

	    filteredMatch:function() {
			var self=this;
			return this.matchs.filter(function(match){
	        	return match.homeTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 || match.awayTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 ;
	      	});
	    },


    },

    methods: {
        validateBeforeSubmit() {
              this.$validator.validateAll().then((result) => {
                if (result) {
                  return;
                }
                // alert('Correct them errors!');
            });
        },      

    	getMatchs() {
    		var urlMatchs = 'partidos';
			axios.get(urlMatchs).then(response => {
				this.matchs = response.data;
			})
			.catch(e => {
				console.log(e);
			});
    	},

    	detailMatch(match) {
    		console.log(match);
            this.apuesta = '';
            this.errors.clear();
    		this.auxMatch = match;
    	},

    	savaMatch() {
    		var urlSaveMatch = ''; 
            this.validateBeforeSubmit()
    		
            console.log(this.apuesta);

            if(!this.apuesta) { 
                this.errorsForm.apuesta = "Valor requerido";
            }else {
                this.errorsForm.apuesta = "Hooa mundos";
            }

    		this.matchUser = this.auxMatch;
    		this.matchUser.valor = this.apuesta
    		this.matchUser.valor_ganado = this.totalGanancia;

    		console.log(this.matchUser);

   //  		axios.post(urlSaveMatch).then(response => {
			// 	//this.match = response.data;
			// })
			// .catch(e => {
			// 	console.log(e);
			// });
    	},

        imageUrl(url) {
            return 'url("'+ url + '")';
        },
    }

});


require('./framy');
require('./functions');
require('./modal');
require('./sweetalert');









