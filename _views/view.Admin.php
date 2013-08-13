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
<? } ?>
<?
HTMLfoot($page); 
?>