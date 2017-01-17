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

//new
  public function logementToHTML(){
    $res="";
    $res.=parent::logementToHTML();
    $res.= "<td>".$logement->getSurfaceExt()."</td>";
    return $res;
  }


  function __destruct(){
    unset($this->$user);
    unset($this->$pays);
    unset($this->$surface);
    unset($this->$nb_piece);
    unset($this->$adresse);
    unset($this->$periode);
    unset($this->$surfaceExt);
  }

}

?>
