<?php
namespace users;

class Users {

	// database connection and table name
    private $conn;
    private $table_name = "users";

    public $username;
    public $password;
    public $password_confirm;

    public function __construct($db, $user, $pass, $pass_confirm){
        $this->conn = $db;
        $this->username = $this->test_input($user);
        $this->password = $this->test_input($pass);
        $this->password_confirm = $this->test_input($pass_confirm);

        if(empty($pass_confirm)) {

            $this->login();
        } else {

            $this->register();
        }
    }

    public function login() {

        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $hash = $row['password'];
    	
    	if($this->username == $row['username'] && password_verify($this->password, $hash)) {

    		$_SESSION['username'] = $row['username'];
            header("Location: ../index.php");

    	} else {

    		echo "Wrong username and password";
    	}

    }

    public function register() {

        if($this->password == $this->password_confirm) {

            $hashed_password = password_hash($this->password, PASSWORD_BCRYPT, ["cost" => 10]);

            $query = "INSERT INTO " . $this->table_name . "(username, password) VALUES (:username, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $hashed_password);

            echo "<h4 class='text-center'>Uspješno ste registrirani. Sada se možete <a href='login.php?action=login'>prijaviti.</a></h4>";
            
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }

        } else {

            echo "<h4 class='text-center'>Lozinka se ne podudara. Provjerite dali ste upistali jednaku lozinku u oba polja.</h4>";
        }
    }

    public function test_input($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>