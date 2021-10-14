<?php

session_start();
require 'db.inc.php';




// form feldolgozása


if (isset($_POST['user']) and isset($_POST["pw"])) {
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
          header('Location: ulesrend.php');
          exit();

        }
        else $loginError.='Érvénytelen jelszó<br>';
      }
  }
  else $loginError.='Érvénytelen felhasználónév<br>';
}
}if (isset($_POST['kilep'])) {
  include 'kilepes.php';
}

?>


<!DOCTYPE html>
<html lang="hu">
<?php 
$title="Belépés";
if (!empty($_SESSION['id'])) {
 $title="Kilépés";
}
include 'htmlheader.inc.php'; ?>
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
include 'menu.inc.php';
?>
  <table>
  <th colspan="3">Belépés<br>

  <form action="belepes.php" method="post">
    
    

    Felhasználó: <input type="text" name="user">

    Jelszó:<input type="password" name="pw">

    
    <input type="submit" value="Belépés">
    
    </form>
    
  
  
  
  



    </th>
    
    
      

  </table>



</body>
</html>