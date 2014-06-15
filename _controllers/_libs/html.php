<?

function HTMLhead($page) {
	if($page=='admin') $_SESSION['DESlastadmin'] = ''; 
	?>
<!DOCTYPE html>
<html><head>
 <title></title>
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css">
 <script src="_views/_scrs/jquery.min.js"></script>
 <script src="_views/_scrs/jquery.mixitup.min.js"></script>
 <script src="_views/_scrs/main.js"></script>
 <?
 	if($page=='admin') {
 		?>
 <link rel="stylesheet" type="text/css" href="_views/_stys/admin.css">
 <link rel="stylesheet" type="text/css" href="_views/_stys/markdown.css">
 <script src="_views/_scrs/markdown.js"></script>
 		<?
 	} elseif($page=='blog') {
 		?>
 <link rel="stylesheet" type="text/css" href="_views/_stys/markdown.css">
 <script src="_views/_scrs/markdown.js"></script>
 <script src="_views/_scrs/blog.js"></script> 
 		<?
 	}
 ?>
</head><body>
	<?
}

function HTMLnav($page) {
	$des = $_SESSION['DESpath'];
	?>
<nav>
 <a href="<? echo $des; ?>" id="home">SAMUEL ACUNA</a>
 <a href="<? echo $des; ?>resume">R&eacute;sum&eacute;</a>
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