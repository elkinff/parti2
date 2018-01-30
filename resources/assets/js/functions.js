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

//var $loaderLink = document.querySelector(".loaderLink");

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





