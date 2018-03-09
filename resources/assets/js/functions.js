var buttonFiltros = document.querySelector("#buttonFiltros");
var nav =  document.querySelector("#nav");

if(buttonFiltros && nav) {
	
	buttonFiltros.onclick =  function () {
		nav.classList.toggle('show');
		$('#overlay').fadeToggle(200);
	}

	$("#overlay").click(function() {
		nav.classList.toggle('show');		
		$('#overlay').fadeToggle(200);
	});
}

var cerrarModal = document.querySelector("#cerrarModal");

if(cerrarModal) {

	cerrarModal.onclick =  function() {
		nav.classList.remove('show');
		$('#overlay').fadeToggle(200);
	}
}

// Seleccion de equipos
$(".img-check").click(function(){
	//console.log("hola mundos");
	$(".img-check").removeClass("check");
	$(this).addClass("check");
});

// Etiquetas de busqueda
$('#filterSelectHoy').click(function() {
	
	if( $(this).hasClass('check') ) {
		$(this).removeClass("check");		
		return false;
	}else {
		$(".filter__tags__item").removeClass("check");
		$(this).addClass("check");	
		return false; 
	}
	// 	return true; 
});


var $loaderLink = document.querySelector(".loaderLink");

$('.form').on('submit', function() {
    if (this.checkValidity() == false) {
        return false;
    }else {
    	if ($loaderLink) {	  
    		
	    	$loaderLink.classList.add("disabled");
	    	$loaderLink.innerHTML = " Cargando ...";
	    	$loaderLink.disabled = true;
		}
    }
});

function copiarLink() {
  var copyText = document.getElementById("inputLinkCompartir");
  copyText.select();
  document.execCommand("Copy");
}

$('#buttonCompartir').click(function() {
	copiarLink();
});


// Dropdown User

$('#dropdownUser').click(function(event){
	event.stopImmediatePropagation();
    document.getElementById("myDropdown").classList.toggle("show");	
})

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


// Preview de imagen en perfil
var inputImageProfile = document.querySelector("#inputImageProfile");

if (inputImageProfile) {
	inputImageProfile.onchange = function preview_image(event) {
		var reader = new FileReader();
	 	reader.onload = function(){
		  var output = document.querySelector('.profile__image--preview');
		  output.src = reader.result;
	 	}
	 	reader.readAsDataURL(event.target.files[0]);
	}
}


// Funcion en modal agregar credito
$('input[name=creditoAgregar]').change(function() {
	//$("#agregarOtroValor").value('');

	if(this.value == 'valor') {
		$("#agregarOtroValor").attr('disabled', false);		
	}else {
		$("#agregarOtroValor").attr('disabled', true);
		$("#agregarOtroValor").val('')
	}

});

var myElement = document.getElementById('app');

//var mc = new Hammer(myElement, {touchAction:"pan-y" } );

// mc.get('pan').set({
//   direction: Hammer.DIRECTION_HORIZONTAL,
//   threshold: 100, 
//   velocity:0.1
// });

// // Eventos Swipe 
// mc.on("panright panleft", function(ev) {

// 	ev.preventDefault();
//     if(ev.type == 'panright' && !nav.classList.contains('show') ){
//     	console.log("hola swipe right");
//     	nav.classList.toggle('show');
// 		$('#overlay').fadeIn(200);	
//     }

//     if(ev.type == 'panleft' && nav.classList.contains('show') ){
//     	console.log("hola swipe left");
//     	nav.classList.toggle('show');		
// 		$('#overlay').fadeOut(200);
//     }

// });











