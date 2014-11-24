<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
?>

<div>
	<h1 class="txtsolicitudes">Mis amigos</h1>
</div>	
<?php foreach ($friends as $friend): ?>
	<div class="solicitud">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<h2 class="nombresolicitud" ><?=$friend->getName()?></h2>
		<div class="botonessolicitud">
			<a href="index.php?controller=friends&action=eliminarAmigo&id=<?=$friend->getEmail()?>"><button class="botonsolicitud">Eliminar de amigos</button></a>
		</div>
	</div>
<?php endforeach; ?>

<div class="vermas">Ver más</div>
		
