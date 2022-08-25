<?php
/* Connexion à une base MySQL avec l'invocation de pilote */
try{
    $db_name = 'ajaxadduser';
    $user = 'root';
    $password = '';

    $connection = new PDO("mysql:dbname=$db_name;host=127.0.0.1", $user, $password);

}catch(PDOException $e){
    echo $e->getMessage();
}

?>