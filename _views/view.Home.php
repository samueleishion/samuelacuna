<?
require_once('_models/model.Project.php'); 
$projectlist = getAllProjects($dblink); 
$project = new Project($dblink); 
$page = 'home';  
HTMLhead($page); 
HTMLnav($page); 
?>

<? echo $page; ?>
<section>
 Welcome! 
</section>
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