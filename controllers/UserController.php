<?php

class UserController extends Controller {

    private $pageTpl = "/views/user.tpl.php";

    public function __construct() {
        $this->model = new userModel();
        $this->view = new View();
    }

    public function index() {

        if(!$_SESSION['user'] || $_SESSION['user']['type_user'] !=10) {
			header("Location: /cabinet");
		}

        $this->pageData['title'] = "Пользователи";

        $users = $this->model->getUsers();
        $this->pageData['users'] = $users;

        
        if(!empty($_POST)) {
			if($this->login() == true) {
                $this->register();
				$this->pageData['error'] = 'добавлен новый пользователь';
			}
            else {
                $this->pageData['error'] = "Ошибка регистрации";
            }
		}


        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function login() {
        if($this->model->checkUser() == '1') {
            return true;
        }
        else {
            return false;
        }
    }
    public function register() {
		if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password'])) {
            $login = trim($_POST['login']);
            $password = md5($_POST['password']);
            $type_user = $_POST['type_user'];

			$this->model->registerNewUser($login, $password, $type_user);
			
		}
    }
    public function logout() {
		session_destroy();
		header("Location: /");
	}

}

 ?>