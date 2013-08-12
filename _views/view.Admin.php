<?
$page = 'admin'; 
HTMLhead($page); 
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
<? } else { ?>
<section>
 <input type="button" class="submit" id="logout" value="Log out">
</section>
<? } ?>
<?
HTMLfoot($page); 
?>