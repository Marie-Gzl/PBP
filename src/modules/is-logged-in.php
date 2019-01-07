<?php
session_start();

$connectedUser = $_SESSION['connectedUser'];

if ($connectedUser == null) {
    header('Location: ../../index.html');
} else {
    if ($PAGE_TYPE != $connectedUser->userType){
        $connectedUser = null;
        header('Location: ../../index.html');
    }
}