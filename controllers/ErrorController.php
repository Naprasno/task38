<?php

class ErrorController extends Controller {

    private $pageTpl = "/views/error.tpl.php";

    public function __construct() {
        $this->model = new ErrorModel();
        $this->view = new View();
    }

    public function index() {



    $this->view->render($this->pageTpl, $this->pageData);
        
    }
    

}

 ?>