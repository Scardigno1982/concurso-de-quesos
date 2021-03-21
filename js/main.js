$(document).ready(function() {
	$('.pasar').click(function() { 
		return !$('#destino option:selected').remove().appendTo('#origen'); 
	});  
	$('.pasar2').click(function() { 
		return !$('#destino2 option:selected').remove().appendTo('#origen2'); 
	});  
	$('#valid').click(function(){ //GRABAR DATOS EN JURADO
		var mesa = $('#post_mesa').val();
		var quesos = "";
		var jurados = "";
		$('#origen2 :selected').each(function(i,selected){
			quesos = ""+quesos+$(selected).text()+"\n";	
		});
		$('#origen1 :selected').each(function(i,selected){
			jurados = ""+jurados+$(selected).text()+"\n";	
		});
		
		var mensaje = "Usted va a asignar a la MESA\n"+mesa+"\n\nQUESOS\n"+quesos+"\nJURADOS\n"+jurados+"\n Esta de acuerdo?\n(Una vez Creado no lo podra modificar)";
		if (confirm(mensaje)){
			$('#formulario').submit();
		}
		else alert('Cambios no aplicados');
	});
	$('#button-one').click(function(){
		//VERIFICA SI SELECCIONO JURADO 
		var seleccionados = $('#origen1 :selected').length;
		if ( seleccionados > 0 ){
			$('#one').slideUp();
			$('#two').slideDown();
		}
		else alert('Debe seleccionar al menos un Queso');
	
	});

	$('#anterior-two').click(function(){
		$('#two').slideUp();
		$('#one').slideDown();
	});

	$('#button-two').click(function(){
		//VERIFICA SI SELECCIONO QUESO
		var seleccionados = $('#origen2 :selected').length;
		if ( seleccionados > 0 ){
			//LLENO EL SELECT CON JURADOS PARA ELEGIR COORDINADOR
			$('#origen1 :selected').each(function(){
				$('#select-coord').append('<option value='+$(this).val()+'>'+$(this).text()+'</option>');
			});
			$('#two').slideUp();
			$('#three').slideDown();
		}
		else alert('Debe seleccionar al menos un Jurado');
	});

	$('#anterior-three').click(function(){
		$('#three').slideUp();
		$('#two').slideDown();
		$('#select-coord').children().remove();
	});


	$("ul.droptrue").sortable({
		connectWith: "ul"
	});
	$("ul.dropfalse").sortable({
		connectWith: "ul",
	});
	$("#sortable1, #sortable2", '#sortable3', '#sortable4').disableSelection();

});
