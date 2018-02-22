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

inputImageProfile.onchange = function preview_image(event) {
	var reader = new FileReader();
 	reader.onload = function(){
	  var output = document.querySelector('.profile__image--preview');
	  output.src = reader.result;
 	}
 	reader.readAsDataURL(event.target.files[0]);
}








