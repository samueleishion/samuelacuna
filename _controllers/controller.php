<?

/*
 * Descartes PHP Framework
 * 	controller.php
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * Model builder and view selector.   
 * 
 */

$view = (isset($_GET['view'])) ? cleanView($_GET['view']) : 'home'; 
switch($view) {
	case 'admin':
		require_once('_views/view.Admin.php'); 
		break; 
	case 'project':
		$show = (isset($_GET['v'])) ? cleanView($_GET['v']) : 'all';  
		require_once('_views/view.Project.php');
		break; 
	default:
		require_once('_views/view.Home.php');  
		break; 
}

?>