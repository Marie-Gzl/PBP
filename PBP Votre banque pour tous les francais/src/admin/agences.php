<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include '../modules/includes.php';?>

    <title>Agences</title>
</head>

<body class="container">

    <?php
$PAGE_TYPE = 'CONSEILLER';
include '../modules/is-logged-in.php';?>

    <?php include '../modules/navbar-admin.php';?>

    <?php
// On se connecte à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// Si la variable POST contient bien les champs requis
if (isset( $_POST["adresse"],$_POST["description"], $_POST["cd_banque"], $_POST["cd_guichet"])) {
    // Alors on prépare la requête SQL
    $reqInsertAgence = $bdd->prepare(
        "INSERT INTO agence" .
        "(adresse, description, cd_banque, cd_guichet)" .
        "VALUES(:adresse, :description, :cd_banque, :cd_guichet)");
    // Puis on éxecute la requête
    $reqInsertAgence->execute([
        ":adresse" => $_POST["adresse"],
        ":description" => $_POST["description"],
        ":cd_banque" => $_POST["cd_banque"],
        ":cd_guichet" => $_POST["cd_guichet"],
    ]);
    // Et on redirige vers une autre page
    header('Location:agences.php');
}

// On récupère la liste des agences
$reqAgences = $bdd->prepare("SELECT * FROM agence ORDER BY id_agence");
$reqAgences->execute();
$agences = $reqAgences->fetchAll(PDO::FETCH_OBJ);

?>

    <?php include './agences.html.php';?>

</body>

</html>