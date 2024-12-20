<?php
// Destruction de la session
session_start();
session_unset();
session_destroy();
// Redirection vers la page de connexion
header('Location: formulaire.php');
exit;
?>
