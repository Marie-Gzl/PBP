<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include '../modules/includes.php';?>

    <title>Opérations</title>
</head>

<body class="container">

    <?php
$PAGE_TYPE = 'CLIENT';
include '../modules/is-logged-in.php';?>


    <?php include '../modules/navbar.php';

    //appel des pages bénéficiaires et virements

    include './beneficiaires.php';
    include './virements.php';

    ?>

</body>

</html>