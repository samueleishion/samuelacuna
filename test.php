<?

require_once('_controllers/_libs/functions.php');
require_once('_controllers/settings.php'); 
require_once('_models/model.Image.php'); 
require_once('_models/model.Project.php'); 
require_once('_models/model.User.php'); 
require_once('_models/model.Admin.php'); 


/* 
 * ===================
 * IMAGE
 * ===================
 */
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
echo $img->show().PHP_EOL;
 
$img->delete(); 
echo $img.PHP_EOL.PHP_EOL;  

/* 
 * ===================
 * PROJECT
 * ===================
 */
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
echo $pro->show().PHP_EOL;
echo $pro->showCover().PHP_EOL;  

$pro->delete(); 
echo $pro.PHP_EOL.PHP_EOL; 

/* 
 * ===================
 * USER 
 * ===================
 */
// echo "USER".PHP_EOL; 
// echo "====".PHP_EOL; 
// $user = new User($dblink);  
// echo $user.PHP_EOL; 
// 
// $user->instantiate('admin','admin');
// echo $user.PHP_EOL; 
// 
// $user->login(); 
// echo $user.PHP_EOL; 
// 
// $user->logout(); 
// echo $user.PHP_EOL.PHP_EOL; 

/* 
 * ===================
 * ADMIN 
 * ===================
 */
echo "ADMIN (ext. User)".PHP_EOL; 
echo "=================".PHP_EOL; 
$user = new Admin($dblink);  
echo $user.PHP_EOL; 

$user->instantiate('admin','admin');
echo $user.PHP_EOL; 

$user->login(); 
echo $user.PHP_EOL; 

echo $user->getMenu().PHP_EOL; 
echo $user->getProjectToEdit(1).PHP_EOL; 

$user->logout(); 
echo $user.PHP_EOL; 

?>  