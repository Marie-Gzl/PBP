 <?php 

date_default_timezone_set('Europe/Paris');


$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// On récupère les comptes du client
$reqComptes=$bdd->prepare("SELECT * FROM compte WHERE id_client = :idClient");
$reqComptes->execute([':idClient' => $_SESSION["connectedUser"]->id_client]);
$comptes = $reqComptes->fetchAll(PDO::FETCH_OBJ);

// Si on a reçu un paramètre dbObject avec la requête
if (isset($_POST['dbObject']) ){
    // Si on souhaite effectuer une nouvelle opération
    if ($_POST['dbObject'] == 'operation') {
        $emetteur = $_POST['emetteur'];

        $reqCompte = $bdd->prepare("SELECT * FROM compte WHERE iban = :iban");
        $reqCompte->execute([":iban" => $emetteur]);
        $compte = $reqCompte->fetch(PDO::FETCH_OBJ);

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
                ":compteDebit"=> $compte->id_compte,
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
                ":idCompte"=> $compte->id_compte,
            ]);

        }
    }
}



    include './virements.html.php';
    ?>