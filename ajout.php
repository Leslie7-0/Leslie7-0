<?php
require_once('db.php');
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["btn"])) {
        if(!empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["tel"]) && isset($_FILES["toff"])) {
            // Récupérer les données du formulaire
            $nom = $_POST["nom"];
            $email = $_POST["email"]; 
            $mdp = $_POST["mdp"];
            $tel = $_POST["tel"];
            
            // Traitement du fichier téléchargé
            $file_name = $_FILES['toff']['name'];
            $file_tmp = $_FILES['toff']['tmp_name'];
            $file_destination = 'images/' . $file_name;
            move_uploaded_file($file_tmp, $file_destination);

            // Préparer la requête d'insertion
            $requete = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password, phone, destination) VALUES (:nom, :email, :password, :phone, :destination)");
            // Liaison des paramètres
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':email', $email);
            $requete->bindParam(':password', $mdp);
            $requete->bindParam(':phone', $tel);
            $requete->bindParam(':destination', $file_destination);
            
            // Exécuter la requête
            try {
                $requete->execute();
                echo "Utilisateur ajouté avec succès.";
            } catch(PDOException $e) {
                echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h2>Ajouter un utilisateur</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br><br>
            
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mdp" id="mot_de_passe" required><br><br>
            
        <label for="numero_telephone">Numéro de téléphone :</label>
        <input type="text" name="tel" id="numero_telephone"><br><br>
                
        <label for="toff">Photos :</label>
        <input type="file" name="toff" id="toff"><br><br>
        
        <input type="submit" name="btn" value="Ajouter">
    </form>
</body>
</html>