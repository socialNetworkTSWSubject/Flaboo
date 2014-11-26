
<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $posts = $view->getVariable("posts");
 $errors = $view->getVariable("errors");
?>

<div id="new_post">
	<h1 id="nuevopost">Nuevo Post:</h1>
	<h2 id="fecha"><?=date("m/d/y")?> </h2> 
	<div>
		<form action="index.php?controller=posts&action=addPost" method="post">
			<div>
				<textarea name="content" rows="5" cols="70">
				
				</textarea>
			</div>
			<div>
				<input id="botonazul" type="submit" name="submit" value="submit">
			</div>
		</form>
	</div>
</div>		

	<?php foreach ($posts as $post): ?>
	<div class="comentario">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" ><?=$post->getAuthor()?></h2>
			<h2 class="nombrecomentario"><?=$post->getDate()?></h2>
		</div>
		<button class="botonmegusta">Me gusta</button>
		<h3>7 me gusta</h3> <!--El contador de me gusta creo que tambien se hace con php  -->
		<p class="clearboth"><?=$post->getContent()?></p>
	</div>
<?php endforeach; ?>

	
	