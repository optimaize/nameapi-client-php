<?php

namespace org\nameapi\ontology\input\entities\address;


/**
 * Lists the possible purposes of an InputAddress.
 *
 * Possible values are: DOMICILE, CORRESPONDENCE, INVOICE, DELIVERY, OTHER
 *
 * @package org\nameapi\ontology\input\entities\address
 */
final class AddressUsage {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='DOMICILE' && $value!='CORRESPONDENCE' && $value!='INVOICE' && $value!='DELIVERY' && $value!='OTHER') {
            throw new \Exception('Invalid value for AddressUsage: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

