<?

/*
 * Descartes PHP Framework
 * 
 * @author: Samuel Acuna
 * @date: 08/02/2013
 * 
 * The Descartes Framework focuses on distributing site flow in an MVC
 * type of architecture that is targetted for portfolio sites that
 * contain multiple images. This framwork can be adapted to other 
 * types of content such as articles, galleries, files, etc. 
 * 
 */
 
 // Apply settings to site
 require_once('_controllers/settings.php'); 
 require_once('_views/_incs/html.php'); 
 require_once('_views/_incs/fs.php');   

 // Select a view 
 $view = (isset($_GET['view'])) ? cleanView($_GET['view']) : 'home'; 
 switch($view) {
 	case 'admin':
		// echo 'Admin'; 
		require_once('_views/view.Admin.php'); 
		break;  
	case 'about':
		require_once('_views/view.About.php');
		break; 
	case 'contact':
		require_once('_views/view.Contact.php');
		break; 
	case 'projects':
		require_once('_views/view.Project.php'); 
		break; 
	case 'project':
		$v = (isset($_GET['v'])) ? cleanView($_GET['v']) : '';  
		require_once('_views/view.Project.php'); 
		break; 
 	default:
		require_once('_views/view.Home.php'); 
		break; 
 }

?>