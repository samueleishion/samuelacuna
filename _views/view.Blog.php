<?
require_once('_models/model.Entry.php'); 
$project = new Entry($dblink); 
$page = 'blog';  
$project->setPage($page); 
HTMLhead($page); 
HTMLnav($page); 
$spotlight = false; 
?>

<section style="padding:0px; ">
 <?
	if($project->instantiate($show)) {
		$spotlight = true; 
		echo $project->show(); 
	}

	if($spotlight)
		echo '</section><section style="padding-top:30px; background-color:#fafafa; ">'; 
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
	echo '<section'.(($spotlight) ? ' style="background-color:#fafafa;"' : '').'><content class="middle"><ul id="Grid">'; 
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