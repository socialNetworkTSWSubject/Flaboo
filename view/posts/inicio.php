
<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $posts = $view->getVariable("posts");
 $errors = $view->getVariable("errors");
 $view->setVariable("title", "Flaboo -- Inicio");
?>

<div id="new_post">
	<h1 id="nuevopost"><?=i18n("Nuevo Post:")?></h1>
	<h2 id="fecha"><?=date("m/d/y")?> </h2> 
	<div>
		<form action="index.php?controller=posts&action=addPost" method="post">
			<div>
				<textarea name="content" rows="5" cols="70"></textarea>
			</div>
			<div>
				<input id="botonazul" type="submit" name="submit" value="<?=i18n("Enviar")?>">
				<br><?= isset($errors["content"])?$errors["content"]:"" ?><br>
			</div>
		</form>
	</div>
</div>		
	
	<?php if($posts != NULL): ?>
	<?php foreach ($posts as $post): ?>

	<div class="comentario">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" ><?=$post->getAuthor()?></h2>
			<h2 class="nombrecomentario"><?=$post->getDate()?></h2>
		</div>
		<a href="index.php?controller=likes&action=addLike&id=<?=$post->getIdPost()?>">
			<button class="botonmegusta" name="idPost"><?=i18n("Me gusta")?></button>
		</a>
		<h3><?=$post->getNumLikes()?></h3>
		<p class="clearboth"><?=$post->getContent()?></p>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
		<h1> <?=i18n("Muro vacio")?></h1>
	<?php endif;?>


	
	