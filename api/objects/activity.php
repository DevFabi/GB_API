<?php
class activity{
 
    // database connection and table name
    private $conn;
    private $table_name = "activity";
 
    // object properties
    public $id;
    public $name;
    public $price;
    public $category_id;
    public $category_name;
    public $adress_id;
    public $adress;
    public $adress_cp;
    public $adress_ville;
    public $note_id;
    public $note_ambiance;
    public $note_food;
    public $photo_id;
    public $photo_img;
    public $created;
    public $deleted;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read activity
function read(){
 
    // select all query
    $query = "SELECT
                c.name as category_name, 
                ad.adress as adress,
                ad.codepostal as adress_cp,
                ad.ville as adress_ville,
                n.note_ambiance as note_ambiance,
                n.note_food as note_food,
                p.img as photo_img,
                a.id, a.name, a.price, a.category_id,a.adress_id, a.note_id, a.photo_id, a.created, a.deleted
            FROM ((((
                " . $this->table_name . " a
                LEFT JOIN
                    category c
                        ON a.category_id = c.id )
                LEFT JOIN
                    adress ad
                        ON a.adress_id = ad.id )
                LEFT JOIN
                    note n
                        ON a.note_id = n.id )
                LEFT JOIN 
                    photo p 
                        ON a.photo_id = p.id )
            ORDER BY
                a.created DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

// create activity
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, category_id=:category_id, adress_id=:adress_id,note_id=:note_id, photo_id=:photo_id,created=:created";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->adress_id=htmlspecialchars(strip_tags($this->adress_id));
    $this->note_id=htmlspecialchars(strip_tags($this->note_id));
    $this->photo_id=htmlspecialchars(strip_tags($this->photo_id));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":adress_id", $this->adress_id);
    $stmt->bindParam(":note_id", $this->note_id);
    $stmt->bindParam(":photo_id", $this->photo_id);
    $stmt->bindParam(":created", $this->created);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

// used when filling up the update activity form
function readOne(){
 
$query = "SELECT
                c.name as category_name, 
                ad.adress as adress,
                ad.codepostal as adress_cp,
                ad.ville as adress_ville,
                n.note_ambiance as note_ambiance,
                n.note_food as note_food,
                p.img as photo_img,
                a.id, a.name, a.price, a.category_id,a.adress_id, a.note_id, a.photo_id, a.created, a.deleted
            FROM ((((
                " . $this->table_name . " a
                LEFT JOIN
                    category c
                        ON a.category_id = c.id )
                LEFT JOIN
                    adress ad
                        ON a.adress_id = ad.id )
                LEFT JOIN
                    note n
                        ON a.note_id = n.id )
                LEFT JOIN 
                    photo p 
                        ON a.photo_id = p.id )
           WHERE
                a.id = ?
            LIMIT
                0,1";
            
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of activity to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->name = $row['name'];
    $this->price = $row['price'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
    $this->adress_id = $row['adress_id'];
    $this->adress = $row['adress'];
    $this->adress_ville = $row['adress_ville'];
    $this->adress_cp = $row['adress_cp'];
    $this->note_id = $row['note_id'];
    $this->note_ambiance = $row['note_ambiance'];
    $this->note_food = $row['note_food'];
    $this->photo_id = $row['photo_id'];
    $this->photo_img = $row['photo_img'];
    $this->created = $row['created'];
    $this->deleted = $row['deleted'];
}

// update the activity
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                price = :price,
                category_id = :category_id
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    
    // sanitize
    // strip_tags :: Supprime les balises HTML et PHP d'une chaîne
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
  /*  $this->adress_id=htmlspecialchars(strip_tags($this->adress_id));
    $this->note_id=htmlspecialchars(strip_tags($this->note_id));
    $this->photo_id=htmlspecialchars(strip_tags($this->photo_id));*/
 
    // bind values  :: Lie un paramètre à un nom de variable spécifique
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":category_id", $this->category_id);
   /* $stmt->bindParam(":adress_id", $this->adress_id);
    $stmt->bindParam(":note_id", $this->note_id);
    $stmt->bindParam(":photo_id", $this->photo_id);*/
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
// delete the activity
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// search activity
function search($keywords){
 
    // select all query
    $query = "SELECT
                c.name as category_name, 
                ad.adress as adress,
                ad.codepostal as adress_cp,
                ad.ville as adress_ville,
                n.note_ambiance as note_ambiance,
                n.note_food as note_food,
                p.img as photo_img,
                a.id, a.name, a.price, a.category_id,a.adress_id, a.note_id, a.photo_id, a.created, a.deleted
            FROM ((((
                " . $this->table_name . " a
                LEFT JOIN
                    category c
                        ON a.category_id = c.id )
                LEFT JOIN
                    adress ad
                        ON a.adress_id = ad.id )
                LEFT JOIN
                    note n
                        ON a.note_id = n.id )
                LEFT JOIN 
                    photo p 
                        ON a.photo_id = p.id )
            WHERE
                a.name LIKE ? OR c.category_name LIKE ?
            ORDER BY
                a.created DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
// read activity with pagination
public function readPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                c.name as category_name, 
                ad.adress as adress,
                ad.codepostal as adress_cp,
                ad.ville as adress_ville,
                n.note_ambiance as note_ambiance,
                n.note_food as note_food,
                p.img as photo_img,
                a.id, a.name, a.price, a.category_id,a.adress_id, a.note_id, a.photo_id, a.created, a.deleted
            FROM ((((
                " . $this->table_name . " a
                LEFT JOIN
                    category c
                        ON a.category_id = c.id )
                LEFT JOIN
                    adress ad
                        ON a.adress_id = ad.id )
                LEFT JOIN
                    note n
                        ON a.note_id = n.id )
                LEFT JOIN 
                    photo p 
                        ON a.photo_id = p.id )
            ORDER BY a.created DESC
            LIMIT ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}
// used for paging activity
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}
}