<?php
// Accès à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

$reqBeneficiairesValide = $bdd->prepare("SELECT * FROM beneficiaire WHERE id_client = :idClient AND valide IS TRUE");
$reqBeneficiairesValide->execute([':idClient' => $_SESSION["connectedUser"]->id_client]);
$beneficiairesValide = $reqBeneficiairesValide->fetchAll(PDO::FETCH_OBJ);
//        var_dump($beneficiairesValide);

$reqBeneficiairesAttente = $bdd->prepare("SELECT * FROM beneficiaire WHERE id_client = :idClient AND valide IS FALSE");
$reqBeneficiairesAttente->execute([':idClient' => $_SESSION["connectedUser"]->id_client]);
$beneficiairesAttente = $reqBeneficiairesAttente->fetchAll(PDO::FETCH_OBJ);
//        var_dump($beneficiaireAttente);

if (isset($_POST["libelle"], $_POST["iban"])) {
    $reqInsertBeneficiare = $bdd->prepare("INSERT INTO beneficiaire(id_client, libelle, iban) VALUES(:idClient, :libelle, :iban)");
    $reqInsertBeneficiare->execute([
        ":idClient" => $_SESSION["connectedUser"]->id_client,
        ":libelle" => $_POST["libelle"],
        ":iban" => $_POST["iban"],
    ]);

    // On empeche le resubmit avec le refresh F5
    header('Location:beneficiaires.php');
}
?>

    <?php include './beneficiaires.html.php';?>
