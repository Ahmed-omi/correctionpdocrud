<?php  session_start();
if(empty($_SESSION['email']))
{
 header("location:index1.php");
}else header("location:index.php");

?>

WELCOME :<?php echo $_SESSION['name']; ?>

<a href="Logout.php">Logout</a>
