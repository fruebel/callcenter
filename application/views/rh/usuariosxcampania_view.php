
<div class="container"  style="height: 600px; margin-top:60px;" >



    <div class="row">

        <div class="col-md-12 col-md-offset-4" >
            <h3>Reporte de Usuarios x Campaña</h3>
        </div>

    </div>

    <hr/>

    <div class="row">

        <div class="col-md-1" >
            <center>Campaña</center>
        </div>

        <div class="col-md-3" >
            <select id="cbo_campania" name="cbo_campania" class="form-control" required></select>
        </div>

    </div>    

    <br>

    <div class="row">

        <div class="col-md-1" >
            <center>Supervisor</center>
        </div>

        <div class="col-md-3" >
            <select id="cbo_supervisor" name="cbo_supervisor" class="form-control" required></select>
        </div>

    </div> 

    <br>

    <div class="row">

        <div class="col-md-1" >
            <center>Turno</center>
        </div>

        <div class="col-md-3" >
            <select id="cbo_turno" name="cbo_turno" class="form-control" required></select>
        </div>

    </div>     



    <div class="row">

        <div class="col-md-12">

            <table id="tablainfo" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%" data-page-length='50' data-search="1">
            </table>

        </div>

    </div>

</div>

<!-- Mensajes -->
<div hidden id="mensaje" name="mensaje"> </div>

<!--****************************************************************************************************************************************-->
<!--*****************************************************Conf Predeterminada ***************************************************************-->
<!--****************************************************************************************************************************************-->
<script type="text/javascript">
    //ocultar menu lateral	
    $( ".contenido-principal" ).click(function() {    				
    	classie.remove( document.body, 'cbp-spmenu-push-toright' );
    	classie.remove( menuLeft, 'cbp-spmenu-open' );		
    });	

    $('#mensaje').qtip({
        content: {
            title:'Registro',
            text: 'El registro se realizo exitosamente.',
            button: true
        },
        /*show: 'click',*/
        show: {
                event: 'click',
                modal: {
                    on: true, // Make it modal (darken the rest of the page)...
                    blur: true, // ... but don't close the tooltip when clicked
                    escape: true
                }
            },
        hide: {
            event: false,
            inactive: 1500
        },
        style: {
            classes: 'qtip-tipped qtip-modal'
        },
        position: {
            target: $(window),
            my: 'center center',  
            at: 'center center'
        }
    });  


    $('#btn-agregar').on('click',function (){
        $('#fdatos').attr('action','usuarios_altas');
        $('#btnenvia').attr('value','Registrar');
        $('#idRow').val(0);

        $.ajax({
            url:"usuarios_menu",
            type:"POST",
            data:"id="+$('#idRow').val()+"&accion=&rnd="+Math.random(),
            success: function(data){
                $("#mSeguridad").html(data);
            } 
        });  

        //arma opciones campanias
        $.ajax({
            url:"tablaCampaniasxUsuario",
            type:"POST",
            dataType: "json",
            data:"id="+$('#idRow').val()+"&accion="+$('#accion').val(),
            success: function(data){
                $("#tableCampanias").html(data.contenido);
                $("#noCampanias").val(data.noCampanias);
            } 
        });        

    });
   
    
   //limpiar formulario modal
    $('#fmodal').on('hide.bs.modal', function (e) {
        $(this).find('.modal-body').find('input').val('');
        $(this).find('.modal-body').find('select').val('');
        $('#campos_reporte').html('');
        $('#listaReportes').html('');
        $('#btnGuardarCambios').fadeOut();
    }); 

    $('#breadcrumb').html('<li>Assets</li><li>Recursos</li><li class="active">Usuarios</li>');

</script>


<!--****************************************************************************************************************************************-->
<!--*****************************************************Fin conf Predeterminada************************************************************-->
<!--****************************************************************************************************************************************-->




