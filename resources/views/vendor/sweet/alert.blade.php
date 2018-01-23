@if (Session::has('sweet_alert.alert'))
    <script>
        swal({
            text: "{!! Session::pull('sweet_alert.text') !!}",
            title: "{!! Session::pull('sweet_alert.title') !!}",
            icon: "{!! Session::pull('sweet_alert.type') !!}",
            showConfirmButton: "{!! Session::pull('sweet_alert.showConfirmButton') !!}",
            confirmButtonText: "{!! Session::pull('sweet_alert.confirmButtonText') !!}",
            confirmButtonColor: "#355C7D",
            // more options
            button: {
            	text: "Aceptar",
            	className: "btn",
            }
        });
    </script>
@endif