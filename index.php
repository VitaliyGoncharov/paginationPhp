<?php
/**
 * Options: 
 * 'create' => create database, table and fill with data
 * 'update' => remove old and fill with new data
 *  null => keeps current state
 */
$mode = null;

$connection = new mysqli("localhost", "root", "mysql");
require_once("./db_seeds.php");

$totalItemsObj = $connection->query("SELECT COUNT(*) as total FROM pages");
$totalItems = (int) ($totalItemsObj->fetch_assoc())["total"];
$itemsPerPage = 2;

$totalPages = ceil($totalItems / $itemsPerPage);

$curPage = (int) (!isset($_GET["page"]) ? 0 : $_GET["page"]);
if ($curPage < 1) {
	$curPage = 1;
} else if ($curPage > $totalPages) {
	$curPage = $totalPages;
}
echo "Total pages is {$totalPages}<br>";
echo "Current page is {$curPage}<br>";

$start_point = ($curPage - 1) * $itemsPerPage;
$pages = $connection->query("SELECT * FROM pages LIMIT {$start_point}, {$itemsPerPage}");

while ($row = $pages->fetch_assoc()) {
	echo $row['name'] . '<br>';
}
include_once("./home.html");