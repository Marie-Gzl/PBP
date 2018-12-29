<?php
session_start();

$connectedUser = $_SESSION['connectedUser'];

if ($connectedUser == null) {
    header('Location: ../../index.html');
} else {
    // TODO vérifier que le type client est autorisé pour la page actuellement consultée
    // faire par exemple un var $PAGE_TYPE pour chaque page ou l'is-logger-in est include
    // et faire la comparaison de cette variable ou type client ici
}
