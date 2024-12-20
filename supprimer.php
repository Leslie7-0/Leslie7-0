<?php
require_once('db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'utilisateur de la base de données
    $sql = "DELETE FROM utilisateurs WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    // Rediriger vers verification.php après la suppression réussie
    header("Location: verification.php");
    exit();
} else {
    echo "Identifiant d'utilisateur non spécifié.";
}
?>