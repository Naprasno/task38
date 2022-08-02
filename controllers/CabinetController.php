<?php

class CabinetController extends Controller {

    private $pageTpl = "/views/cabinet.tpl.php";

    public function __construct() {
        $this->model = new CabinetModel();
        $this->view = new View();
    }

    public function index() {

        if(!$_SESSION['user']) {
			header("Location: /");
		}

        $this->pageData['title'] = "Кабинет";
        
        /* ВЕБ МАСТЕР */
        if($_SESSION['user']['type_user'] ==1) {
            $offersCount = $this->model->getOffersCount();
            $this->pageData['offersCount'] = $offersCount;

            $offersClicks = $this->model->getOffersClicks();
            $this->pageData['offersClicks'] = $offersClicks;

            $offersSumm = $this->model->getOffersSumm();
            $this->pageData['offersSumm'] = $offersSumm;

        
            
            $offers = $this->model->getOffers();
            $this->pageData['offers'] = $offers;

            $subscriptions = $this->model->getSubscriptions();
            $this->pageData['subscriptions'] = $subscriptions;
        }

        /* РЕКЛАМОДАТЕЛЬ  */
        if($_SESSION['user']['type_user'] ==0) {

            $offersAd = $this->model->getOffersAd();
            $this->pageData['offersAd'] = $offersAd;

            $offersCountAd = $this->model->getOffersCountAd();
            $this->pageData['offersCountAd'] = $offersCountAd;

            $offersClicksAd = $this->model->getOffersClicksAd();
            $this->pageData['offersClicksAd'] = $offersClicksAd;

            $offersSummAd = $this->model->getOffersSummAd();
            $this->pageData['offersSummAd'] = $offersSummAd;

            if(isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['price'])&& isset($_POST['url']) && isset($_POST['theme']) ) {
                $user_id = $_SESSION['user']['id'];
                $name = $_POST['name'];
                $price = $_POST['price']; 
                $url = $_POST['url']; 
                $theme = $_POST['theme']; 
                $enable = 1;
    
                $this->model->addNewOffer($user_id, $name, $price,$url, $theme, $enable);
                
            }
        }
        /* Администратор  */
        if($_SESSION['user']['type_user'] ==10) {
            $offersCountAdmin = $this->model->getOffersCountAdmin();
            $this->pageData['offersCountAdmin'] = $offersCountAdmin;

            $offersClicksAdmin = $this->model->getOffersClicksAdmin();
            $this->pageData['offersClicksAdmin'] = $offersClicksAdmin;

            $offersRejectAdmin = $this->model->getOffersRejectAdmin();
            $this->pageData['offersRejectAdmin'] = $offersRejectAdmin;

            $commissionAdmin = $this->model->getcommissionAdmin();
            $this->pageData['commissionAdmin'] = $commissionAdmin;
            
            $incomeAdmin = $this->model->getIncomeAdmin();
            $this->pageData['incomeAdmin'] = $incomeAdmin;

            if(isset( $_POST['submit']) && isset($_POST['commission']) ) {
                $commision = $_POST['commission'];
                $this->model->addNewCommission($commision);
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