<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "Welcome";
$route['404_override'] = '';

/*inicio de sesion*/
$route['inicio'] = 'Welcome/index';
$route['verificalogin'] = 'Welcome/verificalogin';
$route['enviaotrapagina'] = 'Welcome/otrapagina';
$route['cerrarsesion'] = 'Welcome/cerrar_sesion';
$route['cambiarVariable'] = 'Welcome/cambiarVariableSession';


/*Generales*/
$route['lista']  = 'Generales/lista';

/*RH - Usuarios*/
$route['usuarios'] = 'RH_usuarios/usuarios';  //vista inicial
$route['usuarios_contenido'] = 'RH_usuarios/usuarios_contenido'; //muestra contenido
$route['usuarios_altas'] = 'RH_usuarios/usuarios_altas'; //registra
$route['usuarios_bajas'] = 'RH_usuarios/usuarios_bajas'; //elimina
$route['usuarios_cambios'] = 'RH_usuarios/usuarios_cambios';  //edita
$route['usuarios_consulta'] = 'RH_usuarios/usuarios_consulta';  //consulta
$route['usuarios_menu'] = 'RH_usuarios/usuarios_menu';  //consulta
$route['tablaCampaniasxUsuario'] = 'RH_usuarios/tablaCampaniasxUsuario';


/*RH - Reporte Usuarios x Campaña*/
$route['usuariosxcampania'] = 'RH_usuarios/usuariosxcampania';  //vista inicial
$route['usuariosxcampania_contenido'] = 'RH_usuarios/usuariosxcampania_contenido'; //muestra contenido

/* End of file routes.php */
/* Location: ./application/config/routes.php */