<?php
require_once('db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer les informations de l'utilisateur à modifier
    $sql = "SELECT * FROM utilisateurs WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($row) {
        // Afficher le formulaire avec les informations de l'utilisateur à modifier
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
</head>
<body>
    <h2>Modifier Utilisateur</h2>
    <form action="modifier_action.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo $row['nom']; ?>" required><br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required> <br><br>
    
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mdp" id="mot_de_passe" value="<?php echo $row['password']; ?>" required><br><br>
    
        <label for="numero_telephone">Numéro de téléphone :</label>
        <input type="text" name="tel" id="numero_telephone" value="<?php echo $row['phone']; ?>"><br><br>
        
        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>
<?php
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Identifiant d'utilisateur non spécifié.";
}
?>
