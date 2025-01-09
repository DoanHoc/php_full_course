<?php
require_once "./5.pdo_class.php";
$db =  new Database("localhost","w3schools","root","");
// $arr_data ="ca";
// $db->update("categories",$arr_data,"CategoryID = 1",true);
$r2 =  $db->getAll("categories","*","");
$r2 =  $db->getAll("users","*","");
$r2 =  $db->getAll("user_details","*","");
$r2 =  $db->getAll("suppliers","*","");
$r2 =  $db->getAll("shippers","*","");
var_dump($r2);
unset($db);