<?php


function IsyringDb($query){
			$connection = new mysqli("localhost","root","","BookLibrary");
			if ($connection->connect_error) die($connection->connect_error);
			$result = $connection->query($query);
			if (!$result) die($connection->error);
		 }

	function setBase(){
		
		IsyringDb("CREATE TABLE books(book_id int auto_increment PRIMARY KEY, title varchar(32), wrote  varchar(16), pages int, description varchar(32))");# создаем табличку для теста

		IsyringDb("CREATE TABLE autors(autor_id int auto_increment PRIMARY KEY, name varchar(32), description varchar(32))");# создаем табличку для теста

		IsyringDb("CREATE TABLE book_autor(id int auto_increment PRIMARY KEY, book_id int, autor_id int)");# создаем табличку для теста

		IsyringDb("INSERT INTO autors(name, description ) VALUES ('Брюс ли', 'УОООА'), ('Джеки ЧАН', 'УА УА УА'), ('Чак Норрис', 'Чмаф Чмаф')");

		IsyringDb("INSERT INTO books(title, wrote, pages, description) VALUES ('Смертельный удар', 1996, 300, 'УУААИИИ пуф'), ('Коготь дракона', 1986, 450, 'вжик вжик иииу'), ('Время КунгФу', 2001, 115, 'фух фух дзынь дзынь ауф'), ('Железный кулак', 2015, 500, 'хэ хи пффф')");

		IsyringDb("INSERT INTO book_autor(book_id, autor_id) VALUES (1, 1), (1, 2), (2, 2), (3, 3), (4, 3)");# Заполняем для теста
		
	}
	setBase();
	header("Location: index.html");