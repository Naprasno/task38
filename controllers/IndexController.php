<?php

class IndexController extends Controller {

	private $pageTpl = '/views/main.tpl.php';


	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}


	public function index() {
        if($_SESSION['user']) {
			header("Location: /cabinet");
		}

		$this->pageData['title'] = "Вход в личный кабинет";
		if(!empty($_POST)) {
			if(!$this->login()) {
				$this->pageData['error'] = "Ошибка авторизации";
			}
		}

		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function login() {
		if(!$this->model->checkUser()) {
			return false;
		}
	}



}