<script type="text/javascript">
    
    var camposPorReporte = {};
    /*Listas*/
    lista_f('usrplazas','u_plaza','plaza','','cpo_plazas');
    lista_f('usrpuestos','u_puesto','puesto','','cbo_puesto');
    lista_f('s_usuarios','userid','nombre','u_status = 1 and u_puesto = 2 and u_plaza=<?php echo $_SESSION["u_plaza"];?>','cbo_jefedirecto');
    lista_f('cat_estados',' id_estado','nombre_estado','','cbo_estado');

    $("#fechaalta").datetimepicker();

    
    $( "#accordion" ).accordion({
        heightStyle :"Content",
        collapsible:true
    });


    $('#fdatos').on('submit',function (e) {

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
            dataType :'json',
            error : function  (jqXHR , estado , error) {
                // body...
                //alert('Se produjo un error : ' + error + " su estado " + estado);
                $('#mensaje').qtip('option', 'content.text', 'El registro no pudo realizarce, intente nuevamente.');
                $('#mensaje').click();
            },
            success : function  (respuesta) {
                // body...
                //alert(respuesta.respuesta);                
                //$('#usuario').focus();
                if (respuesta.respuesta == true)
                {
                    $('#fmodal').modal('hide');      
                    pinta_contenido();
                }                    
                $('#mensaje').qtip('option', 'content.text', respuesta.mensaje);
                $('#mensaje').click();

            },
            complete : function (xhr, status) {
                              
            }
        });


    })
    
    $("#comboReportes").change(function(){         
        id_reporte = $("#comboReportes").val();
        console.log('id_reporte:', id_reporte);
        $.ajax({
            url: "listaCamposReporte",
            type: "POST",
            dataType:'json',
            data: 'id_reporte='+id_reporte,
            success: function(data){
                console.log(data);
                
                //array = jQuery.parseJSON(data.contenido);         
                array = (data.contenido);  
                agregarCampos (array); 
                $('#todos_campos').prop('checked', true).change();           
            }, 
            error: function(data)
            {
                console.log(data);
            }
        })
    }); 

    //pinta_contenido();        
    function pinta_contenido(){

        /*console.log(valor);
        if (typeof(valor) == "undefined")
            valor = '';      
        */

        $.ajax({

                beforeSend:function () {
                    // body...
                },
                url:'usuarios_contenido',
                type:'POST',
                async : false,
                data:"valor=",
                error: function (jqXHR, textStatus, errorThrown) {
                    // body...
                    alert('Se produjo un error : ' + errorThrown + ' '+ textStatus);
                },
                success: function (tabla) {
                    // body...
                    //$('#tablainfo').children('tbody').html('');                                                        
                    $('#tablainfo').html(tabla);                                                        
                },
                complete: function (xhr, status){

                    $('#tablainfo').dataTable().fnDestroy();    
                    $('#tablainfo').DataTable({                    
                        "language": {                 
                            "url": "<?php echo base_url();?>assets/json/Spanish.json"
                        }
                    });
                }
        });
    }

    function editar(data){

        var id_row = data.id;
        $('#fdatos').attr('action','usuarios_cambios');
        $('#btnenvia').attr('value','Editar');
        $('#idRow').val(id_row);
            
        $.ajax({

            beforeSend:function () {
                // body...
                //alert('id_row->'+id_row);
            },
            url:'usuarios_consulta',
            type:'POST',
            async : false,
            dataType :'json',
            data:"id_row="+id_row,
            error: function (jqXHR, textStatus, errorThrown) {
                // body...
                alert('Se produjo un error : ' + errorThrown + ' '+ textStatus);
            },
            success: function (data) {
                // body...

                $('#nombre_completo').val(data.contenido.nombre.toUpperCase());
                $('#apaterno').val(data.contenido.apaterno.toUpperCase());
                $('#amaterno').val(data.contenido.amaterno.toUpperCase());
                $('#usuario_f').val(data.contenido.usuario.toUpperCase());                          
                $('#cpo_plazas').val(data.contenido.u_plaza);
                $('#cbo_puesto').val(data.contenido.u_puesto);
                $('#cbo_jefedirecto').val(data.contenido.u_jefedirecto);
                $('#cbo_turno').val(data.contenido.u_turno);
                $('#cbo_estatus_empleado').val(data.contenido.u_status);
                $('#cbo_campania').val(data.contenido.u_campania);
                $('#usuario_f').val(data.contenido.usuario);
                $('#contrasenia').val(data.contenido.contrasenia);
                $('#rfc').val(data.contenido.RFC.toUpperCase());
                $('#imss').val(data.contenido.AfiliacionIMSS.toUpperCase());
                $('#cbo_sexo').val(data.contenido.sexo);
                //alert(data.contenido.u_estadocivil);
                $('#cbo_estado_civil').val(data.contenido.u_estadocivil);
                $('#direccion').val(data.contenido.direccion.toUpperCase());
                $('#colonia').val(data.contenido.colonia.toUpperCase());
                $('#cbo_estado').val(data.contenido.u_estado);
                $('#cp').val(data.contenido.cp);
                $('#lada').val(data.contenido.lada);
                $('#telefono').val(data.contenido.telefono);
                $('#email').val(data.contenido.email.toUpperCase());                                                        
                $('#cuenta').val(data.contenido.cuentabanco);
                $('#curp').val(data.contenido.curp.toUpperCase());
                $('#usuario_banco').val(data.contenido.usuario_banco);
                $('#contrasenia_banco').val(data.contenido.contrasenia_banco);
                $('#cbo_categoria').val(data.contenido.u_CategoriaAgente);
                $('#cbo_puesto').val(data.contenido.u_puesto);
                $('#fechaalta').val(data.contenido.FechaAlta);
                $('#fecha_contratacion').val(data.contenido.FechaContratacion);
                $('#fecha_termino').val(data.contenido.FechaTerminacion);

                $.ajax({
                    url:"tablaCampaniasxUsuario",
                    type:"POST",
                    dataType: "json",
                    data:"id="+$('#idRow').val()+"&accion=editRow",
                    success: function(data){
                        $("#tableCampanias").html(data.contenido);
                        $("#noCampanias").val(data.noCampanias);
                    } 
                });                 

            }

        });

    }
</script>



