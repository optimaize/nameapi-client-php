<?php

namespace Org\NameApi\Ontology\Input\Entities\Contact;

class EmailAddress
{

    /**
     * Used for JSON marshalling only.
     */
    public $type = 'EmailAddressImpl';

    /**
     * @var string $emailAddress
     */
    public $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

}
