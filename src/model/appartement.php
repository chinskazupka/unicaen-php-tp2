<?php

class appartement extends logement{

  public function __construct ($user, $pays, $surface, $nb_piece, $adresse, $periode){
    parent::__construct ($user, $pays, $surface, $nb_piece, $adresse, $periode);
  }

  public function getSurfaceExt(){
    return 0;
  };


  //new
    public function appartementToHTML(){
      $res="";
      $res.="<td>".$appartement->getUser()."</td>";
      $res.="<td>".$appartement->getPays()."</td>";
      $res.="<td>".$appartement->getSurface()."</td>";
      $res.= "<td>".$appartement>getNbPiece()."</td>";
      $res.= "<td>".$appartement->getAdresse()."</td>";
      $res.= "<td>".$appartement->getSurfaceExt()."</td>";
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
