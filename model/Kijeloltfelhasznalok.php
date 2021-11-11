<?php

class Kijeloltfelhasznalok {
    
    private $id;
    protected $tablaNev;
    
    

    protected function set_id($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id FROM $this->tablaNev WHERE id=$id";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id']; 
            }else {
                $sql = "INSERT INTO $this->tablaNev($id)";
                if($result = $conn->query($sql)){
                    $this->id=$id;
                }
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // építsük fel az összes get metódust
    
    protected function get_id() {
        return $this->id;
    }

    // id listát adja vissza
    protected function lista($conn) {
        $lista = array();
        $sql = "SELECT id FROM $this->tablaNev";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
}

// $tanulo = new Ulesrend;

// $tanulo->set_user(4, $conn);

// echo $tanulo->get_nev();

?>
