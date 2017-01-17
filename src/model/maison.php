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
  public function maisonToHTML(){
    $res="";
    $res.="<td>".$maison->getUser()."</td>";
    $res.="<td>".$maison->getPays()."</td>";
    $res.="<td>".$maison->getSurface()."</td>";
    $res.= "<td>".$maison->getNbPiece()."</td>";
    $res.= "<td>".$maison->getAdresse()."</td>";
    $res.= "<td>".$maison->getSurfaceExt()."</td>";
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
