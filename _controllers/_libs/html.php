<?

function HTMLhead($page) {
	if($page=='admin') $_SESSION['DESlastadmin'] = ''; 
	?>
<!DOCTYPE html>
<html><head>
 <title></title>
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css">
 <?
 	if($page=='admin') {
 		?>
 <link rel="stylesheet" type="text/css" href="_views/_stys/admin.css">
 		<?
 	}
 ?>
 <script src="_views/_scrs/jquery.min.js"></script>
 <script src="_views/_scrs/jquery.mixitup.min.js"></script>
 <script src="_views/_scrs/main.js"></script>
</head><body>
	<?
}

function HTMLnav($page) {
	$des = $_SESSION['DESpath'];
	?>
<nav>
 <a href="<? echo $des; ?>">Home</a>
 <a href="<? echo $des; ?>resume">Resume</a>
 <a href="<? echo $des; ?>blog">Blog</a>
 <a href="<? echo $des; ?>portfolio">Portfolio</a>
 <? if(isset($_SESSION['DESlogged']) && $_SESSION['DESlogged']==1) { ?>
 <a href="<? echo $des; ?>admin">Admin</a>
 <a href="#" id="logout">Log out</a><? } ?>
</nav>
	<?
}

function HTMLfoot($page) {
	?>
</body></html>
	<?
}

?>