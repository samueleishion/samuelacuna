<?
require_once("_models/model.Gallery.php"); 
$gallery = new Gallery($dblink); 
if(empty($headers) || !$headers) {
	HTMLhead($view); 
	HTMLnav($view);
} 
?>
<section id="projects">
 <content>
  <h1>Our Projects</h1>
  Projects
  <? echo $gallery->show(); ?>
 </content>
</section>
<? 
if(empty($headers) || !$headers) {
	HTMLfoot($view);
} 
?>