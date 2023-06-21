<?php
    // auteur: Dylan
    // functie: wijzig een genre op basis van de genreid
    
    echo "<h1>Update genre</h1>";
    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_wzg'])){
        Updategenre($_POST);

        //header("location: update.php?$_POST[NR]");
    }

    if(isset($_GET['genreid'])){  
        echo "Data uit het vorige formulier:<br>";
        // Haal alle info van de betreffende genreid $_GET['genreid']
        $genreid = $_GET['genreid'];
        $row = Getgenre($genreid);
    }
   ?>

<html>
    <body>
        <form method="post">
        <br>
        genreid:<input type="" name="genreid" value="<?php echo $row['genreid'];?>"><br>
        <label for="genregenrenaam">genrenaam</label>
        <input type="" name="genrenaam" id="genrenaam"value="<?php echo $row['genrenaam'];?>"><br> 
        </form>
    </body>
</html>