<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <link rel="shortcut icon" href="">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="">
    </head>
    <body>


<?php
session_start();
try{
$con = new PDO ("mysql:host=localhost;dbname=educate","root","narbonne12");
if(isset($_POST['signup'])){
 $name = $_POST['name'];
 $email = $_POST['email'];
 $pass = $_POST['pass'];

 $insert = $con->prepare("INSERT INTO users (name,email,pass)
values(:name,:email,:pass) ");
$insert->bindParam(':name',$name);
$insert->bindParam(':email',$email);
$insert->bindParam(':pass',$pass);

$insert->execute();
}elseif(isset($_POST['signin'])){
 $email = $_POST['email'];
 $pass = $_POST['pass'];

 $select = $con->prepare("SELECT * FROM users WHERE email='$email' and pass='$pass'");
 $select->setFetchMode(PDO::FETCH_ASSOC);
 $select->execute();
 $data=$select->fetch();
 if($data['email']!=$email and $data['pass']!=$pass)
 {
  echo "invalid email or pass";
 }
 elseif($data['email']==$email and $data['pass']==$pass)
 {
 $_SESSION['email']=$data['email'];
    $_SESSION['name']=$data['name'];
header("location:index.php");
 }
 }
}
catch(PDOException $e)
{
echo "error".$e->getMessage();
}
?>

<div style="width:500px ; height:600px; float:left;">
<div style="padding:85px;">
<h3>Create Account Here</h3>
<form method="post">
<input type="text" name="name" placeholder="User Name"><br><br>
<input type="text" name="email" placeholder="example@example.com"><br><br>
<input type="text" name="pass" placeholder="**********"><br><br>


<input type="submit" name="signup" value="SIGN UP">
</form>
</div>
</div>
<div style="width:500px ; float:right; height:600px;">
<div style="padding:85px;padding-right:200px;">

<h3>Log In Here</h3>
<form method="post">
<input type="text" name="email" placeholder="example@example.com"><br><br>
<input type="text" name="pass" placeholder="**********"><br><br>
<input type="submit" name="signin" value="SIGN IN">
<br>
<br>
 <a href="http://localhost/curd%20pdo/PDo%20pHp/crud/forget-passord.php">Forget password?</a>
</div>
</div>
