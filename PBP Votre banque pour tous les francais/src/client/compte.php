<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <?php include '../modules/includes.php';?>

  <title>Comptes</title>
</head>


<body class="container">
    <?php
$PAGE_TYPE = 'CONSEILLER';
include '../modules/is-logged-in.php';?>

    <?php include '../modules/navbar.php';?>

    <?php
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// -----------------------------
// -----------------------------
// Initialisation des données
// -----------------------------
// -----------------------------
$idClient = $_SESSION["connectedUser"]->id_client;
$idCompte = $_GET['compte'];

//Client
//$reqClient = $bdd->prepare("SELECT client.*, agence.* FROM client as client JOIN agence as agence on agence.id_agence = client.id_agence WHERE client.id_client = :idClient");
//$reqClient->execute([":idClient" => $idClient]);
//$client = $reqClient->fetch(PDO::FETCH_OBJ);

// On récupère le compte grâce à son id
$reqCompte = $bdd->prepare("SELECT compte.*, agence.* FROM compte as compte JOIN agence as agence on agence.id_agence = compte.id_agence  WHERE id_compte = :idCompte");
$reqCompte->execute([":idCompte" => $idCompte]);
$compte = $reqCompte->fetch(PDO::FETCH_OBJ);

// On récupère les opérations liées au compte (débit et crédit)
$reqOperations = $bdd->prepare("SELECT * FROM operation WHERE type = 'VERSEMENT' AND compte_debit = :idCompte OR compte_credit = :idCompte ORDER BY date_execution DESC");
$reqOperations->execute([":idCompte" => $idCompte]);
$operations = $reqOperations->fetchAll(PDO::FETCH_OBJ);

// -----------------------------
// -----------------------------
// Methodes insert et updates
// -----------------------------
// -----------------------------
// Si on a reçu un paramètre dbObject avec la requête
if (isset($_POST['dbObject']) ){
    // Si on souhaite effectuer une nouvelle opération
    if ($_POST['dbObject'] == 'operation') {
        $montantOperation = $_POST['montant'];
        $destinataireOperation = $_POST['destinataire'];

        // On vérifie que l'on a les fonds nécessaires à cette opération
        if ($montantOperation > $compte->solde) {
            echo "<script>alert(\"Transaction impossible montant trop élevé\")</script>"; 
        }

        // On cherche le destinataire
        $reqFindCompteForIban =  $bdd->prepare("SELECT * FROM compte WHERE iban = :iban");
        $reqFindCompteForIban->execute([":iban"=>$destinataireOperation]);
        $compteDestinataire = $reqFindCompteForIban->fetch(PDO::FETCH_OBJ);

        // Si il n'existe pas...
        if ($reqFindCompteForIban->rowCount() != 1){
            echo "<script>alert(\"Le compte destinataire n'existe pas\")</script>"; 
        }
        else {
            // Sinon, on enregistre l'opétation
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

            // Et on met à jour les soldes
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

?>


    <?php include 'compte.html.php';?>


</body>

</html>