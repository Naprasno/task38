<?php

class VendorModel extends Model {

    public function redirect(){
        $offer_id= $_GET['offer'];
        $subscriber_id = $_GET['sub'];

        $sql = "SELECT 
                *
                FROM offers
                join subscriptions on offers.id = subscriptions.offer_id
                WHERE offers.id = $offer_id and subscriptions.subscriber_id = $subscriber_id and offers.enable=1
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($res)) {
            $target_url=$res['url'];
            
            $sql = "UPDATE offers set total_clicks=total_clicks+ 1 WHERE offers.id = $offer_id;
            UPDATE subscriptions set count_clicks=count_clicks+ 1 WHERE subscriber_id = $subscriber_id and offer_id=$offer_id;
            INSERT INTO clicks(id_offer, id_sub) VALUES ($offer_id,$subscriber_id )
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            header("Location: $target_url");

        }
        else {
            $sql = "
            INSERT INTO reject(offer_id, subscriber_id) VALUES ($offer_id,$subscriber_id )
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            header("Location: /error");
        }

        
    }

    public function sub() {
        $user = $_SESSION['user']['id'];
        $offer= $_GET['offer_id'];
        $new_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $new_url= $new_url."/cabinet/vendor?offer=$offer&sub=$user";

        $sql = "INSERT INTO subscriptions (offer_id, subscriber_id, new_url)
				        VALUES ($offer, $user, '$new_url')
		";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        //print_r($sql);
        header("Location: /cabinet");
    }

    public function unsub() {
        $offer= $_GET['offer_id_unsub'];

        $sql = "DELETE FROM subscriptions WHERE id=$offer";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        header("Location: /cabinet");
    }
    
    public function offerOff() {
        $offer= $_GET['offer_id_off'];

        $sql = "UPDATE offers set enable = 0 WHERE id=$offer";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        header("Location: /cabinet");
    }

    public function userUpdate() {
        $user_id= $_GET['userUpdate_id'];

        $sql = "UPDATE 
                users 
                set enable = 
                    (case 
                    when enable = 0 then 1
                    when enable = 1 then 0
                    end)
                WHERE id=$user_id";
       
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        header("Location: /user");
    }
    
}

 ?>