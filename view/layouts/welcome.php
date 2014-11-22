<?php
 //file: view/layouts/default.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta charset="utf-8">
	<title><?= $view->getVariable("title", "no title") ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
</head>
<body>
<div class="container2">

	<header>
		<a href="login.html"> 
			<h1 id="logo">FlaBoo</h1>
		</a>
	</header>
	<?= $view->popFlash() ?>
    <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>    
</div>	
</body>
</html>