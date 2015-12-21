
$( document ).ready(function() {	
    var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
});


//lista_f(tabla SQL,id_campo,texto_campo,where,elemento_html)
function lista_f(tabla,id,texto,where,elemento){

	var lista;

	 $.ajax({
	        beforeSend: function (){
	        },
	        url:'lista',
	        type:'POST',
	        async:false,
	        data:'tabla='+tabla+'&id='+id+'&texto='+texto+'&where='+where,
	        error: function (response){
	            alert('Se produjo un error : ');
	            console.log('error combos->', response);
	        },
	        success: function (data){	        		        	
	            lista =  data;
	            $('#'+elemento).html(lista);
	        }
	    })

	 return lista;
} 

function lista_vehiculos(elemento,modulo){

	var lista;

	 $.ajax({
	        beforeSend: function (){
	        },
	        url:'listavehiculos',
	        type:'POST',
	        async:false,
	        data:'modulo='+modulo,
	        error: function (jqXHR, textStatus, errorThrown){
	            alert('Se produjo un error : ' + errorThrown + ' '+ textStatus);
	        },
	        success: function (data){	        	
	            $('#'+elemento).html(data);
	            lista = data;
	        }
	    })

	return lista;

}

function ponerBreadcrumb(opc, titulo)
{
  //titulo = MayusPrimera(titulo);

  if(opc == 'limpiar')
  {    
    contenido = '<li>'+titulo+'</li>';
    contenido += '<li></li>';          
   
    $('#breadcrumb').html(contenido);
    
  }
  else if(opc == 'medio')
  {
    $("#breadcrumb li:nth-child(2)").html(titulo);
    if($("#breadcrumb li:nth-child(3)").length == 0)      	
  		$( "#breadcrumb li:nth-child(3)" ).append('<li></li>')
    else
      	$("#breadcrumb li:nth-child(3)").html('');
  }
  else if(opc == 'ultimo')
  {
    $("#breadcrumb li:nth-child(3)").html(titulo);
  }
}

function MayusPrimera(string)
{ 
  string = string.toLowerCase();
  string = string.charAt(0).toUpperCase() + string.slice(1); 
  console.log(string);
  
  return string.charAt(0).toUpperCase() + string.slice(1);
}

