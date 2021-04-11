$(document).ready(function(){
	$(document).on('click', '.editarcom', function(){
		var id=$(this).val();
		var com=$('#comtxt'+id).text();

		$('#editar').modal('show');
		$('#eidc').val(id);
		$('#ecom').val(com);
	});
});