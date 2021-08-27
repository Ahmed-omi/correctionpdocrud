<?php

$SQL['host']="localhost";
$SQL['user']="root";
$SQL['pass']="narbonne12";
$SQL['base']="educate";

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forget Password</title>

        <link rel="" href="">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


        <?php
        if(isset($_GET['mail'])){

            $Mail=htmlentities($_GET['mail'],ENT_QUOTES,"UTF-8");
            $mysqli=mysqli_connect($SQL['host'],$SQL['user'],$SQL['pass'],$SQL['base']);
            if(!$mysqli) {
                echo "Erreur connexion BDD";
                echo "<br>Erreur retournée: ".mysqli_connect_error();

            } else {
                $req=mysqli_query($mysqli,"SELECT * FROM users WHERE mail='$Mail'");
                if(mysqli_num_rows($req)==1){

                    $NouveauPass=substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,5);

                    mysqli_query($mysqli,"UPDATE users SET mdp='".md5($NouveauPas)."' WHERE mail='$Mail'");

                    mail($Mail,"your new passowrd is","your new password is: $NouveauPass (new password)");

                    mysqli_query($mysqli,"DELETE FROM users WHERE mail='$Mail'");
                    echo "your new password is sent to your email .";
                } else {
                    echo "Lien incorrect.";
                }
            }
        } else {

            if(isset($_POST['valider'])){

                if(empty($_POST['mail'])){
                    echo "This email is not registered.";
                } else {

                    $mysqli=mysqli_connect($SQL['host'],$SQL['user'],$SQL['pass'],$SQL['base']);
                    if(!$mysqli) {
                        echo "Erreur connexion BDD";


                    } else {

                        $Mail=htmlentities($_POST['mail'],ENT_QUOTES,"UTF-8");
                        $req=mysqli_query($mysqli,"SELECT * FROM users WHERE mail='$Mail'");

                        if(mysqli_num_rows($req)!=1){

                        } else {

                            $Code=md5(rand(1,99999999));
                            mysqli_query($mysqli,"INSERT INTO users , mail='$Mail'");
                            $Lien=$_SERVER['HTTP_HOST']."/forget-passord.php?&mail=$Mail";
                            mail($Mail,"","to recover your password click here: $Lien");
                        }
                        echo "<p>.<a href='index1.php'> back to login page</a></p>";
                        $TraitementFini=true;
                    }
                }
            }
            if(!isset($TraitementFini)){
                ?>


        <div class="registration-form">
            <form method="post"	action="forget-passord.php">
                <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div>
                <div class="pass text-center" ><h2>Forget your password?</h2>
                    <p>write an email to process the process !.</p>
                </div>
                <div class="form-group">
                    <input type="text" name="mail" class="form-control item" id="username" placeholder="Adresse email" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="valider" class="btn btn-block create-account">Rewrite your password</button>
                    <br>
                    <a href="http://localhost/curd%20pdo/PDo%20pHp/crud/index1.php">Back to Login Page</a>
                </div>
            </form>
            <div class="social-media">
                <h5>contact us</h5>
                <div class="social-icons">
                    <a href="https://www.facebook.com/Metallica" target="_blank"><i class="icon-social-facebook" title="Facebook" ></i></a>
                    <a href="mailto:muratbenjamin1@gmail.com" target="_blank"><i class="icon-social-google" title="Google"></i></a>
                    <a href="https://twitter.com/Stranger_Things" target="_blank"><i class="icon-social-twitter" title="Twitter" target="_blank"></i></a>
                </div>
            </div>
        </div>


        <?php

              }
            }

        ?>


        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="script.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    </body>
</html>
