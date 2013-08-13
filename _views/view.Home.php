<?
require_once('_models/model.Image.php'); 
require_once('_models/model.Project.php'); 
$image = new Image($dblink); 
$projectlist = getAllProjects($dblink,$image); 
$project = new Project($dblink); 
$page = 'home';  
HTMLhead($page); 
HTMLnav($page); 
?>

<? echo $page; ?>
<section>
 <?
 	foreach($projectlist as $key => $p) {
 		$project->instantiate($p); 
		echo $project->showCover();  
		$project->clear();  
	}
 ?>
</section>

<?
HTMLfoot($page); 
?>