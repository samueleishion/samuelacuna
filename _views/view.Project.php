<?
require_once("_models/model.Project.php"); 
require_once("_models/model.Gallery.php");
$project = new Project($dblink); 
$thisproject = ''; 
if(isset($v)) {
	$isthere = $project->instantiateByName($v); 
	if($isthere) {
		$thisproject = '<div class="gallery">'; 
		$thisproject .= $project->show(); 
		$thisproject .= '</div>'; 
	}
} 
$gallery = new Gallery($dblink); 
if(empty($headers) || !$headers) {
	HTMLhead($view); 
	HTMLnav($view);
} 
?>
<section id="projects">
 <content>
  <h1>Our Projects</h1> 
  <? echo $thisproject; ?> 
  <div class="gallery">
   <? echo $gallery->show(); ?>
  </div>
 </content>
</section>
<? 
if(empty($headers) || !$headers) {
	HTMLfoot($view);
} 
?>