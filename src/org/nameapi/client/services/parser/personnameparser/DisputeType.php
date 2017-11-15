<?php

namespace org\nameapi\client\services\parser\personnameparser;


/**
 * Class DisputeType
 *
 * Possible values are:
 *
 * GENDER
 * The gender of the name, as it was interpreted, contradicts the gender of the input person.
 * Either the person was entered with a gender (male or female), and the name is used for the
 * other gender. For example female Daniel.
 * Or the Gender was found in the name itself, such as "Mr. Daniela Johnson", and contradicts the
 * name.
 *
 * There are 3 possibilities here.
 * 1) the gender is wrong (or the gender-specific term like salutation "Mr.")
 * 2) the gender is right, but the name is misspelled (eg Daniel instead of Daniela, or Karim instead of Karin)
 * 3) all input is correct, but the system thinks otherwise because it doesn't know that name in that
 *    culture yet. For example a Turkish name could be neutral, but is stored as male, and therefore
 *    says for the female person the gender contradicts.
 *
 * SPELLING
 * The input name is, as it was interpreted, spelled incorrectly.
 * There are 2 possibilities here.
 * 1) the input name is misspelled
 * 2) the input name is correctly spelled, but is rare (more rare than the misspelling) or not known by the system.
 *
 * TRANSPOSITION
 * Aka swapped names, eg gn in sn field and vice versa.
 * @since 5.3
 *
 * DUPLICATE_CONTENT
 * EG the surname appears [Peter Smith, Smith] or the title [Dr, Dr John, Smith]
 * @since 5.3
 *
 * SYNTAX
 * When the string is syntactically broken and needs a fix, eg comma or dot in the wrong place, spacing errors.
 * @since 5.3
 *
 */
final class DisputeType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='GENDER' && $value!=='SPELLING' && $value!=='TRANSPOSITION' && $value!=='DUPLICATE_CONTENT' && $value!=='SYNTAX') {
            throw new \Exception('Invalid value for DisputeType: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

