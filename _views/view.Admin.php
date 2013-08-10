<?
$headers = true; 
HTMLhead($view); 
HTMLnav($view); 

$log = ($_SESSION['DESlogged']==1) ? 'out' : 'in';
?>
<section id="admin">
 <ul class="menu">
  <input type="submit" class="log" value="Log <? echo $log; ?>" id="log<? echo $log; ?>">
  <!-- <li id="catadd">Add a project</li>
  <li id="cat'.$key.'">'.$row['galtitle'].'</li> -->
 </ul>
</section> 
<? 
HTMLfoot($view); 
?>