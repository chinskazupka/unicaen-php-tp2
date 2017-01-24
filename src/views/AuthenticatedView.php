<?php

include_once("model/logement.php");

/**
 * A class for preparing and rendering pages for the minimal web site.
 * The basic usage of this class consists of calling one of the "makeXXXPage" methods, then
 * calling the "render" method.
 * @author Alexandre Niveau and Bruno Zanuttini, Université de Caen Normandie, France
 */
class AuthenticatedView extends View{

    /** The title for this page (prepared by the "makeXXXPage" methods). */
    private $title;

    /** The URL to the stylesheet for this page. */
    private $styleSheetURL;

    /** The main content for this page (prepared by the "makeXXXPage" methods). */
    private $content;

    // Generic methods ========================================================================

    /**
     * Builds a new instance.
     * @param $router The router handling URLs
     */
    public function __construct (Router $router) {
        $this->router = $router;
        $this->title = null;
        $this->styleSheetURL = $router->getURL("minimalsite.css");
        $this->content = null;
    }

    // Methods for preparing specific pages ========================================================



    //$logement=new logement();

    /**
     * Prepares a page showing information about a given list of letters.
     * @param $chars An array of characters (as instances of class Character)
     * @param $title The title for this page
     */
    /*public function makeAppartementList (array $logement_list, $title) {

        $this->title = $title;
        $this->content = "<table>";
        $this->content.= "<tr><th>Utilisateur</th><th>Pays</th><th>Surface</th><th>Nombre de pièces</th><th>Adresse</th>";

        foreach ($logement_list as $logement) {
          if ($logement->getSurfaceExt()>0){
            $this->content.="<th>Surface Exterieure</th>";
            break;
          }

        }
        $this->content.="</tr>";

        foreach ($logement_list as $logement) {
          $this->content.="<tr>";
          $this->content.=$logement->logementToHTML();
          if ($logement->getSurfaceExt()>0){
            $this->content.="<td>".$logement->getSurfaceExt()."</td>";
          }
        }
        $this->content.= "</table>";
    }*/



    public function makeProposedHousing (array $housing, $user) {

        $this->title = 'Logement proposé par '.$user;
        $this->content = "<table>";
        $this->content.= "<tr><th>Utilisateur</th><th>Pays</th><th>Surface</th><th>Nombre de pièces</th><th>Adresse</th><th>Date</th>";

        foreach ($housing as $logement) {
          if ($logement->getSurfaceExt()>0){
            $this->content.="<th>Surface Exterieure</th>";
            break;
          }

        }
        $this->content.="</tr>";

        foreach ($housing as $logement) {
          $this->content.="<tr>";
          $this->content.=$logement->logementToHTML();
          if ($logement->getSurfaceExt()>0){
            $this->content.="<td>".$logement->getSurfaceExt()."</td>";
          }
        }
        $this->content.= "</table>";
    }



    /**
     * Prepares a page explaining that the required URL does not exist.
     * @param $url The unknown url
     */
    public function makeUnknownURLPage ($url) {
        $this->title="Erreur";
        $this->content=file_get_contents("fragments/unknownURL.html",true);
    }

    /**
     * Prepares a page explaining that an unexpected exception or error occurred.
     * @param $e The (unexpected) exception or error raised
     */
    public function makeUnexpectedErrorPage ($e) {
        $this->title="Erreur: ".$e;
        $this->content=file_get_contents("fragments/unexpectedError.html",true);
    }

    /**
     * Prepares a page welcoming the user to the private part of the web site.
     */
    public function makePrivateWelcomePage () {
        $this->title = "Vous êtes connecté";
        $this->content = "<p>Découvrez maintenant notre mine d'information.</p>".PHP_EOL;
    }

    // Helper method ========================================================

    /**
     * Returns a menu for all pages.
     * @return An associative array $url => $text
     */
    protected function getMenu () {
        return array(
            $this->router->getWelcomeURL() => "Accueil",
            $this->router->getLogPropUtiURL() => "Logements proposés par un utilisateur",
            $this->router->getLogDemUtiURL() => "Logements demandés par un utilisateur",
            $this->router->getLogPropPaysURL() => "Logements proposés dans un pays",
            $this->router->getLogDemPaysURL() => "Logements demandés dans un pays",
        );
    }

    /**
     * Returns a widget for logging out.
     * @return A string representing HTML code.
     */
    protected function getLogbox () {
      return "<a href=\"".$this->router->getLogoutURL()."\">déconnexion</a>";
    }

}

?>
