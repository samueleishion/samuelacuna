<?
require_once('_models/model.Project.php'); 
$projectlist = getAllProjects($dblink); 
$project = new Project($dblink); 
$page = 'home';  
HTMLhead($page); 
HTMLnav($page); 
?>

<section>
 Resume! 
</section>

<?
HTMLfoot($page); 
?>