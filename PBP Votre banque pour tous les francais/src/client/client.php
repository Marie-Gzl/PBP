<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include '../modules/includes.php'; ?>

    <title>Tableau de bord</title>
</head>

<body class="container">

    <?php
        $PAGE_TYPE = 'CLIENT';
        include '../modules/is-logged-in.php';?>

    <?php include '../modules/navbar.php';?>

    <?php include './client.html';?>

</body>

</html>