<?php
require __DIR__ . '/vendor/autoload.php';

use Walltwisters\lib\model\User;
use Walltwisters\lib\model\Country;


require_once 'checkauth.php';
$user = unserialize($_SESSION['user']);
$menu = array("dashboard" => "#",
            "products" =>"/lists.php",
            "printer" => "addprinter.php",
            "view customer" => "#",
            "view orders" => "#",
            "view payments" => "#",
            "users" => "/adduser.php",
            "logout" => "/logout.php");

function IsURLCurrentPage($url){
   return strpos($_SERVER['PHP_SELF'], $url) !== false;
}

function DisplayLink($name,$url,$active=true){
    if ($active){
        echo "<li><a href='$url'><span>$name</span></a></li>";
    } else {
        echo "<div class='#'><span>$name</span></div>";
    }
}

?>