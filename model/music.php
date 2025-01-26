<?php

class Music {
    private $id;
    private $name;
    private $singer;

    public function __construct($name, $singer, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->singer = $singer;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSinger() {
        return $this->singer;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSinger($singer) {
        $this->singer = $singer;
    }
}
