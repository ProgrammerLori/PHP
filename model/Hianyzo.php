<?php

require_once 'Kijeloltfelhasznalok.php';

class Hianyzo extends Kijeloltfelhasznalok {
    
    function __construct() {
        $this->tablaNev = 'hianyzok';
    }

function remove_id($id,$conn)
{
    $sql = "DELETE FROM hianyzok WHERE id =".$_GET['nem_hianyzo'];
	$result = $conn->query($sql);	
}


}

?>
