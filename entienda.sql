DROP TABLE IF EXISTS users_products;
DROP TABLE IF EXISTS users;

DROP TABLE IF EXISTS developers_groups;
DROP TABLE IF EXISTS developers;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS groups;

DROP TABLE IF EXISTS engines_versions;
DROP TABLE IF EXISTS engines;

CREATE TABLE users (
	id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user VARCHAR(16) NOT NULL,
	name VARCHAR(24) NOT NULL,
	surname VARCHAR(48) NOT NULL,
	password CHAR(32) NOT NULL,
	email VARCHAR(32) NOT NULL,
	birthdate DATE NOT NULL,
	registered DATETIME NOT NULL DEFAULT now(),
	admin BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE developers (
	id_developer INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL,
	surname VARCHAR(48) NOT NULL,
	email VARCHAR(32) NOT NULL,
	website VARCHAR(255) NOT NULL,
	birthdate DATE NOT NULL
);

CREATE TABLE groups (
	id_group INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`group` VARCHAR(32) NOT NULL,
	course INT NOT NULL,
	jam_year YEAR NOT NULL,
	mark FLOAT NOT NULL
);

CREATE TABLE developers_groups (
	id_developer_group INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_developer INT UNSIGNED NOT NULL,
	id_group INT UNSIGNED NOT NULL,
	FOREIGN KEY (id_developer) REFERENCES developers(id_developer),
	FOREIGN KEY (id_group) REFERENCES groups(id_group)
);

CREATE TABLE engines (
	id_engine INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	engine VARCHAR(32) NOT NULL
);

CREATE TABLE engines_versions (
	id_engine_version INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	version VARCHAR(24) NOT NULL,
	id_engine INT UNSIGNED NOT NULL,
	FOREIGN KEY (id_engine) REFERENCES engines(id_engine)
);

CREATE TABLE products (
	id_product INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	product VARCHAR(128) NOT NULL,
	description TEXT NOT NULL,
	price DECIMAL(6,2) NOT NULL,
	reference VARCHAR(8) NOT NULL,
	discount INT NOT NULL,
	units_sold INT UNSIGNED NOT NULL,
	website VARCHAR(255) NOT NULL,
	`size` INT NOT NULL,
	duration INT NOT NULL,
	release_date DATE NOT NULL,
	id_group INT UNSIGNED NOT NULL,
	id_engine_version INT UNSIGNED NOT NULL,
	FOREIGN KEY (id_group) REFERENCES groups(id_group),
	FOREIGN KEY (id_engine_version) REFERENCES engines_versions(id_engine_version)
);

CREATE TABLE users_products (
	id_user_product INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_user INT UNSIGNED NOT NULL,
	id_product INT UNSIGNED NOT NULL,
	FOREIGN KEY (id_user) REFERENCES users(id_user),
	FOREIGN KEY (id_product) REFERENCES products(id_product)
	);

INSERT INTO users (user, name, surname, password, email, birthdate, admin) VALUES ('root', 'Pedro', 'Fernandez', md5('enti'), 'root@root.com', '0000-00-00', true);

INSERT INTO users (user, name, surname, password, email, birthdate, admin) VALUES ('Ale', 'Alejandro', 'Plutonio', md5('enti'), 'ale@jandro.com', '0000-00-01', false);

INSERT INTO users (user, name, surname, password, email, birthdate, admin) VALUES ('enti', 'Richard', 'Plutonio', md5('enti'), 'richard@enti.com', '0000-00-02', false);

INSERT INTO engines (engine)
VALUES ('Unity'), ('Unreal');

INSERT INTO engines_versions (version, id_engine)
VALUES ('2019', 1), ('4',2);

INSERT INTO developers (name, surname, email, website, birthdate)
VALUES ('Pedro', 'Fernandez Gomez', 'pedro.fernandez@enti.cat', 'pedrofg.com', '2001-07-07');

INSERT INTO groups (`group`, course, jam_year, mark)
VALUES ('Grupo04', 2, 2021, 10);

INSERT INTO developers_groups (id_developer, id_group)
VALUES (1,1);

INSERT INTO products (product, description, price, reference, discount, units_sold, website, `size`, duration, release_date, id_group, id_engine_version)
VALUES ('CocoRun', 'Jam Winner', 4.99, 'EFDF', 5, 32, 'CocoRun.com', 10, 999, '2021-05-23', 1, 1);

INSERT INTO products (product, description, price, reference, discount, units_sold, website, `size`, duration, release_date, id_group, id_engine_version)
VALUES ('Parade', 'Second best Jam game', 0.99, 'PREG', 5, 12,'Parade.com', 17, 12, '2021-09-03', 1, 2);

INSERT INTO products (product, description, price, reference, discount, units_sold, website, `size`, duration, release_date, id_group, id_engine_version)
VALUES ('Beleth', 'Un juego aprobable de DAM-VIOD', 10.99, 'BNRT', 20, 102, 'Beleth.com', 67, 120, '2022-05-23', 1, 1);
