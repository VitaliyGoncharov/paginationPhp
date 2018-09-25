<?php

$create_table = "CREATE TABLE pages (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL)
";

$insert_seeds = "
	INSERT INTO pages (name) VALUES ('apple'),('orange'),('banana'),('pineapple'),('grape'),('mandarin'),('cucumber'),('tomato'),('onion'),('garlic'),('carrot'),('pepper'),('beet'),('bean'),('broccoli'),('cabbage'),('cantaloupe'),('celery'),('corn'),('cowpeas'),('eggplant'),('endive'),('gourd'),('honeydew'),('horseradish'),('leek'),('melon'),('peanut'),('peas'),('potato'),('pumpkin'),('radicchio'),('radish'),('root crops'),('scallions'),('shallot'),('soybean'),('spinach'),('squash'),('swiss chard'),('turnip'),('watermelon')
";

switch ($mode) {
	case "create": {
		$connection->query("DROP DATABASE IF EXISTS shop");
		$connection->query("CREATE DATABASE shop");
		$connection->select_db("shop");
		if ($connection->query($create_table) == FALSE) {
			print_r("Can't create table" . $connection->error . "<br>");
		}
		if ($connection->query($insert_seeds) == FALSE) {
			print_r("Can't insert seeds" . $connection->error . "<br>");
		}
		break;
	}
	case "update": {
		$connection->select_db("shop");
		$connection->query("TRUNCATE pages");
		if ($connection->query($insert_seeds) == FALSE) {
			print_r("Can't insert seeds" . $connection->error . "<br>");
		}
		break;	
	}
	default: {
		$connection->select_db("shop");
		break;	
	}
}