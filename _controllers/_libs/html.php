<?

function HTMLhead($page) {
	if($page=='admin') $_SESSION['DESlastadmin'] = ''; 
	error_log($page); 
	?>
<!DOCTYPE html>
<html><head>
 <title>Samuel Acu&ntilde;a</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta name="title" content="Samuel Acu&ntilde;a">
 <meta name="keywords" content="samuel acuna, web design, web development, ui/ux, user interface, user interaction, user experience, design, development, artificial intelligence, computational linguistics, natural language processing, language, computer, computer science, science, math, philosophy">
 <meta name="description" content="Samuel Acu&ntilde;a's personal website.">
 <meta property="fb:admins" content="788470441">
 <meta property="og:title" content="Samuel Acu&ntilde;a">
 <meta property="og:type" content="website">
 <meta property="og:url" content="http://samuelacuna.com">
 <meta property="og:description" content="Samuel Acu&ntilde;a's personal website.">
 <meta property="og:image" content="http://samuelacuna.com/_views/_imgs/meta_img.png">
 <!--<meta property="og:image" content="http://benova.net/_imgs/projects/whoismypresh.png">-->
 <meta property="og:site_name" content="Samuel Acu&ntilde;a">
 <link rel="icon" type="image/x-icon" href="http://samuelacuna.com/_views/_imgs/favicon.ico">
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css">
 <script src="_views/_scrs/jquery.min.js"></script>
 <script src="_views/_scrs/jquery.mixitup.min.js"></script>
 <script src="_views/_scrs/main.js"></script>
 <script src="_views/_scrs/colors.js"></script> 
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
 	} elseif($page=='resume') {
 		?>
  <link rel="stylesheet" type="text/css" href="_views/_stys/resume.css"> 
  <script src="_views/_scrs/resume.js"></script> 
 		<?
 	} elseif($page=='portfolio') {
 		error_log("I'm on portfolio"); 
 		?>
 <link rel="stylesheet" type="text/css" href="_views/_stys/project.css"> 
 <link rel="stylesheet" type="text/css" href="_views/_stys/markdown.css">
 <script src="_views/_scrs/markdown.js"></script>
 <script src="_views/_scrs/blog.js"></script> 
 		<?
 	} 
 ?>
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54916722-1', 'auto');
  ga('send', 'pageview');

</script>
</head><body>
	<?
}

function HTMLnav($page) {
	$des = $_SESSION['DESpath'];
	?>
<nav>
 <content>
 <a href="<? echo $des; ?>" id="home">SAMUEL ACUNA</a>
 <a href="<? echo $des; ?>resume">R&eacute;sum&eacute;</a>
 <a href="<? echo $des; ?>blog">Blog</a>
 <a href="<? echo $des; ?>portfolio">Portfolio</a>
 <? if(isset($_SESSION['DESlogged']) && $_SESSION['DESlogged']==1) { ?>
 <a href="<? echo $des; ?>admin">Admin</a>
 <a href="#" id="logout">Log out</a><? } ?>
 </content> 
</nav>
	<?
}

function HTMLfoot($page) {
	if($page!='admin') {
		?>
<section class="footer">
 <content class="middle"> 
	<div class="mypic"></div> 
	<div>Samuel Acu&ntilde;a</div> 
	<div class="social">
		<a href="samuelacuna-resume.pdf" target="_new" class="button" id="resume" alt="Download my R&eacute;sum&eacute;">t</a>
		<a href="http://github.com/samueleishion" target="_new" class="button" id="github" alt="My Github">h</a>
		<a href="https://seelio.com/samueleishion/public" target="_new" class="button" id="seelio" alt="Seelio">s</a>
		<a href="http://www.linkedin.com/profile/view?id=165141414" target="_new" class="button" id="linkedin" alt="My Linkedin">i</a>
		<a href="http://www.facebook.com/profile.php?id=788470441" target="_new" class="button" id="facebook" alt="My Facebook">f</a>
		<a href="http://twitter.com/samueleishion" target="_new" class="button" id="twitter" alt="My Twitter">w</a>
		<a href="http://instagram.com/samueleishion/" target="_new" class="button" id="instagram" alt="My Instagram">p</a> 
		<a href="https://plus.google.com/100032260337537072343/posts" target="_new" class="button" id="google" alt="My Google+">g</a>
		<a href="http://www.youtube.com/samueleishion" target="_new" class="button" id="youtube" alt="My youtube channel">y</a> 
		<a href="mailto:samueleishion@gmail.com" target="_new" class="button" id="email" alt="Send me an e-mail">e</a>
	</div> 
 </content> 
</section> 
		<?
	}

	?>
</body></html>
	<?
}

?>