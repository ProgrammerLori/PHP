<?php

require 'includes/db.inc.php';

$stmt=mysqli_prepare($conn,"SELECT nev FROM ulesrend WHERE nev LIKE ?");
if(isset($_REQUEST['keres'])){

   $stmt->bind_param('s', $nev); 
   $nev = "%".$_REQUEST['keres']."%";
   $stmt->execute();
   
    if($result = $stmt->get_result()){
       
        if ($result->num_rows > 0 ){
            
            while($row = $result->fetch_assoc()){
                 echo $row['nev']."<br>";
            }
          
    } else echo "Ez a név nem szerepel az adatbazisban";
   
}
}
?>