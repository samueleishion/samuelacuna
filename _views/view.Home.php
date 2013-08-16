<?
require_once('_models/model.Project.php'); 
$projectlist = getAllProjects($dblink); 
$project = new Project($dblink); 
$page = 'home';  
HTMLhead($page); 
HTMLnav($page); 
?>

<section>
 Welcome! 
</section>
<section>
 <?
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