<?php

require_once("control/CharacterController.php");
require_once("views/View.php");
//we deleted this line:
//require_once("model/Alphabet.php");

/**
 * A class for handling URLs, namely, parsing URLs and transferring control to appropriate controllers,
 * and giving URLs for the various actions on the web site. This class is intended to be the only class
 * aware of URLs on the web site.
 * @author Alexandre Niveau and Bruno Zanuttini, Université de Caen Normandie, France
 */
class Router {

    /** The prefix for URLs rooted by this instance. */
    protected $baseURL;

    /** The prefix for URLs of resources directly accessible via get requests. */
    protected $webBaseURL;

    /** The current view. */
    private $view;

    /**
     * Builds a new instance.
     * @param $baseURL The prefix for URLs rooted by this instance (e.g., "http://domain.com/index"
     * will yield URLs of the form "http://domain.com/index/path/to/resource"); the prefix should not
     * include a trailing "/"
     * @param $webBaseURL The prefix for URLs of resources directly accessible via get requests
     * (css, js, image files, etc.); for instance, "http://domain.com" will yield URLs of the
     * form "http://domain.com/css/stylesheet.css"); the prefix should not
     * include a trailing "/"
     */
    public function __construct ($baseURL, $webBaseURL) {
        $this->baseURL = $baseURL;
        $this->webBaseURL = $webBaseURL;
    }

    /**
     * Handles the current request, by transferring control to the appropriate controller/view.
     */
    public function main () {

        // Instantiating view
        $this->view = new View ($this);

        // Transferring control depending on URL
        try {

            $route = getenv('PATH_INFO');

            if ($route == "/accueil") {
                $this->view->makeWelcomePage();
            }
            //I don't think this is ncessary anymmore
            /*
            else if ($route == "/log_prop_uti") {
                $controller = new appartController ($this->view);
                $controller->showAlphabet();
            }

         else if (strlen($route) == 2 && Alphabet::isInAlphabet(substr($route,1,1))) {
                $controller = new CharacterController ($this->view);
                $controller->showInformation(substr($route,1,1));
            }*/

            else if ($route == "/log_prop_uti") {
                $controller = new ClassController ($this->view); //seulement si on veut une page pas statique que tire de base des donneees (meme une fausse)
                $controller->functionThatShowsTheWantedListfromView();
            }

            else {
                $this->view->makeUnknownURLPage($route); //blad prof
            }

        } catch (Exception $e) {
            // Generic error
            $this->view->makeUnexpectedErrorPage($e);
        }

        // Rendering view
        $this->view->render();
    }

    // Construction of URLS ===================================

    /**
     * Returns the URL of the welcome page.
     * @return A string
     */
    public function getWelcomeURL () {
        return $this->baseURL."/accueil";
    }

    /**
     * Returns the URL of the page of appartaments and houses peroposed by user
     * @return A string
     */

    public function getLogPropUtiURL () {
        return $this->baseURL."/log_prop_uti";
    }

    /**
     * Returns the URL of the welcome page of appartaments and houses searched by user
     * @return A string
     */

    public function getLogDemUtiURL () {
        return $this->baseURL."/log_dem_uti";
    }

    /**
     * Returns the URL of the welcome of appartaments and houses peroposed in different countries
     * @return A string
     */

    public function getLogPropPaysURL () {
        return $this->baseURL."/log_prop_pays";
    }

    /**
     * Returns the URL of the welcome page ppartaments and housessearched in different countries
     * @return A string
     */

    public function getLogDemPaysURL () {
        return $this->baseURL."/log_dem_pays";
    }

    //inutiles

    /**
     * Returns the URL of the information page about a given letter.
     * @param $letter The letter about which to display information
     * @return A string
     */     /*
    public function getInformationURL ($url) {
        return $this->baseURL."/".$url;
    }*/

    /**
     * Returns the URL of the page about the alphabet.
     * @return A string
     *//*
    public function getAlphabetURL () {
        return $this->baseURL."/alphabet";
    }*/

    /**
     * Returns the URL of a given file directly accessible via get requests.
     * @param $path The path of a file relative to the root of this web site
     * (without the leading "/")
     * @return A string
     */
    public function getURL ($path) {
        return $this->webBaseURL."/web/".$path;
    }

}

?>
