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
  `password` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Password del usuario, almacenada con un hash Bcrypt???????????????????????????',
  `name` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre y apellidos del usuario. Puede ser nulo.',
  `address` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Direccion postal (completa) del usuario. Puede ser nulo.',
  `numberPhone` int(9) DEFAULT NULL COMMENT 'Telefono de contacto (fijo o movil) del usuario. Puede ser nulo.',
  `otherDetails` varchar(255) DEFAULT NULL COMMENT 'Telefono de contacto (fijo o movil) del usuario. Puede ser nulo.',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de usuarios';

-- creacion de tabla POST
CREATE TABLE IF NOT EXISTS `POST` (
  `idPost` int(40) NOT NULL AUTO_INCREMENT COMMENT 'id del post, unico y auto incremental',
  `datePost` timestamp COLLATE utf8_spanish_ci NOT NULL COMMENT 'fecha y hora en la que es creado el post, no puede ser nulo',
  `content` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Contenido del post. No puede ser nulo.',
  `numLikes` int(4) NOT NULL COMMENT 'Numero de likes que tiene el post, no puede ser nulo',
  `author` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email del autor del post, no puede ser nulo, clave foranea a USER.email',
  PRIMARY KEY (`idPost`),
  FOREIGN KEY (`author`) REFERENCES `USERS` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de posts' AUTO_INCREMENT=1;

-- creacion de tabla FRIENDS
CREATE TABLE IF NOT EXISTS `FRIENDS` (
	`userEmail` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'email del usuario',
	`friendEmail` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'email del amigo',
	`isFriend` boolean DEFAULT FALSE,	
	PRIMARY KEY (`userEmail`,`friendEmail`),
	FOREIGN KEY (`userEmail`) REFERENCES USERS(email),
	FOREIGN KEY (`friendEmail`) REFERENCES USERS(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenamiento de amigos';




-- insercion de datos de ejemplo
INSERT INTO `USERS` (`email`, `password`, `name`, `address`, `numberPhone`, `otherDetails`) VALUES
('jeni@gmail.com', 'jeni', 'jenifer vazquez rey', 'ourense', 666666666, 'estoy creando la pagina'),
('adri@gmail.com', 'adri', 'adrian celix fernandez', 'ourense 2', 677777777, 'tambien estoy creando la pagina'),
('tggomez@gmail.com', 'tamara', 'tamara gonzalez gomez', 'ourense', 5555555, 'usara la red social'),
('llperez@gmail.com', 'laura', 'laura lorenzo perez', 'ourense', 11111111, 'esta en la red social');

INSERT INTO `POST` (`idPost`, `datePost`, `content`, `numLikes`,`author`) VALUES
(1, '2014-11-10 23:00:00', 'Hola este es un post de prueba para la pagina. espero que salga bien', 4,'jeni@gmail.com'),
(2, '2014-11-9 22:00:00', 'que tal estas, te gusta la pagina?', 9, 'adri@gmail.com'),
(3, '2014-11-9 18:00:00', 'Si la pagina esta muy bien', 0,'tggomez@gmail.com'),
(4, '2014-11-7 23:00:00', 'Esto es una red social', 2,'llperez@gmail.com');

INSERT INTO `FRIENDS` (`userEmail`, `friendEmail`, `isFriend`) VALUES
('jeni@gmail.com','adri@gmail.com',false),
('jeni@gmail.com','tggomez@gmail.com',false),
('jeni@gmail.com','llperez@gmail.com',false),
('adri@gmail.com','llperez@gmail.com',false);















