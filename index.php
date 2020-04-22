<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>class connexion</title>
</head>
<body>
    <?php require_once('class_connect.php')?>
    
    <form action="#" method="post">
        <input type="text" name="username" id="">
        <input type="password" name="password" id="">
        <input type="submit" name="send">
    </form>

    <?php
        if(isset($_POST['send'])){
            $verif = new login();
            $verif -> insertIntoTb($_POST['username'], $_POST['password']);
            foreach($verif->errors as $erreur) {
                echo $erreur;
            }
        }
    var_dump($_POST);
    ?>
</body>
</html>