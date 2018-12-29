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
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// -----------------------------
// -----------------------------
// Initialisation des données
// -----------------------------
// -----------------------------
$idClient = $_GET['client'];

//Client
$reqClient = $bdd->prepare("SELECT client.*, agence.* FROM client as client JOIN agence as agence on agence.id_agence = client.id_agence WHERE client.id_client = :idClient");
$reqClient->execute([":idClient" => $idClient]);
$client = $reqClient->fetch(PDO::FETCH_OBJ);

//Comptes
$reqComptes = $bdd->prepare("SELECT compte.*, agence.* FROM compte as compte JOIN agence as agence on agence.id_agence = compte.id_agence  WHERE id_client = :idClient");
$reqComptes->execute([":idClient" => $idClient]);
$comptes = $reqComptes->fetchAll(PDO::FETCH_OBJ);

//Agences dans la picklist
$reqAgences = $bdd->prepare("SELECT * FROM agence");
$reqAgences->execute();
$agences = $reqAgences->fetchAll(PDO::FETCH_OBJ);

//Beneficiaires
$reqBeneficiaires = $bdd->prepare("SELECT * FROM beneficiaire WHERE id_client = :idClient");
$reqBeneficiaires->execute([':idClient' => $idClient]);
$beneficiaires = $reqBeneficiaires->fetchAll(PDO::FETCH_OBJ);

//Demandes
$reqDemandes = $bdd->prepare("SELECT * FROM demande WHERE id_client = :idClient ORDER BY date");
$reqDemandes->execute([':idClient' => $idClient]);
$demandes = $reqDemandes->fetchAll(PDO::FETCH_OBJ);

// -----------------------------
// -----------------------------
// Methodes insert et updates
// -----------------------------
// -----------------------------
if (isset($_POST['dbObject']) ){
    if ($_POST['dbObject'] == 'client') {
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
    // celaempeche le resubmit avec le refresh F5
    header('Location:client.php?client=' . $idClient);
}


// -----------------------------
// -----------------------------
// Methodes delete
// -----------------------------
// -----------------------------
if (isset($_GET['deleteBeneficiaire']) ){
    $reqDeleteBeneficiare = $bdd->prepare("DELETE FROM  beneficiaire WHERE id_beneficiaire = :idBeneficiaire");
    $reqDeleteBeneficiare->execute([
        ":idBeneficiaire" => $_GET['deleteBeneficiaire'],
    ]);
header('Location:client.php?client=' . $idClient);
}

// -----------------------------
// -----------------------------
// Autre méthodes custom
// -----------------------------
// -----------------------------
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