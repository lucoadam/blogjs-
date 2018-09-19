<?php
/**
 * Created by PhpStorm.
 * User: Nashib
 * Date: 9/19/2018
 * Time: 11:31 AM
 */try{
    $pdo = new PDO('mysql:host=localhost; dbname=cms','root','');
}
catch(PDOException $e){

    exit('Database Error');
}

?>