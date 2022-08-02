<?php

class userModel extends Model {

    public function getUsers() {

		$sql = "SELECT 
                * 
                FROM users
                WHERE type_user != 10
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}

	public function checkUser() {

		$login = trim($_POST['login']);
		$password = md5($_POST['password']);
        $type_user = $_POST['type_user'];

		$sql = "SELECT * FROM users WHERE login = :login";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($res) && $login != '') {
            return '1';
		} 
        else {
			return '2';
		}
	}

    
    public function registerNewUser($regLogin, $regPassword, $regType) {
		$sql = "INSERT INTO users(login, password, type_user)
				        VALUES (:login, :password, :type)
		";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":login", $regLogin, PDO::PARAM_STR);
		$stmt->bindValue(":password", $regPassword, PDO::PARAM_STR);
        $stmt->bindValue(":type", $regType, PDO::PARAM_STR);
		$stmt->execute();
		header("Location: /user");
	}
    
}


?>