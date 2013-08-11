<?

require_once('_controllers/_libs/functions.php'); 
require_once('_controllers/settings.php');
require_once('_models/model.Image.php'); 
$img = new Image($dblink); 
echo $img->getId();  
error_log($img->getId()); 

?>