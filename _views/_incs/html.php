<?

function HTMLhead($page) {
	?>
<!DOCTYPE html>
<html><head>
 <title>Descartes : <? echo $page; ?></title>
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css">
 <script src="_views/_scrs/jquery.min.js"></script>
 <script src="_views/_scrs/main.js"></script>
</head><body>
	<?
}

function HTMLnav($page) {
	$href = ' href='; 
	if($page=='home') $href = ' href="#" id='; 
	?>
<nav>
 <content>
  <a <? echo $href; ?>"home">Home</a>
  <a <? echo $href; ?>"about">About</a>
  <a <? echo $href; ?>"contact">Contact</a>
  <a <? echo $href; ?>"projects">Projects</a>
  <!-- <a <? echo $href; ?>"projects">Projects</a> -->
 </content>
</nav>
	<?
}

function HTMLfoot($page) {
	?>
<section id="footer">
 <content>
  &copy; Descartes Framework. <br>
  <a href="http://github.com/samueleishion/Descartes">github.com/samueleishion/Descartes</a> 
  <a href="http://benova.net">benova.net</a>
  <a href="http://sam.benova.net">Samuel Acu&ntilde;a</a> 
 </content>
</section>
</body></html>
	<?
}

?>