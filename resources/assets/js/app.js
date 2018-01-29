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
        checkedLigas: [],
        searchDate:'',

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

	    filteredMatch(){
            
            //console.log(this.searchDate);

			var self=this;
            if (!this.checkedLigas.length){
                return this.matchs
                .filter(match => match.homeTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 || match.awayTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 )
                .filter(match => match.date.slice(0,10).indexOf(self.searchDate)>=0)
            }
            
			return this.matchs
                .filter(match => match.homeTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 || match.awayTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 )
                .filter(match => self.checkedLigas.includes(match.league))
                .filter(match => match.date.slice(0,10).indexOf(self.searchDate)>=0)

                // .filter(function(match) {
                //     //console.log(match.date.slice(0,10));
                //      //console.log(self.searchDate);

                //      match.date.slice(0,10) == self.searchDate
                // })
                    //.filter(match => match.date.slice(0,10).indexOf(self.searchDate)>=0 );


                // .filter(function(match) {
                //     console.log(self.checkedLigas);
                //     if (!self.checkedLigas.length){
                //         return self.matchs
                //     }
                //     self.checkedLigas.includes(match.league)
                // });  
            
            // if (!self.checkedLigas.length){
            //     return this.matchs
            // }
            
	    },

        // filteredLigas(){
        //     console.log(this.checkedLigas);
        //     if (!this.checkedLigas.length){
        //         return this.matchs
        //     }
        //     return this.matchs.filter(j => this.checkedLigas.includes(j.league))
        // }

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









