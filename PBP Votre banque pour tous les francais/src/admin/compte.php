<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include '../modules/includes.php';?>

    <title>Compte bancaire</title>
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
$idCompte = $_GET['compte'];

//Client
//$reqClient = $bdd->prepare("SELECT client.*, agence.* FROM client as client JOIN agence as agence on agence.id_agence = client.id_agence WHERE client.id_client = :idClient");
//$reqClient->execute([":idClient" => $idClient]);
//$client = $reqClient->fetch(PDO::FETCH_OBJ);

//Comptes
$reqCompte = $bdd->prepare("SELECT compte.*, agence.* FROM compte as compte JOIN agence as agence on agence.id_agence = compte.id_agence  WHERE id_compte = :idCompte");
$reqCompte->execute([":idCompte" => $idCompte]);
$compte = $reqCompte->fetch(PDO::FETCH_OBJ);

// On assemble les différentes parties de l'iban
$iban=$compte->cd_pays . $compte->cle_iban . $compte->cd_banque . $compte->cd_guichet . $compte->numero_compte . $compte->cle_rib;

//Operations
$reqOperations = $bdd->prepare("SELECT * FROM operation WHERE type = 'VERSEMENT' AND compte_debit = :idCompte OR compte_credit = :idCompte ORDER BY date_execution DESC");
$reqOperations->execute([":idCompte" => $idCompte]);
$operations = $reqOperations->fetchAll(PDO::FETCH_OBJ);

// -----------------------------
// -----------------------------
// Methodes insert et updates
// -----------------------------
// -----------------------------
if (isset($_POST['dbObject']) ){
    if ($_POST['dbObject'] == 'operation') {
        $montantOperation = $_POST['montant'];
        $destinataireOperation = $_POST['destinataire'];

        if ($montantOperation > $compte->solde) {
            echo "<script>alert(\"Transaction impossible montant trop élevé\")</script>"; 
        }

        $reqFindCompteForIban =  $bdd->prepare("SELECT * FROM compte WHERE iban = :iban");
        $reqFindCompteForIban->execute([":iban"=>$destinataireOperation]);
        $compteDestinataire = $reqFindCompteForIban->fetch(PDO::FETCH_OBJ);

        if ($reqFindCompteForIban->rowCount() != 1){
            echo "<script>alert(\"Le compte destinataire n'existe pas\")</script>"; 
        }
        else {
            $reqInsertOperation = $bdd->prepare(
                "INSERT INTO operation (compte_debit, compte_credit, type, date_execution, montant, description)".
                "VALUES(:compteDebit, :compteCredit, :type, :dateExecution, :montant, :description)");

            $reqInsertOperation->execute([
                ":compteCredit"=> $compteDestinataire->id_compte,
                ":compteDebit"=> $idCompte,
                ":type"=>'VERSEMENT',
                ":dateExecution"=>date("Y-m-d H:i:s"),
                ":montant"=>$montantOperation,
                ":description"=>$_POST["description"],
            ]);

            $soldeDestinataire = $compteDestinataire->solde + $montantOperation;
            $soldeSource = $compte->solde - $montantOperation;

            $reqUpdateDestinataire=$bdd->prepare("UPDATE compte SET solde = :solde WHERE id_compte = :idCompte");
            $reqUpdateDestinataire->execute([
                ":solde"=> $soldeDestinataire,
                ":idCompte"=> $compteDestinataire->id_compte,
            ]);

            $reqUpdateSource=$bdd->prepare("UPDATE compte SET solde = :solde WHERE id_compte = :idCompte");
            $reqUpdateSource->execute([
                ":solde"=> $soldeSource,
                ":idCompte"=> $idCompte,
            ]);

            header('Location:compte.php?client=' . $idClient.'&compte='.$idCompte);
        }
    }
}

// -----------------------------
// -----------------------------
// Autre méthodes custom
// -----------------------------
// -----------------------------
if (isset($_GET['decouvert']) ){
    $reqUpdateCompte = $bdd->prepare("UPDATE compte SET decouvert = ".$_GET['decouvert']." WHERE id_compte = :idCompte");
    $reqUpdateCompte->execute([
        ":idCompte" => $idCompte,
    ]);

    header('Location:compte.php?client=' . $idClient.'&compte='.$idCompte);
}


?>


    <?php include 'compte.html.php';?>


</body>

</html>