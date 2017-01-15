<?php

require_once("src/model/Alphabet.php");

echo "Testing Alphabet class... ".PHP_EOL;

$letters = Alphabet::getAllLetters();

# Testing that getAllLetters return 26 letters
$nbLetters = count($letters);
assert($nbLetters==26);

# Testing the content of getAllLetters
$aInArray = false;
$capitalAInArray = false;
$zeroInArray = false;
foreach ($letters as $char) {
    if ($char->getLetter()==='a') {
        $aInArray = true;
    } else if ($char->getLetter()==='A') {
        $capitalAInArray = true;
    } else if ($char->getLetter()==='0') {
        $zeroInArray = true;
    }
}
assert($aInArray);
assert(!$capitalAInArray);
assert(!$zeroInArray);

# Testing the isInAlphabet method
assert(Alphabet::isInAlphabet('a'));
assert(!Alphabet::isInAlphabet('A'));
assert(!Alphabet::isInAlphabet('0'));

echo "Testing Alphabet class: done.".PHP_EOL;

?>
