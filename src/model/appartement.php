<?php

class appartement extends logement{

  public function __construct ($user, $pays, $surface, $nb_piece, $adresse, $periode){
    parent::__construct ($user, $pays, $surface, $nb_piece, $adresse, $periode);
  }

  public function getSurfaceExt(){
    return 0;
  };

//à faire
  function __destruct(){
    unset($this->date);
    unset($this->heure);
    unset($this->lieu);
    unset($this->sujet);
  }

}

?>
