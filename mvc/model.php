<?php
require_once __DIR__.'/../db.php';
require_once __DIR__.'/../register/functions_def.php';

class Model {

    private $connection;

    function __construct() {
        $this->connection = DB::connect();
    }

    public function getAds() {

        $ads = "SELECT ads.rented_by, ads.id,ads.active,ads.price, ads.description, ads.location, ads.image , ads.rent_start, ads.rent_end, users.email,users.id_user, property_types.property_type FROM `ads` INNER JOIN users ON ads.user_id = users.id_user INNER JOIN property_types ON property_types.ID = ads.property_type";

        $result = mysqli_query($this->connection, $ads) or die(mysqli_error($this->connection));

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMyAds() {

        $ads = "SELECT ads.rented_by, ads.id,ads.active,ads.price, ads.description, ads.location, ads.image , ads.rent_start, ads.rent_end, users.email,users.id_user, property_types.property_type FROM `ads` INNER JOIN users ON ads.user_id = users.id_user INNER JOIN property_types ON property_types.ID = ads.property_type WHERE  ads.user_id = $_SESSION[id_user]";

        $result = mysqli_query($this->connection, $ads) or die(mysqli_error($this->connection));

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFilters() {

        $property_type = "SELECT property_type, id FROM `property_types`";
        $property_type = mysqli_query($this->connection, $property_type) or die(mysqli_error($this->connection));
        
        $location = "SELECT `location` FROM `ads` GROUP BY `location`";
        $location = mysqli_query($this->connection, $location) or die(mysqli_error($this->connection));

        $minmax =  "SELECT MIN(price) as 'min', MAX(price) as 'max' FROM `ads`";
        $minmax = mysqli_query($this->connection, $minmax) or die(mysqli_error($this->connection));

        return["property_type" => $property_type->fetch_all(MYSQLI_ASSOC), "location" =>  $location->fetch_all(MYSQLI_ASSOC), "minmax" => $minmax->fetch_all(MYSQLI_ASSOC)];
    }

    public function filterAds($data) {

        if($data['location'] != "" || $data['type']  != "" || $data['range']  != "" || $data['rent_start']  != "" || $data['rent_end']  != ""){
            $where = [];
            if( $data['location'] != "" ){
                $where[] = "ads.location = '$data[location]'";
            }
            if($data['type'] != "" ){
                $where[] = "property_types.id = '$data[type]'";
            }
            if($data['range'] != "" ){
                $where[] = "ads.price >= $data[range]";
            }
            if($data['rent_start'] != "" ){
                $where[] = "ads.rent_start <= '$data[rent_start]'";
            }
            if($data['rent_end'] != "" ){
                $where[] = "ads.rent_end >= '$data[rent_end]'";
            }
            if(sizeof($where)){
                $where = "WHERE ".join(" and ", $where);
            }

            $ads = "SELECT ads.rented_by, ads.id, ads.active, ads.price, ads.description, ads.location, ads.image , ads.rent_start, ads.rent_end, users.email, users.id_user, property_types.property_type FROM `ads` INNER JOIN users ON ads.user_id = users.id_user INNER JOIN property_types ON property_types.ID = ads.property_type $where";
        }else {
            $ads = "SELECT ads.rented_by, asd.id, ads.active, ads.price, ads.description, ads.location, ads.image , ads.rent_start, ads.rent_end, users.email, users.id_user, property_types.property_type FROM `ads` INNER JOIN users ON ads.user_id = users.id_user INNER JOIN property_types ON property_types.ID = ads.property_type"; 
        }

        $result = mysqli_query($this->connection, $ads) or die(mysqli_error($this->connection));

        return ["ads" => $result->fetch_all(MYSQLI_ASSOC), "users" => $this->users()];
    }

    public function getUserData() {

        $sql = "SELECT * FROM `users` WHERE `users`.`id_user` = $_SESSION[id_user]";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser(array $data) {
        $sql = '';

        if(isset($data['password'])){
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `password` = '$password' WHERE `users`.`id_user` = $_SESSION[id_user]";
        }else{
            $sql = "UPDATE `users` SET `firstname` = '$data[firstname]', `lastname` = '$data[lastname]', `phone` = '$data[phone]' WHERE `users`.`id_user` = $_SESSION[id_user]";
        }

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result ? 'Izmena uspešna' : 'Greška';
    }

    public function deleteAd(array $data) {
        $sql = "DELETE FROM `ads` WHERE ads.id = '$data[id]'";


        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result ? 'Izmena uspešna' : 'Greška';
    }

    public function updateAd(array $data) {
        $sql = "UPDATE `ads` SET `location`='$data[location]', `property_type`='$data[property_type]', `description`='$data[description]',`price`='$data[price]', `rent_start`='$data[rent_start]', `rent_end`='$data[rent_end]' WHERE ads.id = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result ? 'Izmena uspešna' : 'Greška';
    }

    public function comment(array $data){

        if(isset($data['verification'])){
            $checkCode = "SELECT id, comment_date FROM comments WHERE code = '$data[verification]'";
            $result = mysqli_query($this->connection, $checkCode) or die(mysqli_error($this->connection));  

            if($result->num_rows >= 1){
                $result = $result->fetch_all(MYSQLI_ASSOC);

                if(date('Y-m-d') > $result[0]['comment_date']){
                    $sql = "UPDATE comments SET comment = '$data[message]' WHERE ads_id = '$data[id]'";
                    $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  
    
                    return "Sačuvanje je bilo uspešno";
                }else{
                    return "Moraš sačekati 14 dana posle kraja rezervacije";
                }
            }else{
                return "Greška u kodu";
            }
        } else{
            return "Kod je potrebna";
        }

    }

    public function deleteComment(array $data){

        $sql = "DELETE FROM `comments` WHERE ads_id = '$data[id]'";
        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  

        return;
           
    }

    public function updateComment(array $data){

        $sql = "UPDATE `comments` SET `comment`='$data[comment]' WHERE id = '$data[id]'";
        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  

        return $result ? 'Izmena uspešna' : 'Greška';
           
    }

    public function getComments(){

        $checkCode = "SELECT `id`, `comment`, `ads_id`, comments.code, `userid` , users.email FROM `comments` INNER JOIN users ON comments.userid = users.id_user";
        $result = mysqli_query($this->connection, $checkCode) or die(mysqli_error($this->connection));  

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function reservateAd(array $data) {
        $sql = "UPDATE `ads` SET `rented_by`='$data[rented_by]' WHERE ads.id = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));

        $sql = "SELECT rent_end FROM `ads` WHERE id = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $result =  $result->fetch_all(MYSQLI_ASSOC);

        $rentEnd = $result[0]['rent_end'];

        $code = createCode(20);
        $sql = "INSERT INTO `comments`(`ads_id`, `code`,`userid`,`comment_date`) VALUES ('$data[id]','$code', '$data[rented_by]', DATE_ADD('$rentEnd',INTERVAL 14 DAY))";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  
    
        $user = "SELECT email FROM `users` WHERE id_user = '$data[rented_by]'";
        $userResult = mysqli_query($this->connection, $user) or die(mysqli_error($this->connection));    
    	$userResult = $userResult->fetch_all(MYSQLI_ASSOC);

        $header = "From: WEBMASTER <webmaster@vts.su.ac.rs>\n";
        $header .= "X-Sender: webmaster@vts.su.ac.rs\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        $header .= "X-Priority: 1\n";
        $header .= "Reply-To:support@vts.su.ac.rs\r\n";
        $header .= "Content-Type: text/html; charset=UTF-8\n";
        $message = "";
        $message .= "Your code is : $code";
        $to = $userResult[0]['email'];
        $subject = "Rent on Real Estate";
        mail($to, $subject, $message, $header);

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result ? 'Izmena uspešna' : 'Greška';
    }

    public function createAd(array $data) {
        $sql = "INSERT INTO `ads`(`image`, `location`, `description`, `price`, `user_id`, `property_type`, `rent_start`, `rent_end`) VALUES ('$data[picture]','$data[location]','$data[description]','$data[price]','$_SESSION[id_user]','$data[property_type]','$data[rent_start]','$data[rent_end]')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result ? 'Pogledaj profil stranicu' : "Greška";
    }
    
    public function block($data, $type) {
        $active = "";
        $sql = "";

        if($type == "user"){
            $active = "SELECT `active` FROM `users` WHERE `id_user` = '$data[id]'";
        }else {
            $active = "SELECT `active` FROM `ads` WHERE `id` = '$data[id]'";
        }

        $result = mysqli_query($this->connection, $active) or die(mysqli_error($this->connection));     
        $active = $result->fetch_all(MYSQLI_ASSOC);

        $message = "";
        if($active[0]['active'] == 0) {
            $active = 1;
            $message = "The $type has been unblocked.";
        }else{
            $active = 0;
            $message = "The $type has been blocked.";
        }

        if($type == "user"){
            $sql = "UPDATE `users` SET `active` = '$active' WHERE `users`.`id_user` = '$data[id]'";
        }else {
            $sql = "UPDATE `ads` SET `active` = '$active' WHERE `ads`.`id` = '$data[id]'";
        }

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $message;
    }

    public function users() {

        $sql = "SELECT * FROM users WHERE user_type = '2'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMessages($data) {
        $sql = "";
        if(sizeof($data)){
            $sql = "SELECT `message`, sender FROM `messages` WHERE (`sender` = $_SESSION[id_user] AND `receiver` = $data[id]) OR (`receiver` = $_SESSION[id_user] AND `sender` = $data[id]) ORDER BY messages.id";
            $update = "UPDATE `messages` SET `seen`='1' WHERE (`receiver` = $_SESSION[id_user] AND `sender` = $data[id])";
            $result = mysqli_query($this->connection, $update) or die(mysqli_error($this->connection));     
        } else {
            $sql = "SELECT users.id_user, users.email, COUNT(CASE WHEN (messages.seen = 0 AND messages.receiver = $_SESSION[id_user])THEN 1 END) as seen FROM `messages` INNER JOIN users ON users.id_user = messages.sender OR users.id_user = messages.receiver WHERE (`sender` = $_SESSION[id_user]) OR (`receiver` = $_SESSION[id_user]) GROUP BY users.id_user";
        }
        

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateMessage($data) {

        $sql = "INSERT INTO `messages`(`sender`, `receiver`, `seen`, `message`, `new_conversation`) VALUES ('$_SESSION[id_user]','$data[id]','0','$data[message]','0')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Izmena uspešna";
    }

    public function getNotifications() {

        $sql = "SELECT COUNT(CASE WHEN (messages.seen = 0 AND messages.receiver = $_SESSION[id_user])THEN 1 END) as seen FROM `messages` INNER JOIN users ON users.id_user = messages.sender OR users.id_user = messages.receiver WHERE (`sender` = $_SESSION[id_user]) OR (`receiver` = $_SESSION[id_user]) GROUP BY users.id_user";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}

?>

