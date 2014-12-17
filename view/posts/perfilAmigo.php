<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $posts = $view->getVariable("posts");
 $userName = $view->getVariable("userName");
 $errors = $view->getVariable("errors");
 $view->setVariable("title", "Flaboo -- Inicio");
?>

<div id="new_post">
	<h1 >Posts del usuario: <?=$userName?></h1>
</div>		
	
	<?php if($posts != NULL): ?>
	<?php foreach ($posts as $post): ?>

	<div class="comentario">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<div class="conjunto">
			<h2 class="nombrecomentario" ><?=$post->getAuthor()?></h2>
			<h2 class="nombrecomentario"><?=$post->getDate()?></h2>
		</div>
		<a href="index.php?controller=likes&action=addLike&id=<?=$post->getIdPost()?>&iduser=<?=$post->getAuthor()?>">
			<button class="botonmegusta" name="idPost"><?=i18n("Me gusta")?></button>
		</a>
		<h3 class="likes"><?=$post->getNumLikes()?></h3>
		<a href="index.php?controller=likes&action=removeLike&id=<?=$post->getIdPost()?>&iduser=<?=$post->getAuthor()?>">
			<button class="botonmegusta" name="idPost"><?=i18n("Ya no me gusta")?></button>
		</a>
		<p class="clearboth"><?=$post->getContent()?></p>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
		<h1> <?=i18n("Muro vacio")?></h1>
	<?php endif;?>


	
	