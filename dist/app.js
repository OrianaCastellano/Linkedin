$(document).ready(function(){
	$(document).on('click', '.envio_reac', function(){
		id=$(this).val();
		var idp=$('#codpost'+id).text();
		var idu=$('#iduser'+id).text();
		var user=new Users(idp, idu, "assets/PHP/insert.php");
		user.AddUser();
	});
});

function Users(idp, idu, action){
	this.action=action;
	this.idp=idp;
	this.idu=idu;
}
Users.prototype.AddUser=function(){
	$.ajax({
		type: "POST",
		url:this.action,
		data:{idp:this.idp, idu:this.idu},
		success:function(response){
		}
	});
}