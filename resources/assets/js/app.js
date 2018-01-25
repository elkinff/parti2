window.$ = window.jQuery = require('jquery');


// Vue 
require('./bootstrap');

window.Vue = require('vue');

//Vue.component('example', require('./components/ExampleComponent.vue'));

// Vista de publicar
const app = new Vue({
    el: '#app',

    data: {
    	fecha : '',

    	id_visitante: '',
    	id_local: '',

    	nombre_visitante: '',
    	nombre_local: '',
    	
    	escudo_local:'',
    	escudo_visitante: '',
    	
    	id_liga:'',

    	matchs: [],
    	auxMatch: {},

    },

    created() {
    	this.getMatchs();
    },

    computed:{

	    filteredMatch:function() {
			var self=this;
			return this.shop.filter(function(match){
	        	return match.nombre_item.toLowerCase().indexOf(self.search.toLowerCase())>=0;
	      	});
	    }
    },

    methods: {
    	getMatchs: function() {
    		var urlMatchs = 'partidos';
			axios.get(urlMatchs).then(response => {
				this.matchs = response.data;
				console.log(this.matchs);
			})
			.catch(e => {
				console.log(e);
			});
    	},

    	savaMatch: function() {
    		var urlSaveMatch = ''; 
    		axios.post(urlSaveMatch).then(response => {
				//this.match = response.data;
			})
			.catch(e => {
				console.log(e);
			});
    	}
    }

});


