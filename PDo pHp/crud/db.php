<?php
$dsn = 'mysql:host=localhost;dbname=educate';
$username = 'root';
$password = 'narbonne12';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}
