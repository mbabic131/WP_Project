<?php
/**
 * Created by PhpStorm.
 * User: Miro
 * Date: 04.03.15.
 * Time: 01:02
 */

namespace objects;


class podaci {

    // database connection and table name
    private $conn;
    private $table_name = "novci";

    // object properties
    public $id;
    public $iznosOrocenja;
    public $periodOrocenja;
    public $kamatnaStopa;
    public $zbrojKamata;
    public $trenutnaVrijednost;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    IznosOrocenja = ?, Porocenja = ?, Kstopa = ?, Kamate = ?, Tvrijednost = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->iznosOrocenja);
        $stmt->bindParam(2, $this->periodOrocenja);
        $stmt->bindParam(3, $this->kamatnaStopa);
        $stmt->bindParam(4, $this->zbrojKamata);
        $stmt->bindParam(5, $this->trenutnaVrijednost);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    function readAll($page, $from_record_num, $records_per_page){

        $query = "SELECT
                id, IznosOrocenja, Porocenja, Kstopa, Kamate, Tvrijednost
            FROM
                " . $this->table_name . "
            LIMIT
                {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    public function countAll(){

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    function readOne(){

        $query = "SELECT
                id, IznosOrocenja, Porocenja, Kstopa, Kamate, Tvrijednost
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->iznosOrocenja = $row['IznosOrocenja'];
        $this->periodOrocenja = $row['Porocenja'];
        $this->kamatnaStopa = $row['Kstopa'];
        $this->zbrojKamata = $row['Kamate'];
        $this->trenutnaVrijednost = $row['Tvrijednost'];
    }

    function update(){

        $query = "UPDATE
                " . $this->table_name . "
            SET
                IznosOrocenja = :IznosOrocenja,
                Porocenja = :Porocenja,
                Kstopa = :Kstopa,
                Kamate  = :Kamate,
                Tvrijednost = :Tvrijednost
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':IznosOrocenja', $this->iznosOrocenja);
        $stmt->bindParam(':Porocenja', $this->periodOrocenja);
        $stmt->bindParam(':Kstopa', $this->kamatnaStopa);
        $stmt->bindParam(':Kamate', $this->zbrojKamata);
        $stmt->bindParam(':Tvrijednost', $this->trenutnaVrijednost);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

} 