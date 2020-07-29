const URL_API = "http://localhost:8000/api";


$(".numerosConDecimal").on("input", function(){
	this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
});

$(".numerosSinDecimal").on("input", function(){
	this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');
});




function mostrarModalCargando(mostrar){
	if(mostrar){
		$("#modalCargando").modal("show");
	}
	else{
		$("#modalCargando").modal("hide");
	}
}

function mostrarToastr(mensaje, tipo, titulo = "Atención"){
	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: 'slideDown',
		timeOut: 4000
	};
	switch(tipo){
		case "error":
			toastr.error(mensaje, titulo);
			break;
		
		default:
			toastr.success(mensaje, titulo);
			break;
	}
}