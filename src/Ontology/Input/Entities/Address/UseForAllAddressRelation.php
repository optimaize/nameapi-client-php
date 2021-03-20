<?php

namespace Org\NameApi\Ontology\Input\Entities\Address;

/**
 * An address relation that specifies that the address is used for all purposes.
 *
 * <p>This is the case when only one address is known from the InputPerson.</p>
 */
class UseForAllAddressRelation extends AddressRelation
{

    /**
     * Used for JSON marshalling only.
     */
    public $type = 'UseForAllAddressRelation';

    /**
     * @var InputAddress $address
     */
    public $address;


    /**
     * UseForAllAddressRelation constructor.
     * @param InputAddress $address
     */
    public function __construct(InputAddress $address)
    {
        $this->address = $address;
    }

}

