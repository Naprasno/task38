<?php

class VendorController extends Controller {

    private $pageTpl = "/views/cabinet.tpl.php";

    public function __construct() {
        $this->model = new VendorModel();
        $this->view = new View();
    }

    public function index() {

        if(empty($_GET) ) {
            header("Location: /error");
        }
        
        if(!empty($_GET['offer']) && !empty($_GET['sub']) ) {
            $this->model->redirect();
        }

        if(!empty($_GET['offer_id'])) {
            $this->model->sub();
        }
        
        if(!empty($_GET['offer_id_unsub'])) {
            $this->model->unsub();
        }
        if(!empty($_GET['offer_id_off'])) {
            $this->model->offerOff();
        }

        if(!empty($_GET['userUpdate_id'])) {
            $this->model->userUpdate();
        }

    }

    

}

 ?>