<?
require_once('_models/model.Project.php'); 
$project = new Project($dblink); 
$page = 'portfolio'; 
$project->setPage($page); 
HTMLhead($page); 
HTMLnav($page); 
$spotlight = false; 
?>

<section style="padding:0px; ">
 <? 
	if($project->instantiateByName($show)) {
		$spotlight = true; 
		echo $project->show(); 
	}

	if($spotlight)
		echo '</section><section style="padding-top:30px; border-top:1px solid #ddd;">'; 
	else echo '</section><section style="padding-top:30px;">'; 

	// show types
	echo '<ul id="GridTags" style="text-align:middle; ">';
	echo '<li class="filter" data-filter="all">All</li>'; 
	$typeslist = getAllTypes($dblink); 
	foreach($typeslist as $key => $t) {
		echo '<li class="filter" data-filter="category_'.$key.'">'.ucfirst($t).'</li>'; 
	}
	echo '</ul></section>'; 
	// show covers  
	echo '<section><content class="middle"><ul id="Grid">'; 
	$projectlist = getAllProjects($dblink,$page); 
	foreach($projectlist as $key => $p) {
		$project->instantiate($p); 
		echo $project->showCover(); 
		$project->clear(); 
	}
	echo '</ul>'; 
	echo '</content>'; 

?>
</section>

<?
HTMLfoot($page); 
?>