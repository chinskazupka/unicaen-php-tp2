<?php

class maison extends logement{

  public $surfaceExt;

  public function __construct ($user, $pays, $surface, $nb_piece, $adresse, $periode, $surfaceExt){
    parent::__construct ($user, $pays, $surface, $nb_piece, $adresse, $periode);
    $this->surfaceExt=$surfaceExt;
  }

  public function getSurfaceExt(){
    return $this->surfaceExt;
  };

//à faire
  function __destruct(){
    unset($this->date);
  }

}

?>
