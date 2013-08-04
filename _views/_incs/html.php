<?

function HTMLhead($page) {
	?>
<!DOCTYPE html>
<html><head>
 <title>Descartes : <? echo $page; ?></title>
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css">
 <script src="_views/_scrs/jquery.min.js"></script>
</head><body>
	<?
}

function HTMLnav($page) {
	?>
<nav>
 <content>
  <a href="home">Home</a>
  <a href="about">About</a>
  <a href="contact">Contact</a>
 </content>
</nav>
	<?
}

function HTMLfoot($page) {
	?>
</body></html>
	<?
}

?>