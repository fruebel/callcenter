
<br> <br> <br> <br>

<div class="row">

    <div class="col-md-12">Usuarios</div>

</div>

<div class="contenido-principal"  style="height: 600px;" >

    <table id="tablainfo" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%" data-page-length='100' data-search="1">
    </table>

</div>

<!-- Mensajes -->
<div hidden id="mensaje" name="mensaje"> </div>


<!-- Modal -->
<form action="" method="post" id="fdatos" name="fdatos">
    <div class="modal fade" id="fmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Usuarios</h4>
          </div>

          <div class="modal-body">
           
                <fieldset id="ocultos" style="border:none">
                    <input type="hidden" id="accion" class="" name="accion" />                               
                    <input type="hidden" id="idRow" class="" name="idRow" value="0" />
                </fieldset>
                
                <div id="accordion">
                    <h3>Usuario</h3>
                    <div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">

                                <div class="col-md-6">
                                    
                                    <div class="row">                            
                                        <div class="col-md-3">Nombre</div>
                                        <div class="col-md-9"><input type="text" id="nombre_completo" name="nombre_completo" class="form-control"  value="" placeholder="Nombre" required/></div>
                                    </div>    
                                    
                                    <div class="row">
                                        <div class="col-md-3">Usuario</div>
                                        <div class="col-md-9"><input type="text" id="usuario_f" name="usuario_f" class="form-control"  value="" placeholder="Usuario" required/></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">Contraseña</div>
                                        <div class="col-md-9"><input type="text" id="contrasenia" name="contrasenia" class="form-control"  value="" placeholder="Contraseña" required/></div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-3">Dirección</div>
                                        <div class="col-md-9"><input type="text" id="direccion" name="direccion" class="form-control"  value="" placeholder="Dirección" required/></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">Ciudad</div>
                                        <div class="col-md-9"><input type="text" id="ciudad" name="ciudad" class="form-control"  value="" placeholder="Ciudad" required/></div>
                                    </div>                                    
                                    
                                    <div class="row">
                                        <div class="col-md-3">Codigo Postal</div>
                                        <div class="col-md-9"><input type="text" id="cp" name="cp" class="form-control"  value="" placeholder="Codigo Postal" required/></div>
                                    </div>                                    

                                    <div class="row">
                                        <div class="col-md-3">Telefono</div>
                                        <div class="col-md-9"><input type="text" id="telefono" name="telefono" class="form-control"  value="" placeholder="Telefono" required/></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">Email</div>
                                        <div class="col-md-9"><input type="text" id="email" name="email" class="form-control"  value="" placeholder="Email" required/></div>
                                    </div>   

                                    <div class="row">
                                        <div class="col-md-3">Usuario Bloqueado</div>
                                        <div class="col-md-9">
                                        <select id="activo" name="activo" required class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="1">No</option>
                                            <option value="2">Si</option> 
                                        </select>
                                        </div>
                                    </div> 

                                </div>

                                <div class="col-md-6">
                                    <h4><center>Menu de Seguridad</center></h4>
                                    <hr>
                                    <div id="mSeguridad" style="width:97%;overflow-y:auto;height:470px;">
                                    </div> 

                                </div>
                                </div>
                            </div>                 
                        </div>            
                    </div>    
                    <h3>Reportes</h3>
                    <div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <label style="float:left; margin-right: 20px; line-height: 35px;">Reporte: </label> 
                                    
                                        <select id="comboReportes" name="comboReportes" class="form-control" style="float:left; width: 200px; margin-right: 20px;">
                                        </select>
                                    
                                        <div id="btnAgregarReporte" class="btn btn-primary" style="float:left; ">Agregar Reporte</div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div id="campos_reporte" style="height: auto; min-height: 170px; margin-top: 20px; float:left; font-size: 12px;">
                                        </div>
                                    </div>
                                        
                                     <div class="col-md-12">
                                        <div id="btnGuardarCambios" class="btn btn-primary" style="display:none;">Actualizar lista</div>             
                                        
                                        
                                        <div id="listaReportes" style="margin-top: 30px; border:solid gray 1px; border-radius: 5px; padding: 10px; margin-bottom: 20px;">
                                        </div>

                                        <fieldset id="" style="border:none; text-align:center;">
                                            <p id="mensaje" name="mensaje"> </p>
                                            <div id="" class="btn btn-primary" onclick="rwCamposPorReporte();">Registrar </div>
                                        </fieldset>
                                     </div>   
                                                                            

                                </div>
                            </div>
                        </div>
                    </div>

                </div>                                 
          </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input  type="submit" class="btn btn-primary" id="btnenvia" value="Registrar" />
            </div>      

        </div>
      </div>
    </div>
