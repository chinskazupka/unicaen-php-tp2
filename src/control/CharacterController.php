<?php
//I desactivated it as we deleted this model
//require_once("model/Alphabet.php");

/**
 * A controller for actions about characters.
 * @author Alexandre Niveau and Bruno Zanuttini, Université de Caen Normandie, France
 */
class CharacterController {

    /** The view to be used by this controller for HTML rendering. */
    protected $view;

    /**
     * Builds a new instance.
     * @param $view The view to be used by this controller for HTML rendering
     */
    public function __construct (View $view) {
        $this->view = $view;
    }

    /**
     * Prepares the view for rendering information about a given character.
     * @param $char A character
     * @throws Exception If the character is not one in the Latin alphabet
     */
    public function showInformation ($char) {
        $letter = new Character ($char);
        $this->view->makeLetterPage($letter);
    }

    /**
     * Prepares the view for rendering information about the whole alphabet.
     */
    public function showAlphabet () {
        $letters = Alphabet::getAllLetters();
        $this->view->makeLetterListPage($letters,"L'alphabet français");
    }

}

?>
