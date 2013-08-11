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

$view = (isset($_GET['view'])) ? cleanView($_GET['view']) :'home'; 
switch($view) {
	case 'admin':
		echo 'Admin'; 
		break; 
	case 'project':
		echo 'Project'; 
		break; 
	default:
		echo 'Welcome!'; 
		break; 
}

?>