$(document).ready(function(){
	$(document).on('click', '.editarpost', function(){
		var id=$(this).val();
		var com=$('#comtxt'+id).text();
		var img=$('#img'+id).text();

		$('#editarp').modal('show');
		$('#codp').val(id);
		$('#detp').val(com);
		$('#img_ant').val(img);
	});
});