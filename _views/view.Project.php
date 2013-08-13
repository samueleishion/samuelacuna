<?
require_once('_models/model.Project.php'); 
$project = new Project($dblink); 
$page = 'projects'; 
HTMLhead($page); 
HTMLnav($page); 
?>

<? echo $page; ?>
<section>
<? 
if($project->instantiateByName($show)) {
	echo $project->show(); 
} else { 
	$projectlist = getAllProjects($dblink); 
	foreach($projectlist as $key => $p) {
		$project->instantiate($p); 
		echo $project->showCover(); 
		$project->clear(); 
	}
}
?>
</section>

<?
HTMLfoot($page); 
?>