CREATE DATABASE `FLABOO` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- creacion de usuario (dandole todos los privilegios)
GRANT USAGE ON *.* TO 'flaboo'@'localhost';
DROP USER 'flaboo'@'localhost';
CREATE USER 'flaboo'@'localhost' IDENTIFIED BY 'flaboo';
GRANT ALL PRIVILEGES ON `FLABOO`.* TO 'flaboo'@'localhost' WITH GRANT OPTION;

-- todas las consultas posteriores pertenecen a la base de datos FLABOO
USE `FLABOO`;

-- creacion de tabla USER
CREATE TABLE IF NOT EXISTS `USERS` (
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email del usuario, unico (ie, no puede haber dos usuarios con el mismo email)',
  `password` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Password del usuario. No puede ser nula',
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre y apellidos del usuario. No puede ser nulo.', 
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de usuarios';

-- creacion de tabla POST
CREATE TABLE IF NOT EXISTS `POST` (
  `idPost` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id del post, unico y auto incremental',
  `datePost` timestamp COLLATE utf8_spanish_ci NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha y hora en la que es creado el post, no puede ser nulo',
  `content` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Contenido del post. No puede ser nulo.',
  `numLikes` int(4) DEFAULT NULL COMMENT 'Numero de likes que tiene el post, nulo por defecto',
  `author` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email del autor del post, no puede ser nulo, clave foranea a USER.email',
  PRIMARY KEY (`idPost`),
  FOREIGN KEY (`author`) REFERENCES `USERS` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de posts' AUTO_INCREMENT=1;

-- creacion de tabla FRIENDS
CREATE TABLE IF NOT EXISTS `FRIENDS` (
	`userEmail` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'email del usuario',
	`friendEmail` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'email del amigo',
	`isFriend` boolean DEFAULT FALSE COMMENT 'Cuando se realiza una solicitud se pone a false y cuando se acepta se pone a true',	
	PRIMARY KEY (`userEmail`,`friendEmail`),
	FOREIGN KEY (`userEmail`) REFERENCES USERS(email),
	FOREIGN KEY (`friendEmail`) REFERENCES USERS(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de amigos';

-- creacion de la tabla LIKES
CREATE TABLE IF NOT EXISTS `LIKES` (
	`authorLike` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'email del usuario que hizo like en el post', 
	`likePost` int (9) NOT NULL COMMENT 'id del post en el que se hizo like',
	PRIMARY KEY (`authorLike`,`likePost`),
	FOREIGN KEY (`authorLike`) REFERENCES USERS(email),
	FOREIGN KEY (`likePost`) REFERENCES POST(idPost) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de likes';	

-- creacion de la tabla COMMENTS
CREATE TABLE IF NOT EXISTS `COMMENTS` (
	`idComment` INT(5) NOT NULL AUTO_INCREMENT COMMENT 'id del comentario, unico y auto incremental',
	`dateComment` timestamp COLLATE utf8_spanish_ci NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha y hora en la que es creado el comentario, no puede ser nulo',
	`content` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Contenido del post. No puede ser nulo.',	
	`numLikes` int(4) DEFAULT '0' COMMENT 'Numero de likes que tiene el comentario, 0 por defecto',
	`author` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'email del usuario que hizo el comentario',
	`idPost` int (9) NOT NULL COMMENT 'id del post en el que se hizo like',
	PRIMARY KEY (`idComment`),
	FOREIGN KEY (`author`) REFERENCES `USERS`(`email`),
	FOREIGN KEY (`idPost`) REFERENCES `POST`(`idPost`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de comentarios' AUTO_INCREMENT=1;

-- insercion de datos de ejemplo
INSERT INTO `USERS` (`email`, `password`, `name`) VALUES
('jeni@gmail.com', 'jeni', 'jenifer vazquez rey'),
('adri@gmail.com', 'adri', 'adrian celix fernandez'),
('tggomez@gmail.com', 'tamara', 'tamara gonzalez gomez'),
('luis@gmail.com', 'luis', 'luis martinez gomez'),
('carlos@gmail.com', 'carlos', 'carlos sanchez valencia'),
('ramon@gmail.com', 'ramon', 'ramon lopez gomez'),
('llperez@gmail.com', 'laura', 'laura lorenzo perez'),
('martin@gmail.com', 'martin', 'martin casares perez'),
('oscar@gmail.com', 'oscar', 'oscar sanchez valencia'),
('julian@gmail.com', 'julian', 'julian lopez gomez'),
('victor@gmail.com', 'victor', 'victor lorenzo perez'),
('carmen@gmail.com', 'carmen', 'carmen casares perez'),
('marta@gmail.com', 'marta', 'marta perez perez');

INSERT INTO `POST` (`idPost`, `datePost`, `content`, `numLikes`,`author`) VALUES
(1, '2014-11-10 23:00:00', 'Hola este es un post de prueba para la pagina. espero que salga bien', 4,'jeni@gmail.com'),
(2, '2014-11-9 22:00:00', 'que tal estas, te gusta la pagina?', 9, 'adri@gmail.com'),
(3, '2014-11-9 18:00:00', 'Si la pagina esta muy bien', 0,'tggomez@gmail.com'),
(4, '2014-11-7 23:00:00', 'Esto es una red social', 2,'llperez@gmail.com');

INSERT INTO `FRIENDS` (`userEmail`, `friendEmail`, `isFriend`) VALUES
('adri@gmail.com','jeni@gmail.com',true),
('adri@gmail.com','tggomez@gmail.com',true),
('adri@gmail.com','llperez@gmail.com',true),

('carlos@gmail.com','adri@gmail.com',false),
('ramon@gmail.com','adri@gmail.com',false),
('luis@gmail.com','adri@gmail.com',false),
('oscar@gmail.com','adri@gmail.com',false),
('julian@gmail.com','adri@gmail.com',false),
('victor@gmail.com','adri@gmail.com',false),
('carmen@gmail.com','adri@gmail.com',false),

('adri@gmail.com','marta@gmail.com',false);


INSERT INTO `COMMENTS` (`idComment`,`dateComment`,`content`,`numLikes`,`author`,`idPost`) VALUES
(1,'2014-11-10 23:00:00','Comentario de prueba',0,'adri@gmail.com',1),
(2,'2014-11-10 23:00:00','Comentario de prueba 2',0,'jeni@gmail.com',1),
(3,'2014-11-10 23:00:00','Comentario de prueba 3',0,'tggomez@gmail.com',1),
(4,'2014-11-10 23:00:00','Comentario de prueba 4',0,'adri@gmail.com',2),
(5,'2014-11-10 23:00:00','Comentario de prueba 5',0,'llperez@gmail.com',1);












