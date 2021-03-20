<?php

namespace Org\NameApi\Ontology\Input\Entities\Contact;

class TelNumberFactory
{

    /**
     * @param $string
     * @return TelNumber
     */
    static function forNumber($string)
    {
        return new TelNumber($string);
    }

}
