<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
| 	www.your-site.com/class/method/id/
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
| There are two reserved routes:
|
|	$route['default_controller'] = 'home';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

//language route
$route['(\w{2})/(.*)'] = '$2';
$route['(\w{2})'] = $route['default_controller'];

$handle = opendir(APPPATH.'modules');

if ($handle)
{
	while ( false !== ($module = readdir($handle)) )
	{
		// make sure we don't map silly dirs like .svn, or . or ..
		
		if (substr($module, 0, 1) != ".")
		{
			if ( file_exists(APPPATH.'modules/'.$module.'/'.$module.'_routes.php') )
			{
				include(APPPATH.'modules/'.$module.'/'.$module.'_routes.php');
			}
			if ($module != 'admin') {
				$route[$module] = $module;
				$route[$module.'/(.*)'] = $module.'/$1';
				$route['admin/'.$module.'(/.*)?'] = "$module/admin$1";				
			}

		}
	}
}
$route['default_controller'] = "page";
$route['scaffolding_trigger'] = "";
$route['admin'.'(/.*)?'] = 'admin$1';
$route['(.*)'] = "page/index/$1";
//var_dump($route);

?>