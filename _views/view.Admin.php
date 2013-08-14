<?
require_once('_models/model.Admin.php'); 
$admin = new Admin($dblink); 
$page = 'admin'; 
HTMLhead($page); 
HTMLnav($page); 
?>

<? echo $page; ?>
<? if(!isset($_SESSION['DESlogged']) || $_SESSION['DESlogged']!=1) { ?>
<section>
 <form method="post">
  <input type="text" name="uname" id="uname">
  <input type="password" name="pword" id="pword">
  <input type="submit" class="submit" id="login" value="Log in">
 </form>
</section>
<? } else {
	$admin->instantiateById($_SESSION['DESuid']);  
	?>
<section>
 <ul id="menu">
  <?
	echo $admin->getMenu(); 
  ?>
 </ul>
 <div class="gallery">
  <?
	echo $admin->getProjectToEdit(0); 
  ?>
 </div>
</section>

<div class="curtain" id="addProject">
 <div class="box">
  Add a project
  <input type="text" id="newProjectName" placeholder="Project Name"><br>
  <textarea id="newProjectDescription" placeholder="Description"></textarea>
  <input type="button" class="submit" id="addproject" value="Save">
  <a class="curtainClose" id="addProject">X</a>
 </div>
</div>

<? } ?>
<?
HTMLfoot($page); 
?>