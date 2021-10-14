<?php
require 'db.inc.php';
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
            <link rel="stylesheet" type="text/css" href="style.css">
            <title>Ülésrend</title>
    </head>
    <?php

        $osztaly = array(
        array("Kulhanek László "),
        array("Molnár Gergő" ,"Bakcsányi Dominik" , "Füstös Lóránt" , "Orosz Zsolt" ,"Harsányi László" , NULL),
        array("Keresztúri Kevin" , "Juhász Levente", "Szabó László" ,"Sütő Dániel" , "Detari Klaudia" , NULL),
        array("Fazekas Miklós" , "Gombos János" ,"Tanár úr")
        );  

        foreach($osztaly as $sor=>$tomb){
            foreach($tomb as $oszlop=>$tanulo){
                $sql="INSERT INTO `ulesrend` ( `nev`, `sor`, `oszlop`) VALUES ( '$tanulo', $sor+1, $oszlop+1);";
                if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

        }



        $hianyzok = array(
            array(0),
            array(3),
            array(1),
            array(),
        );
        $gery=array(
            array(),
            array(2),
            array(),
            array(),
        );
        $ossze=array(
            array(),
            array(),
            array(),
            array(1,2),
        )

    ?>

    <body>
        <table>
            <?php 
                foreach($osztaly as $sor => $tomb){
                    echo '<tr>';
                    foreach($tomb as $oszlop => $tanulo){
                    if($tanulo ===  NULL) echo '<td id="empty"></td>';
                        else{
                        $plusz=' ';
                        if(in_array($oszlop,$hianyzok[$sor])) $plusz .='id="missing"';
                        if(in_array($oszlop,$gery[$sor])) $plusz .='id="gery"';
                        if(in_array($oszlop,$ossze[$sor])) $plusz .='colspan="2"';
                    echo '<td'.$plusz.'>' .$tanulo.'</td>';
                    }
                    }
                    echo "</tr>";

                }
            



            ?>
            <!--
        <tr>
            <td><?php echo $osztaly[0][0];?></td>
        </tr>
        <tr>
            <td id="inv"></td>
        </tr>
        <tr>
            <td><?php echo $osztaly[1][0]; ?></td>
            <td id="inv"></td>
            <td><?php echo $osztaly[1][1]; ?></td>
            <td><?php echo $osztaly[1][2]; ?></td>
            <td id="inv"></td>
            <td><?php echo $osztaly[1][3]; ?></td>
            <td><?php echo $osztaly[1][4]; ?></td>
            <td id="inv"></td>
            <td id="empty">_ _</td>
        </tr>
        <tr>
        -->
        
        <!-- </tr>


        <tr>
            <td id="inv"></td>
        </tr>
        <tr>
            <td><?php echo $osztaly[2][0]; ?></td>
            <td id="inv"></td>
            <td><?php echo $osztaly[2][1]; ?></td>
            <td><?php echo $osztaly[2][2]; ?></td>
            <td id="inv"></td>
            <td><?php echo $osztaly[2][3]; ?></td>
            <td><?php echo $osztaly[2][4]; ?></td>
            <td id="inv"></td>
            <td id="empty">_ _</td>
        </tr>
        <tr>
            <td id="inv"></td>
        </tr>
        <tr>
            <td><?php echo $osztaly[3][0]; ?></td>
            <td id="inv"></td>
            <td id="empty">_ _</td>
            <td><?php echo $osztaly[3][1]; ?></td>
            <td id="inv"></td>
            <td id="empty">_ _</td>
            <td colspan="2"><?php echo $osztaly[3][2]; ?></td>
            <td id="inv"></td>
            
        </tr>
            -->
        </table>
    </body>
</html>

