<?php

// Classe abstraite commune à Chanson et Genre (héritage)
abstract class Style {

    protected $id;

    public function __construct($id = null){
        $this->id = $id;
    }

    public function getProp($prop){
        return $this->$prop;
    }

    public function setProp($prop, $value){
        $this->$prop = $value;
    }
}