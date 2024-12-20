<?php
session_start();
/*
    require_once('db.php');
    if(isset($_POST["btn"])){
        if(!empty($_POST["nom"]) AND !empty($_POST["email"]) AND !empty($_POST["mdp"]) AND !empty($_POST["tel"]) AND isset($_FILES["toff"])){
            $_nom = $_POST["nom"];
            $_email = $_POST["email"];
            $_mdp = $_POST["mdp"];
            $_tel = $_POST["tel"];
            $element = array("png","jpeg","jpg");
            $file_name = $_FILES['toff']['name'];
            $file_name=$nom.$file_name;
            $file_tmp = $_FILES['toff']['tmp_name'];
            $file_destination='images'.$file_name;
            $file_extension=pathinfo($file_name,PATHINFO_EXTENSION);
            if(in_array(strtolower($file_extension), $element)){
                //on change le nom
                if(move_uploaded_file($file_tmp,$file_destination)){
                    echo '<script>alert("image enregistrer avec succes")</script>';   
                }
            }
            die(var_dump($_FILES['toff']));
            // verification de l'email.
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){


            } else{
                echo '<script>alert("veillez entrer votre email!")</script>';
            }

            }else{
            echo '<script>alert("veillez  remplir tous les champs!")</script>';
            }
            
        }*/
        
        
require_once('db.php');
            if(isset($_POST["btn"])) {
            if(!empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["tel"]) && isset($_FILES["toff"])) {
                $_nom = $_POST["nom"];
                $_email = $_POST["email"];
                $_mdp = $_POST["mdp"];
                $_tel = $_POST["tel"];
                $_toff = $_FILES["toff"];
        
                // Vérifiez le type de fichier pour sécuriser l'upload
                $element = array("png","jpeg","jpg");
                $file_name = $_FILES['toff']['name'];
                $file_name=$_nom.$file_name;
                $file_tmp = $_FILES['toff']['tmp_name'];
                $file_destination='images/'.$file_name;
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
              if(in_array(strtolower($file_extension), $element)) {
                    if(move_uploaded_file($file_tmp, $file_destination)) {
                        echo '<script>alert("image enregistrer avec succes")</script>';   
                    }
                }
        
                // Validation de l'email
                if(filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    // Insertion des données dans la base de données
                    $sql = "INSERT INTO utilisateurs (nom, email, password, phone,destination) VALUES (?, ?, ?, ?,?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$_nom, $_email, $_mdp, $_tel, $file_destination/* $_nom_fichier*/]);
                  // Redirection vers la page de vérification
                    header("Location: verification.php");
                    exit(); // Assurez-vous de quitter le script après la redirection
                } else {
                    echo '<script>alert("veillez entrer votre email!")</script>';
                }
            } else {
                echo '<script>alert("veillez remplir tous les champs!")</script>';
            }
        }
?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="styles.css"> 
            <title>Inscription Utilisateur</title>
        </head>
        <body>
           <h2>Inscription</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required><br><br>
        
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required><br><br>
            
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" name="mdp" id="mot_de_passe" required><br><br>
            
                <label for="numero_telephone">Numéro de téléphone :</label>
                <input type="text" name="tel" id="numero_telephone"><br><br>
                
                <label for="toff">photos :</label>
                <input type="file" name="toff" id="toff"><br><br>
        
                <input type="submit" value="Inscrire" name="btn"><br> <br>
                
                <div>
                    <a href="verification.php">Voulez-vous vérifier vos informations?</a>
                </div> 
        </form>
        </body>
 </html>