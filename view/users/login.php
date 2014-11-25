
<?php 
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
?>

<div class="menusup">
	<div id="header_side">
			<h1 id="contact">Contacta con nosotros!</h1>
	</div>
	<div id="menu_login">
		<ul id="credentials">
			<li>Email: </li>
			<li>Contraseña: </li> 
		</ul>
		<form action="index.php?controller=users&action=login" method="POST">
			<span> <input class="frame" type="text" name="email"> </span>
			<span> <input class="frame" type="password" name="password"></span>
			<span> <input id="submit" type="submit" value="Entrar"> </span>
			<br><?= isset($errors["emaillogin"])?$errors["emaillogin"]:"" ?><br>
		</form>
	</div>
</div>

<div id="loginMain">
	<div id="imageScreenshot">
		<img src="assets/img/imageProfile.png" alt="Screenshot de FlaBoo" height="365" width="280" id="screenshot">
	</div>
	
	
	<div id="registration">
		<h1 id="h1registration">¿Aún no te has registrado?</h1>
		<h2 id="h2registration">Regístrate en <span id="flabooReg">FlaBoo!</span></h2>
		<form action="index.php?controller=users&action=register" method="POST">
				<fieldset id="fieldset"> 
					<div class="inputTextReg"> Nombre y apellidos: <input type="text" name="name" class="frameregistro"> <br><?= isset($errors["name"])?$errors["name"]:"" ?><br> </div>
					<div class="inputTextReg"> Correo electronico: <input type="text" name="email" class="frameregistro"> <br><?= isset($errors["email"])?$errors["email"]:"" ?><br> </div>
					<div class="inputTextReg"> Contraseña: <input type="password" name="password" class="frameregistro"> <br><?= isset($errors["password"])?$errors["password"]:"" ?><br> </div>
					<div class="inputTextReg"> Repetir contraseña: <input type="password" name="repeat_password" class="frameregistro"> <br><?= isset($errors["repeat_password"])?$errors["repeat_password"]:"" ?><br> </div>
					<input id="buttonReg" type="submit" value="Registrate!">
				</fieldset>
		</form>	
	</div>
</div>
