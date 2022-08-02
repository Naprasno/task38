<?php

class StatisticsController extends Controller {

    private $pageTpl = "/views/statistics.tpl.php";

    public function __construct() {
        $this->model = new StatisticsModel();
        $this->view = new View();
    }

    public function index() {
        $id_offer = $_GET['offer_id'];
		$this->pageData['title'] = "Подробная статистика";
        
        $offerName = $this->model->getOfferName($id_offer);
        $this->pageData['offerName'] = $offerName;

        if($_SESSION['user']['type_user'] ==1) {

            if(!empty($_POST['date1']) && !empty($_POST['date2'])) {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                $getStat = $this->model->getStat($id_offer,$date1, $date2 );;
                $this->pageData['getStat'] = $getStat;
            }

        }


        if($_SESSION['user']['type_user'] ==0) {

            if(!empty($_POST['date1']) && !empty($_POST['date2'])) {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                $getStatAd = $this->model->getStatAd($id_offer,$date1, $date2 );;
                $this->pageData['getStatAd'] = $getStatAd;
            }
            
        }


		$this->view->render($this->pageTpl, $this->pageData);
	}



    


    public function logout() {
		session_destroy();
		header("Location: /");
	}

}

 ?>