<?php

session_start();
require 'db.inc.php';
require 'function.inc.php';



// form feldolgozása

if(!empty($_POST["hianyzo_id"])){
  $sql = "INSERT INTO hianyzok VALUES(".$_POST["hianyzo_id"].")";
  $result = $conn->query($sql);

}
elseif (!empty($_GET['nem_hianyzo'])) {
    $sql = "DELETE FROM hianyzok WHERE id=".$_GET['nem_hianyzo'];
  $result = $conn->query($sql);
}
elseif (isset($_POST['user']) and isset($_POST["pw"])) {
  $loginError ='';
  if (strlen($_POST['user']) == 0)  $loginError.="Nem írtál be felhasználónevet<br>";
  if (strlen($_POST['pw']) == 0)  $loginError.="Nem írtál be jelszót<br>";
  if ($loginError=='') {
    $sql = "SELECT id,nev,jelszo FROM ulesrend WHERE felhasznalonev ='".$_POST['user'] ."'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      if($row = $result->fetch_assoc()) {
        if (md5($_POST["pw"])==$row['jelszo']) {
          //érvényes belépés
         
          $_SESSION["id"] = $row['id'];
          $_SESSION["nev"] = $row['nev'];
        }
        else $loginError.='Érvénytelen jelszó<br>';
      }
  }
  else $loginError.='Érvénytelen felhasználónév<br>';
}
}

?>


<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Ülésrend</title>
</head>
<?php

$hianyzok = array();//ebben lesznek a hiányzók id-i felsorolva
$sql = "SELECT id FROM hianyzok";
  $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $hianyzok[]=$row['id'];

    }
  }
$en=4;
$admin=array();
$sql = "SELECT id FROM adminok";
  $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $admin[]=$row['id'];

    }
  }
$tanar=17;
 
 
?>

<body>
<?php
$title="Ülésrend";
include 'htmlheader.inc.php'; 
?>
  <?php
include 'menu.inc.php';
?>
  <table>
  
    
    <tr><th colspan="6" class="mid"><h1>Ülésrend</h1>


    <?php
    if (!empty($_SESSION['id'])and in_array($_SESSION['id'],$admin)) {
      ?>
  <form action="ulesrend.php" method="post">

    Hiányzó: <select  name="hianyzo_id">
          <?php 
          

                $result = tanulokListaja($conn);
                if ($result->num_rows > 0) {
                
                  
                  while($row = mysqli_fetch_assoc($result)) {
                    if($row['nev'] and !in_array($row["id"],$hianyzok))echo '<option value="'.$row["id"].'">'.$row["nev"].'</option> ';
                    
                  }
                  echo'<input type="submit" value="Küldés" name="kuld">';
                }
          }
          
            ?>

              
  </select>
  <br>
  
  </form>

    </th>
  </tr>


    <?php 

    $result = tanulokListaja($conn);
    
    if ($result->num_rows > 0) {
      // output data of each row
      $sor = 0;
      while($row = mysqli_fetch_assoc($result)) {
        
        if($row["sor"]!=$sor){
          if($sor != 0) echo '</tr>';
          echo '<tr>';
          $sor = $row["sor"];
        }
        //echo "<td>" . $row["nev"]. "</td>";

        if(!$row["nev"]) echo '<td id="empty"><h3>Üres</h3></td>';
        
        else{ 
          $plusz = ' ';
        // if(in_array(($row["oszlop"]-1),$hianyzok[$sor-1])) $plusz .= 'id="e"';
        if(in_array($row["id"],$hianyzok)) $plusz .= 'id="e"';
        
        if($row["id"]==$tanar) $plusz .= 'colspan="2"';
        if($_SESSION and $row["id"]==$_SESSION['id']) $plusz .= 'id="ezvagyoken"';
          echo "<td".$plusz.">" . $row["nev"];
          if (!empty($_SESSION['id'])and in_array($_SESSION['id'],$admin)) {
            if(in_array($row["id"],$hianyzok))echo'<br><a href="ulesrend.php?nem_hianyzo='.$row["id"].'">Nem hiányzó</a>';
          echo "</td>";
          }
          
        
        }
      }
    } else {
      echo "0 results";
    }
    
    mysqli_close($conn);
        

      ?>
      

  </table>



</body>
</html>