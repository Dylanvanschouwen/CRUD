<?php
// auteur: Dylan
// functie: verwijder een genre op basis van de genreid
include 'functions.php';

// Haal genre uit de database
if(isset($_GET['genreid'])){
    Deletegenre($_GET['genreid']);

    echo '<script>alert("genreid: ' . $_GET['genreid'] . ' is verwijderd")</script>';
    echo "<script> location.replace('crud_genre.php'); </script>";
}
?>

