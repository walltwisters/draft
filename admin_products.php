<?php

require_once 'checkauth.php';
require_once 'views/admintemplate.php';

$homepage = new adminTemplate();
$titel = $homepage -> title = 'wally';

$content = $homepage -> content = '<div class=" desktop products hover">
            <a href="editproduct.php">add product</a>
            <a>delete product</a>
            <a href="listproducts.php">list products</a>
        </div>';
 

$homepage -> Display();

 ?>
 
 