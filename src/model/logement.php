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

  //getters
  public function getUser(){ return $this->user;}
  public function getPays(){ return $this->pays;}
  public function getSurface(){ return $this->surface;}
  public function getNbPiece(){ return $this->nb_piece;}
  public function getAdresse(){ return $this->adresse;}
  public function getPeriode(){ return $this->periode;}

  //setters
  public function setUser($d) { $this->user=$d;}


  public function logementToHTML(){
    $res="";
    $res.="<td>".$this->user."</td>";
    $res.="<td>".$this->pays."</td>";
    $res.="<td>".$this->surface."</td>";
    $res.="<td>".$this->nb_piece."</td>";
    $res.="<td>".$this->adresse."</td>";
    $res.="<td>".$this->periode."</td>";
    return $res;
  }

//abstract = tant que il n'y à pas d'information à ce sujet, la fonction est définie dans les autres classes
  public abstract function getSurfaceExt();


/*
  function __destruct(){
    unset($this->$user);
    unset($this->$pays);
    unset($this->$surface);
    unset($this->$nb_piece);
    unset($this->$adresse);
    unset($this->$periode);
  }
*/


}

?>
