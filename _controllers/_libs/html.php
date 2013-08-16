<?

function HTMLhead($page) {
	?>
<!DOCTYPE html>
<html><head>
 <title></title>
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css">
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
 <a href="<? echo $des; ?>project?v=all">Projects</a>
 <a href="<? echo $des; ?>admin">Admin</a>
 <? if(isset($_SESSION['DESlogged']) && $_SESSION['DESlogged']==1) { ?><a href="#" id="logout">Log out</a><? } ?>
</nav>
	<?
}

function HTMLfoot($page) {
	?>
</body></html>
	<?
}

?>