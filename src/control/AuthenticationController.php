<?php

class AuthenticationController {

    const SECRET_CODE = "1234";

    protected $router;
    protected $id;

    public function __construct (Router $router, $id) {
        $this->router = $router;
        $this->id = $id;
    }

    public function isVisitorLoggedIn () {
        return array_key_exists($this->id."_loggedIn",$_SESSION);
    }

    public function login ($data) {
        if (array_key_exists($this->getPasswordReference(),$data)
            && $data[$this->getPasswordReference()] == AuthenticationController::SECRET_CODE) {

            $_SESSION[$this->id."_loggedIn"] = true;
            $this->router->redirect($this->router->getPrivateWelcomeURL());

        } else {

            $this->router->redirect($this->router->getBadLoginURL());

        }
    }

    public function getPasswordReference () {
        return $this->id."_password";
    }

    public function logout () {
        unset($_SESSION[$this->id."_loggedIn"]);
        $this->router->redirect($this->router->getDefaultURL());
    }

}

?>
