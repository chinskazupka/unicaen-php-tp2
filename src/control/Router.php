<?php

require_once("control/AuthenticationController.php");
require_once("control/CharacterController.php");
require_once("views/View.php");
require_once("views/AuthenticatedView.php");
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

      session_start();

      // Creating authentication controller
      if (!isset($_SESSION["auth"])) {
          $_SESSION["auth"] = new AuthenticationController ($this,"auth");
      }
      $authController = $_SESSION["auth"];

      // Instantiating view
      if ($authController->isVisitorLoggedIn()) {
          $this->view = new AuthenticatedView ($this,$authController->getPasswordReference());
      } else {
          $this->view = new View ($this,$authController->getPasswordReference());
      }

        // Transferring control depending on URL
        try {

            $route = getenv('PATH_INFO');


            // Checking permissions
            if (! $this->refersToPublicPage($route) && ! $authController->isVisitorLoggedIn()) {
                $this->view->makeUnauthorizedPage($route);
            }

            else if ($route == "/accueil") {
                $this->view->makeWelcomePage();
            }

            else if ($route == "/connecte") {
                $this->view->makePrivateWelcomePage();
            }

             else if ($route == "/entrer") {
                $authController->login($_POST);
            }

            else if ($route == "/badlogin") {
                $this->view->makeBadLoginPage();
            }

            else if ($route == "/sortir") {
                $authController->logout();
            }

            else if ($route == "/log_prop_uti") {
                $controller = new Controller ($this->view); //seulement si on veut une page pas statique que tire de base des donneees (meme une fausse)
                $user='toto';
                $controller->showProposedHousing($user);
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
     * Returns the URL of the private welcome page.
     * @return A string
     */
    public function getPrivateWelcomeURL () {
        return $this->baseURL."/connecte";
    }

    /**
     * Returns the URL to which login attempts must be posted.
     * @return A string
     */
    public function getLoginURL () {
        return $this->baseURL."/entrer";
    }


    /**
     * Returns the URL to which login attempts must be posted.
     * @return A string
     */
    public function getLogoutURL () {
        return $this->baseURL."/sortir";
    }

    /**
     * Returns the URL of the page of appartaments and houses peroposed by user
     * @return A string
     */

    public function getLogPropUtiURL() {
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

    /**
     * Redirects to a given url.
     * @param $url The URL to redirect to
     */
    public function redirect ($url) {
        header("HTTP/1.1 303 See Other");
        header("Location: ".$url);
        exit();
    }


    /**
     * Returns the URL of a given file directly accessible via get requests.
     * @param $path The path of a file relative to the root of this web site
     * (without the leading "/")
     * @return A string
     */
    public function getURL ($path) {
        return $this->webBaseURL."/web/".$path;
    }

    /**
     * Returns a default public URL for visitors.
     * @return A string
     */
    public function getDefaultURL () {
        return $this->getWelcomeURL();
    }

    /**
     * Decides whether a given URL is public.
     * @param $url A URL for the web site (starting with $this->baseURL), possibly including the query string.
     * @return true if the URL is public, false otherwise.
     */
    public function isPublic ($url) {
        $route = substr($url,strlen($this->baseURL));
        return $this->refersToPublicPage($route);
    }

    /**
     * Decides whether a given route refers to a public page.
     * @param $route A route (path info)
     * @return true if the route refers to a public URL, false otherwise.
     */
    public function refersToPublicPage ($route) {
        return $route=="/accueil" || $route=="/badlogin" || $route=="/entrer";
    }


}

?>
