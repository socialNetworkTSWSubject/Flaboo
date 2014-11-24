
<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
?>

<div id="new_post">
	<h1 id="nuevopost">Nuevo Post:</h1>
	<h2 id="fecha">27/09/2014</h2> 
	<div>
		<form action="index.php?controller=posts&action=posts" method="post">
			<div>
				<textarea rows="5" cols="70"> </textarea>
			</div>
			<div>
				<input id="botonazul" type="submit" value="Enviar">
			</div>
		</form>
	</div>
</div>		

	<h1 id="publicaciones">PUBLICACIONES</h1>
	<div class="comentario">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Raquel Martínez Fernández</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3> <!--El contador de me gusta creo que tambien se hace con php  -->
		<p class="clearboth">Por fin de vacaciones!! Mañana viajaré a Londres con mi novio @Gabriel Martínez Gómez. Estoy feliz!!! :D</p>
	</div>
	<div class="comentario">
		<img  class="usercomentario" src="assets/img/userc.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Daniel García González</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">Esta serie es fantástica! Nunca me había reido tanto jaja https://www.youtube.com/watch?v=QqGndZ-9n-o </p>
	</div>
	<div class="comentario">
		<img class="usercomentario" src="assets/img/usera.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Juan Fernández Álvarez</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">Este año comenzaré el doctorado en ingeniería de telecomunicaciones en el MIT: web.mit.edu</p>
	</div>
	<div class="comentario">
		<img class="usercomentario" src="assets/img/usera.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Juan Fernández Álvarez</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">Aquí os dejo el link al repositorio del primer proyecto web en el cuál participé: https://github.com/adri229/iu1314g2</p>
	</div>
	<div class="comentario">
		<img class="usercomentario" src="assets/img/userc.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Gabriel Martínez Gómez</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">Dos semanas de vacaciones!! Te quiero @Raquel Martínez Fernández :3</p>
	</div>
	<div class="comentario">
		<img class="usercomentario" src="assets/img/usera.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Juan Fernández Álvarez</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">El protocolo SMTP es usado para el intercambio de mensajes entre diversos host. </p>
	</div>
	<div class="comentario">
		<img class="usercomentario" src="assets/img/usera.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Juan Fernández Álvarez</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">Sin duda Alienware Alpha será una de las consolas más potente y versátil del mercado. www.alienware.es</p>
	</div>
	<div class="comentario">
		<img class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" >Raquel Martínez Fernández</h2>
			<h2 class="nombrecomentario">Comentado el 28/09/2014 a las 20:45</h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3>
		<p class="clearboth">Mi serie favorita :3 http://www.fox.com/bones/ Me encanta Temperance, es el mejor personaje :)</p>
	</div>
	<div class="vermas">Ver más</div> 
</main>
	
	