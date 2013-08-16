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
	echo '</section><section>'; 
}
	// show types
	echo '<ul>'; 
	$typeslist = getAllTypes($dblink); 
	foreach($typeslist as $key => $t) {
		echo '<li class="filter" data-filter="category_'.$key.'">'.$t.'</li>'; 
	}
	echo '</ul>'; 
	// show covers  
	echo '<ul id="Grid">'; 
	$projectlist = getAllProjects($dblink); 
	foreach($projectlist as $key => $p) {
		$project->instantiate($p); 
		echo $project->showCover(); 
		$project->clear(); 
	}
	echo '</ul>'; 

?>
</section>

<?
HTMLfoot($page); 
?>