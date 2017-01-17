<?php

class appartement extends logement{

  public function __construct ($user, $pays, $surface, $nb_piece, $adresse, $periode){
    parent::__construct ($user, $pays, $surface, $nb_piece, $adresse, $periode);
  }

  public function getSurfaceExt(){
    return 0;
  };


  //new
  //new
    public function logementToHTML(){
      $res="";
      $res.=parent::logementToHTML();
      return $res;
    }



  function __destruct(){
    unset($this->$user);
    unset($this->$pays);
    unset($this->$surface);
    unset($this->$nb_piece);
    unset($this->$adresse);
    unset($this->$periode);
  }

}

?>
