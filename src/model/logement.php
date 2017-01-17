<?php

abstract class logement{

  public $user;
  public $pays;
  public $surface;
  public $nb_piece;
  public $adresse;
  public $periode;

  public function __construct ($user, $pays, $surface, $nb_piece, $adresse, $periode){
    $this->user=$user;
    $this->pays=$pays;
    $this->surface=$surface;
    $this->nb_piece=$nb_piece;
    $this->adresse=$adresse;
    $this->periode=$periode;
  }

  public function logementToHTML(){
    $res="";
    $res.="<td>".$logement->getUser()."</td>";
    $res.="<td>".$logement->getPays()."</td>";
    $res.="<td>".$logement->getSurface()."</td>";
    $res.= "<td>".$logement->getNbPiece()."</td>";
    $res.= "<td>".$logement->getAdresse()."</td>";
    return $res;
  }

//abstract = tant que il n'y à pas d'information à ce sujet, la fonction est définie dans les autres classes
  public abstract function getSurfaceExt();

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
