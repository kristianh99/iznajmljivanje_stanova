<?php
require_once 'model.php';

class Controller {

    private $query;
    
    function __construct() {
        $this->query = new Model();
    }

    public function filterAds($data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->filterAds($array),
        ];
        return json_encode($response);
    }

    public function updateUser(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->updateUser($array),
        ];
        
        return json_encode($response);
    }

    public function deleteAd(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->deleteAd($array),
        ];
        
        return json_encode($response);
    }

    public function createAd(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->createAd($array),
        ];
        
        return json_encode($response);
    }
    
    public function updateAd(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->updateAd($array),
        ];
        
        return json_encode($response);
    }

    public function block(string $data, $type) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->block($array, $type),
        ];
        
        return json_encode($response);
    }

    public function getMessages(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'messages' => $this->query->getMessages($array),
        ];
        
        return json_encode($response);
    }

    public function updateMessage(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->updateMessage($array),
        ];
        
        return json_encode($response);
    }

    public function getNotifications() {
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->getNotifications(),
        ];
        
        return json_encode($response);
    }

    public function reservateAd(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->reservateAd($array),
        ];
        
        return json_encode($response);
    }

    public function comment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->comment($array),
        ];
        
        return json_encode($response);
    }

    public function deleteComment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->deleteComment($array),
        ];
        
        return json_encode($response);
    }

    public function updateComment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->updateComment($array),
        ];
        
        return json_encode($response);
    }

}

?>