</form>


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
    //lista_f('reportes','id_reporte','nombre','','comboReportes');
    
    
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

    $('#btnAgregarReporte').on('click',function()
    {
        reporte = $("#comboReportes option:selected").html();
        id_reporte = $("#comboReportes option:selected").val();

        console.log('id_reporte', id_reporte);
        if(id_reporte != '')
        {
            campos = {};
            lista_campos = '<div style="width: 200px;">';               
            $('.lista_campos:checked').each(function () {
                lista_campos += $(this).val().split('-')[2] +"<br/> ";
                id_campo = $(this).attr('id').split('-')[1];                
                campos[id_campo] =  id_campo ;
            });         
            lista_campos += '</div>';

            agregarReporte (reporte, id_reporte, lista_campos, campos);
        }
        else
            $("#comboReportes").focus();
            
    });

    $('#btnGuardarCambios').on('click',function()
        {
            reporte = $("#comboReportes option:selected").html();
            id_reporte = $("#comboReportes option:selected").val();

            console.log('id_reporte', id_reporte);
            if(id_reporte != '')
            {
                campos = {};
                lista_campos = '<div style="width: 200px;">';               
                $('.lista_campos:checked').each(function () {
                    lista_campos += $(this).val().split('-')[2] +"<br/> ";
                    id_campo = $(this).attr('id').split('-')[1];                
                    campos[id_campo] =  id_campo ;
                });         
                lista_campos += '</div>';

                agregarReporte (reporte, id_reporte, lista_campos, campos);
                $('#mensaje').qtip('option', 'content.text', 'Lista actualizada.');
                $('#mensaje').click();
            }
            else
                $("#comboReportes").focus();                
        });
    
    pinta_contenido();        
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
                $('#nombre_completo').val(data.contenido.nombre_completo);
                $('#usuario_f').val(data.contenido.usuario);
                $('#contrasenia').val(data.contenido.contrasenia);
                $('#direccion').val(data.contenido.direccion);
                $('#ciudad').val(data.contenido.ciudad);
                $('#cp').val(data.contenido.cp);
                $('#telefono').val(data.contenido.telefono);
                $('#email').val(data.contenido.email);
                $('#activo').val(data.contenido.activo);

            }

        });


        $.ajax({
            url:"usuarios_menu",
            type:"POST",
            data:"id="+$('#idRow').val()+"&accion=editRow&rnd="+Math.random(),
            success: function(data){
                $("#mSeguridad").html(data);
            } 
        }); 

        $.ajax({
            url:"listaCamposUsuario",
            type:"POST",
            dataType:'json',
            data:' idUsuario='+ id_row,
            success: function(data){
                /*array = data.contenido; 
                agregarCampos (array);*/ 
                console.log('campos por usuario',data); 
                if(data.respuesta)
                {
                    //contenido = jQuery.parseJSON(data.contenido);
                    contenido = data.contenido;
                    arrayReporte = contenido.reportes;
                    arrayCamposXReporte = contenido.campos;
                    arrayListaCampos = {};
                    arrayCampos = {};
                    campos = {};                                                
                        
                    for(key in arrayCamposXReporte)
                    {                                       
                        lista_campos = '<div style="width: 200px;">';
                        for(key2 in arrayCamposXReporte[key])
                        {
                            if(arrayCamposXReporte[key][key2].checked == 1)
                            {                                       
                                lista_campos += arrayCamposXReporte[key][key2].alias +"<br/> ";
                                id_campo = arrayCamposXReporte[key][key2].id_campo;             
                                campos[id_campo] = id_campo;
                            }                                   

                        }                           
                                
                        lista_campos += '</div>';
                        //console.log('lista_campos',arrayCamposXReporte[key]);
                        arrayListaCampos[key] = lista_campos;
                        arrayCampos[key] = campos;
                        //agregarCampos(arrayCamposXReporte[key]);
                        setTimeout(function() {                             
                        }, 200);
                    }

                    for (i=0; i< arrayReporte.length; i++)
                    {                                               
                        id_reporte = arrayReporte[i].id_reporte;
                        agregarReporte (arrayReporte[i].nombre, arrayReporte[i].id_reporte, arrayListaCampos[id_reporte], arrayCampos[id_reporte]);
                        //console.log(arrayCampos[id_reporte]); 
                        setTimeout(function() {                             
                        }, 200);                        
                    }
                }
                
                  
                
            },
            error:function(response){
                console.log(response);
            } 
        });


    }
     
    
    function agregarCampos (arrayCampos) {
        array = arrayCampos;
        console.log(arrayCampos);
        campo = '<span style="margin-left:20px;">Selecionar todos los campos del reporte:</span> <input type="checkbox" checked = "checked" id="todos_campos" name="todos_campos" value="" class="" style="margin-bottom:20px "/><br />';
        i = 0;
        contador = 0;
        for (key in array)
        {
            i++;
            if( i == 1)
                campo += '<div style="float:left; padding-bottom: 10px; padding-right: 20px;">';
            cheked = (array[key].checked == 1) ? "checked = checked" : ''; 
            campo += '<input type="checkbox" '+cheked+' id="opc-'+ array[key].id_campo +'" name="opc-'+ array[key].id_campo +'" value="opc-'+ array[key].campo +'-'+array[key].alias+'" class="lista_campos"/>' + array[key].alias + '<br />';  
            
            if( i % 5 == 0)//agrupar de 5 en 5
            {
                campo += '</div>';                      
                i = 0;                      
            }

            contador++;
        }

        $('#campos_reporte').html(campo);

        $('.lista_campos').change(function () {
                todos_seleccionados = false;

                $('.lista_campos').each(function (){
                 if (this.checked)  
                    todos_seleccionados = true;
                 else
                 {
                    todos_seleccionados = false;
                    return false;
                 }                      
            });

            if(todos_seleccionados)
                $('#todos_campos').prop('checked', true);
            else
                $('#todos_campos').prop('checked', false);

        });

        $('#todos_campos').change(function(){

            if (this.checked)
            {
                $('.lista_campos').each(function (){

                    $(this).prop('checked', true); 
                    
                });
            }
            else
            {
                $('.lista_campos').each(function (){

                    $(this).prop('checked', false); 
                    
                });
            }                       

        });

        $('#opc-'+ array[key].id_campo).change();
    }

    function agregarReporte (reporte, id_reporte, lista_campos, campos) {
                        
        //si no existe
        if($('#rep-'+id_reporte).length == 0 && id_reporte != '')
        {       

            btnEliminar = "<div class='btn btn-primary' value='' style='margin-right: 10px;' onclick='eliminarReporte("+id_reporte+");'>-</div>"
            btnEditar = "<img src='<?php echo base_url();?>assets/img/recursos/edit64x64.png' onclick='editarReporte("+id_reporte+");' style='height: 34px; cursor:pointer;'/> ";
            fila = "<div id='rep-"+id_reporte+"' name='rep-"+id_reporte+"' style='line-height: 25px; '>"+btnEliminar+btnEditar+"<span >"+reporte+"</span></div>";
            
            $('#listaReportes').append(fila);
            
            //asignar qtip2
            $('#rep-'+id_reporte).qtip({
                content: {
                    text: lista_campos,
                    title: reporte
                },
                style: {
                    classes: 'qtip-tipped'
                },
                position: {
                    target: 'mouse',
                    adjust: {
                        x: 20
                    }
                }
            });
            
            camposPorReporte[id_reporte] = campos;
            console.log('no existe');
            
        }
        else
        {       
            
            $('#rep-'+id_reporte).qtip('option', 'content.text', lista_campos);
            camposPorReporte[id_reporte] = campos;
            
        }
            console.log('agregar reporte',camposPorReporte);
    }

    function eliminarReporte (id_reporte) {
                
        $('#rep-'+id_reporte).fadeOut().remove();
        //camposPorReporte[id_reporte] = campos;
        //camposPorReporte.splice(id_reporte,1);
        delete camposPorReporte[id_reporte];
        console.log('eliminar reporte', camposPorReporte);
    }
    
    function editarReporte (id_reporte) {
        
        $('#btnGuardarCambios').fadeIn();
        $("#comboReportes").val(id_reporte);

        $.ajax({
                url: "listaCamposReporte",
                type: "POST",
                dataType:'json',
                data: 'id_reporte='+id_reporte,
                success: function(data){
                    console.log(data);                  
                    //array = jQuery.parseJSON(data.contenido); 
                    if(data.respuesta)
                    {
                        array = (data.contenido);          
                        agregarCampos (array);   

                        setTimeout(function(){
                
                            $('.lista_campos').each(function (){
                                $(this).prop('checked', false);             
                            });
                            
                            camposSeleccionados = camposPorReporte[id_reporte];

                            for (key in camposSeleccionados)
                            {
                                id_campo = camposSeleccionados[key];
                                $('#opc-'+id_campo).prop('checked', true).change();             
                            }
                            console.log(camposPorReporte);
                        }, 300); 
                    }
                                 
                }
            });
             
    }

    function rwCamposPorReporte() {
        id_usuario = $('#idRow').val();
        numReportes = Object.keys(camposPorReporte).length;
        console.log('camposPorReporte', camposPorReporte);
        camposPorReporte2 = JSON.stringify(camposPorReporte);
        //console.log(camposPorReporte);
        $.ajax({
            url:"rwCamposPorReporte",
            type:"POST",
            dataType:'json',
            data:'id_usuario='+id_usuario+'&camposPorReporte='+camposPorReporte2+'&numElem='+numReportes,
            success: function(data){                
                console.log(data);
                if(data.respuesta)
                {
                    $('#mensaje').qtip('option', 'content.text', 'El registro se realizo exitosamente.');
                    $('#mensaje').click();
                }
                else
                {
                    $('#mensaje').qtip('option', 'content.text', 'El registro no pudo realizarse, intente nuevamente.');
                    $('#mensaje').click();
                }
                        

                /*setTimeout(function () {
                    $('#formulario').dialog('close');
                },1000);*/

                            
            },
            error:function(response){
                console.log(response);
                $('#mensaje').qtip('option', 'content.text', 'El registro no pudo realizarse, intente nuevamente.');
                $('#mensaje').click();
            } 
        });
    }

</script>



