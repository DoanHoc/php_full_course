<?php
require_once "pdo_class.php";
$db =  new Database("localhost","w3schools","root","");
$db->insert("categories",["CategoryName"=> "Hoc","CategoryID"=>"120"],true);
// unset($db);