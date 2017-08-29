<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/InputAddress.php');
require_once(__DIR__.'/StructuredStreetInfoBuilder.php');
require_once(__DIR__.'/StructuredPlaceInfoBuilder.php');

/**
 * An address where the individual parts (street name, postal code, ...) are structured into separate values.
 *
 * @see StructuredAddressBuilder
 */
class StructuredAddress extends InputAddress {

    /**
     * @return StructuredAddressBuilder
     */
    static function builder() {
        return new StructuredAddressBuilder();
    }

    /**
     * Used for JSON marshalling only.
     */
    public $type = 'StructuredAddress';

    /**
     * @var StreetInfo|null $streetInfo
     */
    public $streetInfo;
    /**
     * @var string|null $pobox
     */
    public $pobox;
    /**
     * @var PlaceInfo|null $placeInfo
     */
    public $placeInfo;

    /**
     * @param StreetInfo $streetInfo
     * @param string $pobox
     * @param PlaceInfo $placeInfo
     */
    public function __construct($streetInfo, $pobox, $placeInfo) {
        $this->streetInfo = $streetInfo;
        $this->pobox = $pobox;
        $this->placeInfo = $placeInfo;
    }

}

