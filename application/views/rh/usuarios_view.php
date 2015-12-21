
<div class="container"  style="height: 600px; margin-top:100px;" >

    <div class="row">

        <div class="col-md-12 col-md-offset-12" >
            <div class="btn btn-primary" id="btn-agregar" data-toggle="modal" data-target="#fmodal" style="margin-left:-71px;" title="Nuevo">
                <i class="fa fa-plus-square"></i>
            </div>
        </div>

    </div>

    <br />

    <div class="row">

        <div class="col-md-12">

            <table id="tablainfo" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%" data-page-length='50' data-search="1">
            </table>

        </div>

    </div>

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
                                        <div class="col-md-3">Plaza</div>
                                        <div class="col-md-9">
                                            <select id="cpo_plazas" name="cpo_plazas" class="form-control" required>
                                            </select>
                                        </div>
                                    </div>    
                                    
                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Puesto</div>
                                        <div class="col-md-9">
                                            <select id="cbo_puesto" name="cbo_puesto" class="form-control" required></select>
                                        </div>
                                    </div>
                                   
                                   <br />

                                    <div class="row">
                                        <div class="col-md-3">Jefe Directo</div>
                                        <div class="col-md-9"><select id="cbo_jefedirecto" name="cbo_jefedirecto" class="form-control" required></select></div>
                                    </div>
                                    
                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Nombre</div>
                                        <div class="col-md-9"><input type="text" id="nombre_completo" name="nombre_completo" class="form-control"  value="" placeholder="Nombre" required/></div>
                                    </div>                                    
                                    

                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Apellido Paterno</div>
                                        <div class="col-md-9"><input type="text" id="apaterno" name="apaterno" class="form-control"  value="" placeholder="Apellido Paterno" required/></div>
                                    </div>                                    

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Apellido Materno</div>
                                        <div class="col-md-9"><input type="text" id="amaterno" name="amaterno" class="form-control"  value="" placeholder="Apellido Materno" required/></div>
                                    </div>

                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Usuario</div>
                                        <div class="col-md-9"><input type="text" id="usuario_f" name="usuario_f" class="form-control"  value="" placeholder="Usuario" required/></div>
                                    </div>

                                    <br />   

                                    <div class="row">
                                        <div class="col-md-3">Contraseña</div>
                                        <div class="col-md-9"><input type="text" id="contrasenia" name="contrasenia" class="form-control"  value="" placeholder="Contraseña" required/></div>
                                    </div>  

                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Estado</div>
                                        <div class="col-md-9"><select id="cbo_estado" name="cbo_estado" class="form-control"></select></div>
                                    </div>

                                    <br />  

                                    <div class="row">
                                        <div class="col-md-3">Direcciòn</div>
                                        <div class="col-md-9"><input type="text" id="direccion" name="direccion" class="form-control"  value="" placeholder="Direcciòn" required/></div>
                                    </div>  

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Colonia</div>
                                        <div class="col-md-9"><input type="text" id="colonia" name="colonia" class="form-control"  value="" placeholder="Colonia" required/></div>
                                    </div>  

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Codigo Postal</div>
                                        <div class="col-md-9"><input type="text" id="cp" name="cp" class="form-control"  value="" placeholder="Codigo Postal"/></div>
                                    </div>  
                                    
                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Rfc</div>
                                        <div class="col-md-9"><input type="text" id="rfc" name="rfc" class="form-control"  value="" placeholder="Rfc"/></div>
                                    </div>                                     

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Imss</div>
                                        <div class="col-md-9"><input type="text" id="imss" name="imss" class="form-control"  value="" placeholder="Imss"/></div>
                                    </div>  
                                    
                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Curp</div>
                                        <div class="col-md-9"><input type="text" id="curp" name="curp" class="form-control"  value="" placeholder="Curp"/></div>
                                    </div>  


                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Sexo</div>
                                        <div class="col-md-9"><select id="cbo_sexo" name="cbo_sexo" class="form-control"></select></div>
                                    </div>

                                    <br />

                                    <div class="row">
                                        <div class="col-md-3">Estado Civil</div>
                                        <div class="col-md-9"><select id="cbo_estado_civil" name="cbo_estado_civil" class="form-control"></select></div>
                                    </div>

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Lada</div>
                                        <div class="col-md-9"><input type="text" id="lada" name="lada" class="form-control"  value="" placeholder="Lada"/></div>
                                    </div>  

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Telefono</div>
                                        <div class="col-md-9"><input type="text" id="telefono" name="telefono" class="form-control"  value="" placeholder="Telefono"/></div>
                                    </div>  

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Correo Electronico</div>
                                        <div class="col-md-9"><input type="text" id="email" name="email" class="form-control"  value="" placeholder="Correo electronico"/></div>
                                    </div>     

                                    <br />    
                                    <div class="row">
                                        <div class="col-md-3">Turno</div>
                                        <div class="col-md-9"><select id="cbo_turno" name="cbo_turno" class="form-control"></select></div>
                                    </div>


                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Numero de Cuenta</div>
                                        <div class="col-md-9"><input type="text" id="cuenta" name="cuenta" class="form-control"  value="" placeholder="Numero de Cuenta"/></div>
                                    </div>                                                                                                           



                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Usuario Banco</div>
                                        <div class="col-md-9"><input type="text" id="usuario_banco" name="usuario_banco" class="form-control"  value="" placeholder="Usuario Banco"/></div>
                                    </div>   



                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Contraseña Banco</div>
                                        <div class="col-md-9"><input type="text" id="contrasenia_banco" name="contrasenia_banco" class="form-control"  value="" placeholder="Contraseña Banco"/></div>
                                    </div>   

                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Fecha Alta</div>
                                        <div class="col-md-9"><input type="text" id="fechaalta" name="fechaalta" class="form-control"  value="" placeholder="Fecha Alta"/></div>
                                    </div>                                                                                                           



                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Fecha Contrataciòn</div>
                                        <div class="col-md-9"><input type="text" id="fecha_contratacion" name="fecha_contratacion" class="form-control"  value="" placeholder="Fecha Contrataciòn"/></div>
                                    </div>   



                                    <br />    

                                    <div class="row">
                                        <div class="col-md-3">Fecha Terminaciòn</div>
                                        <div class="col-md-9"><input type="text" id="fecha_termino" name="fecha_termino" class="form-control"  value="" placeholder="Fecha Termino"/></div>
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
    lista_f('usrplazas','u_plaza','plaza','','cpo_plazas');
    lista_f('usrpuestos','u_puesto','puesto','','cbo_puesto');
    lista_f('s_usuarios','userid','nombre','u_status = 1 and u_puesto = 2 and u_plaza=<?php echo $_SESSION["u_plaza"];?>','cbo_jefedirecto');
    lista_f('cat_estados',' id_estado','nombre_estado','','cbo_estado');
    lista_f('cat_sexo','id_sexo','sexo','','cbo_sexo');
    lista_f('usrturnos','u_turno','turno','','cbo_turno');
    lista_f('usrestadocivil','u_estadocivil','nombre','','cbo_estado_civil');
    


    $("#fechaalta").datetimepicker();
    $("#fecha_contratacion").datetimepicker();
    $("#fecha_termino").datetimepicker();
    
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

        


    }
     
    
    


   
    

</script>



