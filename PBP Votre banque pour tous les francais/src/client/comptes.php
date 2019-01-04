<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include '../modules/includes.php';?>

    <title>Comptes</title>
</head>

<body class="container">
    <?php
            $PAGE_TYPE = 'CLIENT';
            include '../modules/is-logged-in.php';?>

    <?php include '../modules/navbar.php';?>


    <?php
        // Accès à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

        // On récupère les comptes chèque
        $reqCheque=$bdd->prepare("SELECT * FROM compte WHERE id_client = :idClient AND type = 'cheque'");
        $reqCheque->execute([':idClient' => $_SESSION["connectedUser"]->id_client]);
        $comptesCheque = $reqCheque->fetchAll(PDO::FETCH_OBJ);
//        var_dump($comptesCheque);

        // On récupère les comptes épargne
        $reqEpargne=$bdd->prepare("SELECT * FROM compte WHERE id_client = :idClient AND type = 'epargne'");
        $reqEpargne->execute([':idClient' => $_SESSION["connectedUser"]->id_client]);
        $comptesEpargne = $reqEpargne->fetchAll(PDO::FETCH_OBJ);
//        var_dump($comptesEpargne);
    ?>

    <?php include 'comptes.html.php';?>

</body>

</html>