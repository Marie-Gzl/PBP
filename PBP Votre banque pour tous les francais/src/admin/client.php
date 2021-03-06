<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include '../modules/includes.php';?>

    <title>Client</title>
</head>

<body class="container">
    <?php
$PAGE_TYPE = 'CONSEILLER';
include '../modules/is-logged-in.php';?>

    <?php include '../modules/navbar-admin.php';?>

    <?php
// On se connecte à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// -----------------------------
// -----------------------------
// Initialisation des données
// -----------------------------
// -----------------------------
// On récupère l'ID passé dans la requête GET
$idClient = $_GET['client'];

//On récupère le client grâce à son id
// On prépare la requête
$reqClient = $bdd->prepare("SELECT client.*, agence.* FROM client as client JOIN agence as agence on agence.id_agence = client.id_agence WHERE client.id_client = :idClient");
// On l'éxecute
$reqClient->execute([":idClient" => $idClient]);
// On met de côté le résultat
$client = $reqClient->fetch(PDO::FETCH_OBJ);

//On récupère les comptes du client
$reqComptes = $bdd->prepare("SELECT compte.*, agence.* FROM compte as compte JOIN agence as agence on agence.id_agence = compte.id_agence  WHERE id_client = :idClient");
$reqComptes->execute([":idClient" => $idClient]);
$comptes = $reqComptes->fetchAll(PDO::FETCH_OBJ);

//On récupère les agences
$reqAgences = $bdd->prepare("SELECT * FROM agence");
$reqAgences->execute();
$agences = $reqAgences->fetchAll(PDO::FETCH_OBJ);

//On récupère les beneficiaires du client
$reqBeneficiaires = $bdd->prepare("SELECT * FROM beneficiaire WHERE id_client = :idClient");
$reqBeneficiaires->execute([':idClient' => $idClient]);
$beneficiaires = $reqBeneficiaires->fetchAll(PDO::FETCH_OBJ);

//On récupère les demandes associées au client
$reqDemandes = $bdd->prepare("SELECT * FROM demande WHERE id_client = :idClient ORDER BY date");
$reqDemandes->execute([':idClient' => $idClient]);
$demandes = $reqDemandes->fetchAll(PDO::FETCH_OBJ);

// -----------------------------
// -----------------------------
// Methodes insert et updates
// -----------------------------
// -----------------------------
// Si un paramètre 'bdObject' a été passé avec la requête POST
if (isset($_POST['dbObject']) ){
    // Si ce paramètre contient la valeur 'client'
    if ($_POST['dbObject'] == 'client') {
        // Mise à jour du client
        $reqUpdateClient = $bdd->prepare(
            "UPDATE client" .
            "    SET login=:login, " .
            "    password=:password, " .
            "    `type`=:type, " .
            "    nom=:nom, " .
            "    prenom=:prenom, " .
            "    date_naissance=:date_naissance, " .
            "    email=:email, " .
            "    telephone=:telephone, " .
            "    adresse=:adresse, " .
            "    id_agence=:agence " .
            "    WHERE id_client=:idClient");

        $reqUpdateClient->execute([
            ":login" => $_POST["email"],
            ":password" => $_POST["password"],
            ":type" => $_POST["type"],
            ":nom" => $_POST["nom"],
            ":prenom" => $_POST["prenom"],
            ":email" => $_POST["email"],
            ":adresse" => $_POST["adresse"],
            ":date_naissance" => $_POST["date_naissance"],
            ":telephone" => $_POST["telephone"],
            ":agence" => $_POST["agence"],
            ":idClient" => $idClient,
        ]);
    } else if ($_POST['dbObject'] == 'compte') {
        $reqGetMax = $bdd->prepare("SELECT COALESCE(MAX(id_compte), 0) FROM compte where id_agence = :idAgence");
        $reqGetMax->execute([":idAgence" => $client->id_agence]);
        $maxAccount = $reqGetMax->fetch();

        $cdPays='FR';
        $cleIban='76';
        $cdBanque=$client->cd_banque;
        $cdGuichet=$client->cd_guichet;
        $numeroCompte = str_pad($maxAccount[0] + 1 . "", 11, "0", STR_PAD_LEFT);
        $cleRib=str_pad(rand(0, 99) . "", 2, "0", STR_PAD_LEFT);
        $iban=$cdPays . $cleIban . $cdBanque . $cdGuichet . $numeroCompte . $cleRib;

        $reqInsertCompte = $bdd->prepare(
            "INSERT INTO compte" .
            " (`type`, numero_compte, id_client, solde, taux, decouvert, id_agence, cd_pays, cle_rib, cle_iban, iban)" .
            " VALUES(:type, :numero, :idClient, :solde, :taux, :decouvert, :idAgence, :cdPays, :cleRib, :cleIban, :iban)");

        $decouvert = 0;
        if (isset($_POST['decouvert'])) {
            $decouvert = 1;
        }
        $res = $reqInsertCompte->execute([
            ":type" => $_POST["type"],
            ":numero" => $numeroCompte,
            ":idClient" => $idClient,
            ":solde" => $_POST["solde"],
            ":taux" => $_POST["taux"],
            ":decouvert" => $decouvert,
            ":idAgence" => $client->id_agence,
            ":cdPays" => $cdPays,
            ":cleRib" => $cleRib,
            ":cleIban" => $cleIban,
            ":iban" => $iban,
        ]);

    } else if ($_POST['dbObject'] == 'beneficiaire') {
        $reqInsertBeneficiare = $bdd->prepare("INSERT INTO beneficiaire(id_client, libelle, iban, valide) VALUES(:idClient, :libelle, :iban, :valide)");
        $reqInsertBeneficiare->execute([
            ":idClient" => $idClient,
            ":libelle" => $_POST["libelle"],
            ":iban" => $_POST["iban"],
            ":valide" => TRUE,
        ]);
    }

    // On redirige toujours pas reset le formulaire dans le POST
    // cela empeche le resubmit avec le refresh F5
    header('Location:client.php?client=' . $idClient);
}


// -----------------------------
// -----------------------------
// Methodes delete
// -----------------------------
// -----------------------------
// Suppression d'un bénéficiaire
if (isset($_GET['deleteBeneficiaire']) ){
    $reqDeleteBeneficiare = $bdd->prepare("DELETE FROM  beneficiaire WHERE id_beneficiaire = :idBeneficiaire");
    $reqDeleteBeneficiare->execute([
        ":idBeneficiaire" => $_GET['deleteBeneficiaire'],
    ]);
// On redirige le client vers une autre page avec son ID en paramètre GET 
header('Location:client.php?client=' . $idClient);
}

// -----------------------------
// -----------------------------
// Autre méthodes custom
// -----------------------------
// -----------------------------
// Validation d'un bénéficiaire
if (isset($_GET['validateBeneficiaire']) ){
    $reqUpdateBeneficiare = $bdd->prepare("UPDATE beneficiaire SET valide = TRUE WHERE id_beneficiaire = :idBeneficiaire");
    $reqUpdateBeneficiare->execute([
        ":idBeneficiaire" => $_GET['validateBeneficiaire'],
    ]);
header('Location:client.php?client=' . $idClient);
}

?>


    <?php include 'client.html.php';?>


</body>

</html>