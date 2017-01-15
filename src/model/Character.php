<?php

/**
 * A class representing letters in the Latin alphabet.
 * @author Alexandre Niveau and Bruno Zanuttini, Université de Caen Normandie, France
 */
class Character {

    /** The letter. */
    protected $char;

    /** The rank of the letter in the alphabet. */
    protected $rank;

    /**
     * Builds a new instance.
     * @param $char A letter
     * @throws Exception if the given character is not a letter in the Latin alphabet
     */
    public function __construct ($char) {
        if (ord($char)<ord('a') || ord($char)>ord('z')) {
            throw new Exception ("Cannot build an instance of character for character '"+$char+"', is not in the Latin alphabet");
        }
        $this->char = $char;
        $this->rank = ord($char)-ord('a')+1;
    }

    /**
     * Returns the letter represented by this character.
     * @returns A character
     */
    public function getLetter () {
        return $this->char;
    }

    /**
     * Returns the rank of this letter in the alphabet (1 for 'a', 2 for 'b', etc.).
     * @returns An integer
     */
    public function getRank () {
        return $this->rank;
    }

}

?>
