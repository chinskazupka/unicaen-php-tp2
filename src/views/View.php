<?php

include_once("model/logement.php");
/**
 * A class for preparing and rendering pages for the minimal web site.
 * The basic usage of this class consists of calling one of the "makeXXXPage" methods, then
 * calling the "render" method.
 * @author Alexandre Niveau and Bruno Zanuttini, Université de Caen Normandie, France
 */
class View {

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

    /**
     * Renders the prepared page. If no page has been prepared, then makeUnexpectedErrorPage() is called first.
     */
    public function render () {
        if ($this->title===null || $this->content===null) {
            $this->makeUnexpectedErrorPage(new Exception ("Tried to render a view with null title or content"));
        }
        // Now $this->title and $this->content are nonnull
        $title = $this->title;
        $styleSheetURL = $this->styleSheetURL;
        $content = $this->content;
        $menu = $this->getMenu();
        include("template.php");
    }

    // Methods for preparing specific pages ========================================================

    /**
     * Prepares a page welcoming the user to the web site.
     */
    public function makeWelcomePage () {
        $this->title = "Site d'échange de logements";
        $this->content = file_get_contents("fragments/welcome.html",true);
    }

    $logement=new logement();

    /**
     * Prepares a page showing information about a given list of letters.
     * @param $chars An array of characters (as instances of class Character)
     * @param $title The title for this page
     */
    public function makeAppartementList (array $logement_list, $title) {

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

    // Helper method ========================================================

    /**
     * Returns a menu for all pages.
     * @return An associative array $url => $text
     */
    protected function getMenu () {
        return array(
            $this->router->getWelcomeURL() => "Accueil",
            $this->router->getInformationURL('log_prop_uti') => "Logements proposés par un utilisateur",
            $this->router->getInformationURL('log_dem_uti') => "Logements demandés par un utilisateur",
            $this->router->getInformationURL('log_prop_pays') => "Logements proposés dans un pays",
            $this->router->getInformationURL('log_dem_pays') => "Logements demandés dans un pays",
            // $this->router->getAlphabetURL() => "l'alphabet français"
            // supprimer getAlphabetURL
        );
    }

}

?>
