<?php
require_once('db.php');
session_start();
$sql = "SELECT * FROM utilisateurs";
$result = $pdo->query($sql);
// Vérifier si un utilisateur est connecté
if(isset($_SESSION['utilisateur_connecte'])) {
    $utilisateur_connecte = $_SESSION['utilisateur_connecte'];
} else {
    $utilisateur_connecte = ""; // Si aucun utilisateur n'est connecté, laissez la variable vide
}
// Vérifier si l'utilisateur a cliqué sur le lien de déconnexion
if(isset($_GET['deconnexion'])) {
    session_destroy(); // Détruire toutes les données de la session
    header("Location: formulaire.php"); // Rediriger vers la page d'accueil après la déconnexion
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Liste des Utilisateurs</title>
</head>
<body>
<header>
    <div class="navbar">
   <!-- <img src="assets/image/logo.png"  class="logo" alt="logo fastfood"/>-->
   <ul>
        <li><a href="index.html">Accueil</a></li>
        <li>
            <a href="#">Utilisateurs <span>&#9660;</span></a>
            <select name="action" id="actions">
                <option value="">Sélectionnez une action :</option>
                <option value="formulaire.php">Liste</option>
                <option value="ajout.php">Ajouter</option>
            </select></li> <!-- Nouveau lien vers la page des utilisateurs -->

            <li><a href="#">Bienvenue</a>
            <select name="welcomeActions" id="welcomeActions">
                <option value="">Sélectionnez une action :</option>
                <option value="formulaire.php">Accueil</option>
                <option value="logout.php?deconnexion=true">Déconnexion</option>
            </select>
        </li> <!-- Nouveau lien vers la page des utilisateurs -->
            <li class="search-bar">
                    <form action="#" method="GET">
                        <input type="text" name="search" placeholder="Recherche...">
                        <button type="submit">Rechercher</button>
                    </form>
            </li>
        </ul>
    </div>
</header>
        </ul>
    </div>
</header><br>
<div class="container">
    <h2>Liste des Utilisateurs</h2>
    <ul class="user-list">
        <table border="1">
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro de téléphone</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><img src="<?= $row['destination']; ?>" width="100" height="100" alt="Photo Utilisateur"></td>
                <td>
                    <div class="user-links">
                        <a  href="modifier.php?id=<?php echo $row['id']; ?>"  class="btn-modifier">Modifier</a>
                        <a  href="supprimer.php?id=<?php echo $row['id']; ?>" class="btn-supprimer">Supprimer</a>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </ul>
</div>

<script>
    document.getElementById("userActionForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Empêcher l'envoi du formulaire par défaut

        // Récupérer la valeur sélectionnée dans la liste déroulante
        var selectedOption = document.getElementById("actions").value;

        // Rediriger l'utilisateur en fonction de la sélection
        if (selectedOption === "liste") {
            window.location.href = "verification.php";
        } else if (selectedOption === "ajouter") {
            window.location.href = "ajout.php";
        }
    });
</script>

<!-- PARTIE CSS -->

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Style du header */
header {
    background-color: #333;
    padding: 35px 0;
    color: white;
}

.navbar {
    text-align: center;
}

.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.navbar ul li {
    display: inline;
    margin-right: 100px;
}


.navbar ul li a {
    text-decoration: none;
    color: white;
    font-size: 20px;
}

.navbar ul li a:hover {
    color: #ffc107; /* Changement de couleur au survol */
}
.search-bar {
    float: right;
}

.search-bar input[type="text"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-right: 5px;
}

.search-bar button {
    padding: 5px 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
}

.search-bar button:hover {
    background-color: #ffc107;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
    text-align: center;
}

.user-list {
    list-style-type: none;
    padding: 0;
}

.user-list li {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-right: 20px;
}

.user-info p {
    margin: 0;
    font-weight: bold;
}

.user-links {
    margin-top: 10px;
}

.user-links a {
    text-decoration: none;
    color: #007bff;
    margin-right: 10px;
}

.user-links a:hover {
    text-decoration: underline;
}

 /*Style pour les liens de boutons */
 .user-links {
    margin-top: 10px; /* Ajoute un espace en haut des boutons */
    display: flex; /* Utilise Flexbox pour aligner les éléments horizontalement */
}

.user-links a {
    text-decoration: none; /* Supprime le soulignement par défaut des liens */
    color: #fff; /* Couleur du texte blanche */
    padding: 6px 12px; /* Ajoute un espace autour du texte */
    border-radius: 4px; /* Arrondit les coins du bouton */
    cursor: pointer; /* Définit le curseur de la souris en pointer */
    transition: background-color 0.3s; /* Ajoute une transition de couleur au survol */
    margin-right: 10px; /* Ajoute un espacement entre les boutons */
}

.user-links a.btn-modifier {
    background-color: #5462f1; /* Couleur de fond verte pour le bouton Modifier  #28a745*/
    margin-left: 10px; /* Ajoute un espacement à gauche du bouton Modifier */
}

.user-links a.btn-supprimer {
    background-color: #dc3545; /* Couleur de fond rouge pour le bouton Supprimer */
}

.user-links a.btn-modifier:hover,
.user-links a.btn-supprimer:hover {
    background-color: rgba(0, 0, 0, 0.1); /* Change la couleur de fond au survol */
}

footer{
    margin-top: auto; /* Le footer sera toujours en bas de la page */
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #333; /* Couleur de fond du pied de page */
    color: #fff; /* Couleur du texte */
    text-align: center; /* Centrez le texte */
    padding: 18px 0; 
}
.foot {
    color: #fff; /* Couleur du texte */
    text-align: center; /* Centrez le texte */
    padding: 18px 0; /* Espacement interne haut et bas */
}


 
 </style>

<script>
    document.getElementById("actions").addEventListener("change", function() {
        var selectedOption = document.getElementById("actions").value; // Récupérer la valeur sélectionnée

        // Rediriger l'utilisateur vers l'URL correspondante
        if (selectedOption !== "") {
            window.location.href = selectedOption;
        }
    });

    // Gestion de la redirection pour le menu de bienvenue
    document.getElementById("welcomeActions").addEventListener("change", function() {
        var selectedOption = this.value;
        if (selectedOption !== "") {
            window.location.href = selectedOption;
        }
    });

</script>
 <!-- FIN DU CSS-->

 <footer>
    <div class="foot">
        <p>CopyRight By MK Leslie</p>
    </div>
 </footer>
    </body>
</html>
