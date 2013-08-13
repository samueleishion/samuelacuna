<?
require_once('_models/model.Project.php'); 
$project = new Project($dblink); 
$project->instantiateByName($show); 
$page = 'projects'; 
HTMLhead($page); 
HTMLnav($page); 
?>

<? echo $page; ?><br>
<? echo $show; ?><br>
<? echo $project->show(); ?>

<?
HTMLfoot($page); 
?>