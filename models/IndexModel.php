<?php

class IndexModel extends Model {

	
	public function checkUser() {

		$login = trim($_POST['login']);
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE login = :login AND password = :password and enable=1";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		$stmt->execute();


		$res = $stmt->fetch(PDO::FETCH_ASSOC);


		if(!empty($res)) {
			
			$_SESSION['user'] = [
                "id" => $res['id'],
                "login" => $res['login'],
                "type_user" => $res['type_user']
            ];

			header("Location: /cabinet");
			
		} else {
			return false;
		}

	}

}