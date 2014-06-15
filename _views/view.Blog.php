<?
require_once('_models/model.Entry.php'); 
$project = new Entry($dblink); 
$page = 'blog';  
$project->setPage($page); 
HTMLhead($page); 
HTMLnav($page); 
?>

<section style="padding:0px; ">
 <?
	if($project->instantiateByName($show)) {
		echo $project->show(); 
		echo '</section><section>'; 
	}
	// show types
	echo '<ul style="padding-top:50px; text-align:middle; ">';
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