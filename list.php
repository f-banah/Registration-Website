<?php 

session_start();
include('dbconnection.php');
$sql = "SELECT * FROM table1";
		 			$result = mysqli_query($conn, $sql);
                  
					if (mysqli_num_rows($result) > 0) {
    						// Parcourir les lignes de résultat

    					while($row = mysqli_fetch_assoc($result)) {
        					echo "<tr><td> " . $row["Matricule"]. "</td><td>" . 
							$row["Nom"]. "</td><td>" . 
							$row["Prenom"]."</td><td>" . 
							$row["Cycle"]."</td><td>" . 
							$row["Filiere"]."</td><td>" .  
							$row["Niveau"]."</td><td>" . 
							$row["Sexe"]."</td><td>" .
							$row["Date_Naissance"]."</td><td>" .
							$row["Date_inscription"]."</td><td>" .
							$row["Email"]
        					."</td></tr>";
    					}
    					

                    }
?>                    
