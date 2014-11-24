<?php
 //file: view/layouts/default.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");
 
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
<div class="container">

	<header>
		<a href="../view/layout/posts/inicio.php"> 
			<h1 id="logo">FlaBoo</h1>
		</a>
		<a href="index.php?controller=users&action=logout"><img src="assets/img/logout.png"  alt="LogOut" height="58" width="62" id="logout"></a>
	</header>
	
	<nav class="menusup">
		<form action="index.php?controller=friends&action=buscaramigos" method="post" id="busqueda">
			<input id="botongris" type="submit" value="Buscar amigos">
			<input id="cuadrobuscar" type="text" name="name_friend">		
		</form>
	</nav>
	
	<aside>
		<div id="asidefoto">
			<img id="fotouser" src="assets/img/usera.jpg" alt="LogOut" height="190" width="150">
		</div>
		<div id="asidenombre">
			<!--porque funciona si en basecontroller solo guarda el email????????????????????????-->
			<p><?=$currentuser->getEmail()?></p>
			<p><?=$currentuser->getName()?></p>
		</div>
		<!--
		<div id="asidedatos">
			<p id="datosinteres">Datos de interés</p>
			<ul>
				<li>Chico</li>
				<li>Fecha de nacimiento: 01/12/88</li>
				<li>Vive en: Ourense</li>
				<li>Registrado: 28/09/2014</li>
				<li>Estudia: Grado en Ingeniería Informática</li>
				<li>Trabaja en: No trabaja</li>
				<li>Información adicional: No hay información adicional que mostrar</li>
			</ul>
		</div>
		-->
	</aside>
	
	
	<main>
	<?= $view->popFlash() ?>
  
    <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>    
 	</main>
	
	<div id="menuderecha">
		<ul>
			<!--
			<li>
				<div>
					<a href="#"><img src="assets/img/mensajes.png" alt="Mensajes" height="60" width="70"></a>
				</div>
				<div class="letraderech">Mensajes</div>
			</li>-->
			<li>
				<div>
					<a href="index.php?controller=friends&action=amigos"><img src="assets/img/amigos.png" alt="Amigos" height="60" width="60"></a>
				</div>
				<div class="letraderech">Amigos</div>
			</li>
			<li>
				<div>
					<a href="index.php?controller=friends&action=solicitudes"><img src="assets/img/solicitudes.png" alt="Solicitudes de amistad" height="60" width="60"></a>
				</div>
				<div class="letraderech">Solicitudes Amistad</div>
			</li>
		</ul>
	</div>
	
	<footer>
	</footer>
	
</div>
</body>
</html> 