 $("#userContent").hide();
 $("#emailContent").hide();
 $("#show_content").click(function(){

     $("#userContent").show();
	 $("#userHide").hide();
	 
 });
 
 
$('#userHide').dblclick(function(){
	
	 $(this).hide();
	 $("#userContent").show(function(){
		 $(this).append($('#chargeChamp').show());
	 });
 
 });

$('#emailHide').dblclick(function(){
	
	 $(this).hide();
	 $("#emailContent").show(function(){
		 $(this).append($('#chargeChamp').show());
	 });

});

//function changerContent(#emailHide=element1,#emailContent=element2,currentElement){
/* 
function changerContent(element1,element2){
	var btn_modif_name=$(this).text();

	var iconE= "<i class='fa fa-times fa-2x' aria-hidden='true'></i>";
	
	var test=$(element1).is(":visible");

	if(test){
	 $(this).html(iconE);

	 		$(element1).hide();
	 		$(element2).show(function(){
	 			$(this).append($('#chargeChamp').show());
	 			test=false;
	 		});
	}else{
		 $(this).html(btn_modif_name);

	 		$(element1).show();
	 		$(element2).hide();
	 		var test=true;

	};
};


var emailHide=	 $('#emailHide').hide();
var emailContent= $("#emailContent").show(function(){
	 $(this).append($('#chargeChamp').show());
	
}); */

var btn_modif_name= $("#show_email_content").text();
var iconE= "<i class='fa fa-times fa-2x' aria-hidden='true'></i>";

$('#show_email_content,#emailHide').click(function(){

	var test=$('#emailHide').is(":visible");
	if(test){
	 $("#show_email_content").html(iconE);

	 		$('#emailHide').hide();
	 		$("#emailContent").show(function(){
	 			$(this).append($('#chargeChamp').show());
	 			test=false;

	 		});
	}else{
		 $("#show_email_content").html(btn_modif_name);

	 		$('#emailHide').show();
	 		$("#emailContent").hide();
	 		var test=true;

	};
});

$('#show_user_content,#userHide').click(function(){

	var test=$('#userHide').is(":visible");
	if(test){
	 $("#show_user_content").html(iconE);

	 		$('#userHide').hide();
	 		$("#userContent").show(function(){
	 			$(this).append($('#chargeChamp').show());
	 			test=false;

	 		});
	}else{
		 $("#show_user_content").html(btn_modif_name);

	 		$('#userHide').show();
	 		$("#userContent").hide();
	 		var test=true;

	};
});
//hello