window.$ = window.jQuery = require('jquery');


// Vue 
require('./bootstrap');

window.Vue = require('vue');


import VueCurrencyFilter from 'vue-currency-filter';

Vue.use(VueCurrencyFilter, 
{
  symbol : '$', 
  thousandsSeparator: ',',
  fractionCount: 0,
  fractionSeparator: ',',
  symbolPosition: 'front',
  symbolSpacing: false
});

//Vue.component('example', require('./components/ExampleComponent.vue'));

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

    	matchUser: {}

    },

    created() {
    	this.getMatchs();
    },

    computed:{
	 	totalGanancia() {
	 		var porcentajeParti2 = (this.apuesta * 2 / 100) * this.retencion_parti2;
	    	return (this.apuesta * 2) - porcentajeParti2;
	    },

	    filteredMatch:function() {
			var self=this;
			return this.matchs.filter(function(match){
	        	return match.homeTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 || match.awayTeamName.toLowerCase().indexOf(self.search.toLowerCase())>=0 ;
	      	});
	    },

    },

    methods: {

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
    		this.auxMatch = match;
    	},

    	savaMatch() {
    		var urlSaveMatch = ''; 
    		
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







