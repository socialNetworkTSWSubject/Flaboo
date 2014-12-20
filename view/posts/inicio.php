
<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $posts = $view->getVariable("posts"); 
 $errors = $view->getVariable("errors");
 $newcomment = $view->getVariable("comment"); 
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
			<a href="index.php?controller=posts&action=perfil&id=<?=$post->getAuthor()?>">
				<h2 class="nombrecomentario" ><?=$post->getAuthor()?></h2>
			</a>
			<h2 class="nombrecomentario"><?=$post->getDate()?></h2>
		</div>
		<a href="index.php?controller=likes&action=addLike&id=<?=$post->getIdPost()?>">
			<button class="botonmegusta" name="idPost"><?=i18n("Me gusta")?></button>
		</a>
		<h3 class="likes"><?=$post->getNumLikes()?></h3>
		<a href="index.php?controller=likes&action=removeLike&id=<?=$post->getIdPost()?>">
			<button class="botonmegusta" name="idPost"><?=i18n("Ya no me gusta")?></button>
		</a>
		<p class="clearboth"><?=$post->getContent()?></p>
		
		<?php foreach($post->getComments() as $comment): ?>
		<div class="comment">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
			<h2 class="nombrecomentario"><?= $comment->getAuthor()?></h2>
			<h2 class="nombrecomentario"><?= $comment->getDate() ?></h2>
			<a href="index.php?controller=likesComments&action=addLike&id=<?=$comment->getId()?>">
				<button class="botonmegusta" name="idComment"><?=i18n("Me gusta")?></button>
			</a>
			<h3 class="likes"><?=$comment->getNumLikes()?></h3>
			<a href="index.php?controller=likesComments&action=removeLike&id=<?=$comment->getId()?>">
				<button class="botonmegusta" name="idComment"><?=i18n("Ya no me gusta")?></button>
			</a>
			<p class="clearboth"><?= $comment->getContent() ?></p>
		</div>
		
		<?php endforeach; ?>
		<div class="addcoment">
		<form method="POST" action="index.php?controller=comments&action=add&id=<?=$post->getIdPost()?>">
			  <textarea type="text" name="content" rows="5" cols="70"></textarea>
			  <input class="botonmegusta" type="submit" name="submit" value="<?=i18n("Hacer comentario") ?>">
		</form>
		</div>
	</div>
	<?php endforeach; ?>
	
			
	<?php else: ?>
		<h1> <?=i18n("Muro vacio")?></h1>
	<?php endif;?>

	