<?php

class RegisterController extends Controller {

	private $pageTpl = '/views/register.tpl.php';


	public function __construct() {
		$this->model = new RegisterModel();
		$this->view = new View();
	}

    public function index() {
		if($_SESSION['user']) {
			header("Location: /cabinet");
		}

		$this->pageData['title'] = "Регистрация";
		if(!empty($_POST)) {
			if($this->login() == true) {
                $this->register();
				$this->pageData['error'] = 'Вы зарегистрированы, <a href="/">авторизуйтесь!</a>';
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


}