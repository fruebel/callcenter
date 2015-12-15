<form action="insertausuario" method="post" id="fdatos" name="fdatos">
	<input  type="text" id="userid" name="userid" class="form-control {required:true, maxlength:30}" placeholder="userid"  value="" />
	<input  type="text" id="nombre" name="nombre" class="form-control {required:true, maxlength:30}" placeholder="nombre"  value="" />
	<input type="submit" class="btn btn-primary" id="btnenvia" value="Registrar" />
</form>

<br>

<span id="ver">ver contenido </span>


<div class="contenido-principal"  >

    <table id="tablainfo" class="table table-striped table-bordered" cellspacing="0" width="100%">
    </table>

</div>


<script type="text/javascript">
	$('#fdatos').on('submit',function (e) {
        // body...

        e.preventDefault();

        var pet = $('#fdatos').attr('action');
        var met = $('#fdatos').attr('method');

       
        $.ajax({
            beforeSend : function  () {
                // body...
                //$('#notificacion').html("Cargando Info...");
            },
            url : pet,
            type : met,
            data : $('#fdatos').serialize(),
            async:false,
            error : function  (jqXHR , estado , error) {
                // body...
                //alert('Se produjo un error : ' + error + " su estado " + estado);
                
            },
            success : function  (respuesta) {
                // body...
                alert(respuesta);                
                //$('#usuario').focus();
                $('#ver').click();
                
            },
            complete : function (xhr, status) {
                              

                              
            }
        });
       

    });

	$('#ver').on('click',function(e){

e.preventDefault();		

   $.ajax({

                beforeSend:function () {
                    // body...
                },
                url:'contenido',
                type:'POST',
                async : false,
                data:"",
                error: function (jqXHR, textStatus, errorThrown) {
                    // body...
                    alert('Se produjo un error : ' + errorThrown + ' '+ textStatus);
                },
                success: function (tabla) {
                    // body...                   
                      $('#tablainfo').html(tabla);                   
                    
                },
                complete: function (xhr, status){

                    $('#tablainfo').dataTable().fnDestroy();    
                    $('#tablainfo').DataTable({                    
                        "language": {                 
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        }
                    });
                }
        });

	})

     
    



</script>

