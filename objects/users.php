<?php
namespace users;

class Users {

	// database connection and table name
    private $conn;
    private $table_name = "users";

    public $username;
    public $password;

    public function __construct($db, $user, $pass){
        $this->conn = $db;
        $this->username = $user;
        $this->password = $pass;
        $this->login();
    }

    public function login() {

    	$query = "SELECT * FROM " . $this->table_name . " WHERE username = ? AND password = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $this->username);
    	$stmt->bindParam(2, $this->password);
    	$stmt->execute();

    	$row = $stmt->fetch(\PDO::FETCH_ASSOC);
    	
    	if($this->username == $row['username'] && $this->password == $row['password']) {

    		$_SESSION['username'] = $row['username'];

    	} else {

    		echo "Wrong username and password";
    	}

    }
}

?>