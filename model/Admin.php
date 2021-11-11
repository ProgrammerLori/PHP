<?php
require '../includes/db.inc.php';
require 'Kijeloltfelhasznalok.php';

class Admin extends Kijeloltfelhasznalok {
    
    function __construct($tablaNev){
        $this->tablaNev='adminok';
    }
}

$admin =new Admin();
ECHO $admin->get_id();

?>


