<?php

class CabinetModel extends Model {


    /*Веб мастер --------------------------------------------------------------*/
    public function getOffersCount() {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT COUNT(*) FROM subscriptions where subscriber_id=$user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getOffersClicks() {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT 
                case 
                    when sum(count_clicks) is null then 0 
                    else sum(count_clicks) 
                end 
                FROM subscriptions where subscriber_id=$user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getOffersSumm() {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT 
                case when round(sum(subscriptions.count_clicks * ( (select 1-summ from commission order by id DESC LIMIT 1) * offers.price)) ,2) is null then 0 
                else round(sum(subscriptions.count_clicks * ( (select 1-summ from commission order by id DESC LIMIT 1) * offers.price)) ,2) end 
                FROM subscriptions 
                join offers on offers.id = subscriptions.offer_id 
                where subscriber_id=$user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }


    public function getOffers() {
        $user = $_SESSION['user']['id'];
		$sql = "SELECT 
                * 
                FROM offers
                WHERE offers.enable = 1
                and offers.id not in (SELECT offer_id FROM subscriptions where subscriber_id = $user )
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}

    public function getSubscriptions() {
        $user = $_SESSION['user']['id'];
		$sql = "SELECT 
                *,offers.enable as oe 
                FROM offers 
                join subscriptions on offers.id = subscriptions.offer_id
                WHERE subscriptions.subscriber_id = $user 
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}

		return $result;		
	}


    /* /РЕКЛАМОДАТЕЛЬ  --------------------------------------------------------------*/
    public function addNewOffer($user_id, $name, $price,$url, $theme, $enable){
        $sql = "INSERT INTO offers (user_id, name, price, url, theme, enable)
        VALUES (:user_id, :name, :price, :url, :theme, :enable)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_STR);
        $stmt->bindValue(":url", $url, PDO::PARAM_STR);
        $stmt->bindValue(":theme", $theme, PDO::PARAM_STR);
        $stmt->bindValue(":enable", $enable, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: /cabinet");
    }
    
    public function getOffersAd() {
        $user = $_SESSION['user']['id'];
		$sql = "SELECT 
                * ,
                (select count(id) from subscriptions where subscriptions.offer_id = offers.id) as counts
                FROM offers
                WHERE user_id = $user 
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}
		return $result;		
	}


    public function getOffersCountAd() {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT COUNT(*) FROM offers where user_id=$user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getOffersClicksAd() {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT 
                sum(total_clicks) 
                FROM offers where user_id=$user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getOffersSummAd() {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT 
                sum(offers.total_clicks * offers.price) *-1
                FROM offers 
                where user_id=$user
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }
    /* /Администратор  --------------------------------------------------------------*/
    public function getOffersCountAdmin() {

        $sql = "SELECT COUNT(*) FROM subscriptions";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
	}
    public function getOffersClicksAdmin() {
        $sql = "SELECT 
        sum(total_clicks) 
        FROM offers";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getOffersRejectAdmin() {
        $sql = "SELECT 
        count(*) 
        FROM reject";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }    
    public function getcommissionAdmin() {

        $sql = "SELECT summ from commission order by id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
	}
    public function getIncomeAdmin() {
        $sql = "SELECT 
        round(sum(total_clicks) * (select summ from commission order by id DESC LIMIT 1), 2)
        FROM offers";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }


    public function addNewCommission($commision){
        $sql = "INSERT INTO commission( summ ) VALUES ($commision)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        header("Location: /cabinet");
    }




}


 ?>