<?php

namespace org\nameapi\ontology\input\entities\contact;

require_once(__DIR__.'/EmailAddress.php');

class EmailAddressFactory {

    /**
     * @param $string
     * @return EmailAddress
     */
    static function forAddress($string) {
        return new EmailAddress($string);
    }

}
