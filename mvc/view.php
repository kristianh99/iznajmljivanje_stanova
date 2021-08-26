<?php
require_once "model.php";

class View {

    private $query;
    
    function __construct() {
        $this->query = new Model();
    }

    public function getAds() {
        $renderData = $this->query->getAds();

        return $renderData;
    }

    public function getMyAds() {
        $renderData = $this->query->getMyAds();

        return $renderData;
    }

    public function getFilters() {
        $renderData = $this->query->getFilters();

        return $renderData;
    }

    public function getUserData() {
        $renderData = $this->query->getUserData();

        return $renderData;
    }
    
    public function users() {
        $renderData = $this->query->users();

        return $renderData;
    }

    public function getMessages() {
        $renderData = $this->query->getMessages([]);

        return $renderData;
    }

    public function getComments() {
        $renderData = $this->query->getComments();

        return $renderData;
    }

}

?>