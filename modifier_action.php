<?php
require_once('db.php');

if(isset($_POST['id'], $_POST['nom'], $_POST['email'], $_POST['mdp'])) {
    $id = $_POST['id'];
    $_nom = $_POST['nom'];
    $_email = $_POST['email'];
    $_mdp = $_POST['mdp'];
    $_tel = isset($_POST['tel']) ? $_POST['tel'] : null;

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $sql = "UPDATE utilisateurs SET nom = ?, email = ?, password = ?, phone = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_nom, $_email, $_mdp, $_tel, $id]);
    // Rediriger vers verification.php après la mise à jour réussie
    header("Location: verification.php");
    exit();
} else {
    echo "Données de modification manquantes.";
}
?>