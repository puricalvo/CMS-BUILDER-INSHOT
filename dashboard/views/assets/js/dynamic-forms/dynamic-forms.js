/*=============================================
Actualizar la matriz del select
=============================================*/

$(document).on("change",".changeSelectType",function(){

	var matrix_column = $(this).val();
	var id_column = $(this).attr("idColumn");
	var title_column = $(this).attr("titleColumn");
	var pre_value = $(this).attr("preValue");
	
	var data = new FormData();
	data.append("matrix_column",matrix_column);
	data.append("id_column",id_column);
	data.append("pre_value",pre_value);
	data.append("token", localStorage.getItem("tokenAdmin"));

	$.ajax({
		url:"/ajax/dynamic-forms.ajax.php",
		method: "POST",
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		success: function (response){

			$("#"+title_column).html(response);
			
		}

	})

})

/*=============================================
Adicionar un nuevo objeto
=============================================*/

$(document).on("click",".addObject",function(){

	var itemObjectLength = $(".itemObject").length;
	
	$(".itemsObject:last").append($(".itemsObject .itemObject:first")[0].outerHTML.replace(/_0/g, "_"+itemObjectLength));

})


/*=============================================
Quitar un objeto
=============================================*/

$(document).on("click",".removeObject",function(){

	if($(this).attr("position") == "_0"){

		fncToastr("error", "Debe existir un item de objeto");

		return;
	}

	$(this).parent().parent().parent().remove();

	changeItemObject();

})

/*=============================================
Cuando ingresamos datos al objeto
=============================================*/

$(document).on("change",".changeItemObject",function(){

	changeItemObject();

})

/*=============================================
Función cuando cambia el objeto
=============================================*/

function changeItemObject(){

	var propertyObject = $(".propertyObject");
	var valueObject = $(".valueObject");

	var object = '{';

	propertyObject.each((i)=>{

		object +='"'+ $(propertyObject[i]).val()+'":"'+$(valueObject[i]).val().replace(/"/g,'\\"')+'",';
		
	})

	object = object.slice(0, -1);
	object += '}';
	
	$("#"+$(propertyObject[0]).attr("titleColumn")).val(object);
}

/*=============================================
Adicionar un nuevo item para el json
=============================================*/

$(document).on("click",".addJson",function(){

	var itemJsonLength = $(".itemJson").length;
	
	$(".itemsJson").append($(".itemsJson .itemJson:first")[0].outerHTML.replace(/_0/g, "_"+itemJsonLength));

})

/*=============================================
Quitar un objeto
=============================================*/

$(document).on("click",".removeJson",function(){

	if($(this).attr("position") == "_0"){

		fncToastr("error", "Debe existir un item de objeto");

		return;
	}

	$(this).parent().parent().parent().remove();

	changeItemJson();

})

/*=============================================
Cuando ingresamos datos al Json
=============================================*/

$(document).on("change",".changeItemJson",function(){

	changeItemJson();

})

/*=============================================
Adicionar un grupo de objetos
=============================================*/

$(document).on("click",".addJsonGroup",function(){

	var jsonGroupLength = $(".jsonGroup").length;

	$(".jsonGroup:last").after($(".jsonGroup:first")[0].outerHTML.replace(/0_/g, jsonGroupLength+"_"));

})

/*=============================================
Remover un grupo de objetos
=============================================*/
$(document).on("click",".removeJsonGroup",function(){

	if($(".jsonGroup").length == 1){

		fncToastr("error", "Debe existir un grupo de objetos");

		return;

	}

	$(this).parent().remove();

	changeItemJson();

})

/*=============================================
Función cuando cambia el Json
=============================================*/

function changeItemJson(){

	var jsonGroup = $(".jsonGroup");

	var jSon = '[';

	jsonGroup.each((f)=>{

		var propertyJson = $("."+$(jsonGroup[f]).attr("position")+"propertyJson");
		var valueJson = $("."+$(jsonGroup[f]).attr("position")+"valueJson");

		jSon += '{';

		propertyJson.each((i)=>{

			jSon +='"'+$(propertyJson[i]).val()+'":"'+$(valueJson[i]).val().replace(/"/g,'\\"')+'",';
			
		})

		jSon = jSon.slice(0, -1);
		jSon += '},';

	})

	jSon = jSon.slice(0, -1);
	jSon += ']';
	
	$("#"+$(jsonGroup[0]).attr("titleColumn")).val(jSon);
}

/*=============================================
Abrir ventana modal de archivos
=============================================*/

$(document).on("click",".myFiles",function(){

	$("#myFiles").modal("show");

	var input = $(this).parent().find("input");

	$("#myFiles").on('shown.bs.modal', function () {

		$(".modal-body").find(".copyLink").append().html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5M8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6"/>
</svg> `)


		$(document).on("click",".copyLink",function(){

			$(input).val($(this).attr("copy"));

			$("#myFiles").modal("hide");

		})
	})
})

/*=============================================
Cambiar la tabla de Relaciones
=============================================*/

$(document).on("change",".changeRelations",function(){

	$(".selectRelations").html('');

	var table = $(this).val();
	var id_column = $(this).attr("idColumn");

	var data = new FormData();
	data.append("table",table);
	data.append("id_column",id_column);
	data.append("token", localStorage.getItem("tokenAdmin"));

	$.ajax({
		url:"/ajax/dynamic-forms.ajax.php",
		method: "POST",
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		success: function (response){

			if( JSON.parse(response).length > 0){

				JSON.parse(response).forEach((e,i)=>{

					$(".selectRelations").append(`

						<option value="${Object.values(e)[0]}">${Object.values(e)[0]} - ${Object.values(e)[1]}</option>
						
					`)
				
				})

			}

		}

	})

})