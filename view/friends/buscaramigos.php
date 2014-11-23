

<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $busquedas = $view->getVariable("busquedas");
?>

<div>
	<h1 class="txtsolicitudes">Usuarios</h1>
</div>	

<?php foreach ($busquedas as $busqueda): ?>
	<div class="solicitud">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<h2 class="nombresolicitud" ><?=$busqueda->getName()?></h2>
		<div class="botonessolicitud">
			<a href="index.php?controller=friends&action=solicitarAmistad&id=<?=$busqueda->getEmail()?>" ><button class="botonsolicitud">Enviar solicitud de amistad</button></a>
		</div>
	</div>
<?php endforeach; ?>


<div class="vermas">Ver más</div>
		