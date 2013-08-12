<?

require_once('_controllers/_libs/functions.php'); 
require_once('_controllers/settings.php');
require_once('_models/model.Image.php'); 
require_once('_models/model.Project.php'); 
echo "IMAGE".PHP_EOL; 
echo "=====".PHP_EOL; 
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
echo $img.PHP_EOL.PHP_EOL;  

echo "PROJECT".PHP_EOL; 
echo "=======".PHP_EOL; 
$pro = new Project($dblink); 
echo $pro.PHP_EOL; 

$pro->setName("metaphysics");
$pro->setDescription("A description thing");  
echo $pro.PHP_EOL; 

$pro->instantiate(2); 
echo $pro.PHP_EOL; 

$pro->clear(); 
$pro->setName("Ethics"); 
$pro->setDescription("What is Good?"); 
$pro->setTypes("2"); 
$pro->addType("3"); 
$pro->removeType("2"); 
$pro->setCover(1); 
echo $pro.PHP_EOL; 

$pro->save(); 
echo $pro.PHP_EOL; 

$pro->delete(); 
echo $pro.PHP_EOL; 


?>  