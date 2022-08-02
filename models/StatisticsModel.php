<?php

class StatisticsModel extends Model {

    public function getOfferName($id_offer) {
        
        $sql = "SELECT 
                name
                FROM offers where offers.id=$id_offer";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }


    public function getStat($id_offer,$date1, $date2) {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT 
                count(id) as count,
                round (count(id) * (SELECT price FROM offers where offers.id = clicks.id_offer) * (select 1-summ from commission order by id DESC LIMIT 1), 2) as summ,
                'с $date1 по $date2' as dates
                FROM clicks where date between '$date1' and '$date2'
                and clicks.id_offer = $id_offer
                and clicks.id_sub = $user
                ";
        $result = array();
        $stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}
		return $result;	
	}

    public function getStatAd($id_offer,$date1, $date2) {
        $user = $_SESSION['user']['id'];
        $sql = "SELECT 
                count(id) as count,
                count(id) * (SELECT price FROM offers where offers.id = clicks.id_offer) *-1 as summ,
                'с $date1 по $date2' as dates
                FROM clicks where date between '$date1' and '$date2'
                and clicks.id_offer = $id_offer
                ";
        $result = array();
        $stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$row['id']] = $row;
		}
		return $result;	
	}



}

?>