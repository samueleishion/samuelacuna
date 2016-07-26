<?

/*
 * Descartes PHP Framework
 * 
 * @author: Samuel Acuna
 * @date: 08/2013
 * 
 * The Descartes Framework focuses on distributing site flow in an MVC
 * type of architecture that is targetted for portfolio sites that
 * contain multiple images. This framwork can be adapted to other 
 * types of content such as articles, galleries, files, etc. 
 * 
 */
// $actual_link = $_SERVER['REQUEST_URI'];
// echo $actual_link.'<br />'; 

include_once('_controllers/_libs/functions.php');
include_once('_controllers/_libs/html.php');  
require_once('_controllers/settings.php'); 
require_once('_controllers/controller.php'); 

$controller = new Controller($dblink,$_SERVER['REQUEST_URI']); 
// $controller->match(); 

?>