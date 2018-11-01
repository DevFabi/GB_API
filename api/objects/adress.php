<?php
class Adress{
 
    // database connection and table name
    private $conn;
    private $table_name = "adress";
 
    // object properties
    public $id;
    public $adress;
    public $codepostal;
    public $ville;
    public $created;
    public $deleted;
 
    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
public function read(){
 
    //select all data
    $query = "SELECT
                id, adress, codepostal,ville
            FROM
                " . $this->table_name . "
            ORDER BY
                adress";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}

function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                adress=:adress, codepostal=:codepostal, ville=:ville, created=:created";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->adress=htmlspecialchars(strip_tags($this->adress));
    $this->codepostal=htmlspecialchars(strip_tags($this->codepostal));
    $this->ville=htmlspecialchars(strip_tags($this->ville));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":adress", $this->adress);
    $stmt->bindParam(":codepostal", $this->codepostal);
    $stmt->bindParam(":ville", $this->ville);
    $stmt->bindParam(":created", $this->created);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

// update the adress
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                adress = :adress,
                codepostal = :adress_cp,
                ville = :adress_ville
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    
    // sanitize
    // strip_tags :: Supprime les balises HTML et PHP d'une chaîne
    $this->adress=htmlspecialchars(strip_tags($this->adress));
    $this->adress_cp=htmlspecialchars(strip_tags($this->adress_cp));
    $this->adress_ville=htmlspecialchars(strip_tags($this->adress_ville));
 
    // bind values  :: Lie un paramètre à un nom de variable spécifique
    $stmt->bindParam(":adress", $this->adress);
    $stmt->bindParam(":adress_cp", $this->adress_cp);
    $stmt->bindParam(":adress_ville", $this->adress_ville);
     $stmt->bindParam(":id", $this->adress_id);
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}


}
?>