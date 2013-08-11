<?

require_once('_controllers/_libs/functions.php'); 
require_once('_controllers/settings.php');
require_once('_models/model.Image.php'); 
$img = new Image($dblink); 
echo $img.PHP_EOL;

$img->setName("iphone.png"); 
$img->setProject(1); 
echo $img.PHP_EOL; 

$img->instantiate(1); 
echo $img.PHP_EOL; 

$img->clear(); 
$img->setName("test.jpg"); 
$img->setProject(5); 
echo $img.PHP_EOL; 

$img->save(); 
echo $img.PHP_EOL; 

$img->delete(); 
echo $img.PHP_EOL;  

?>