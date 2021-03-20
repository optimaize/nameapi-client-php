<?php

namespace Org\NameApi\Ontology\Input\Entities\Contact;

class EmailAddressFactory
{

    /**
     * @param $string
     * @return EmailAddress
     */
    static function forAddress($string)
    {
        return new EmailAddress($string);
    }

}
