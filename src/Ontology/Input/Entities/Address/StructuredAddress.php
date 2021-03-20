<?php

namespace Org\NameApi\Ontology\Input\Entities\Address;

/**
 * An address where the individual parts (street name, postal code, ...) are structured into separate values.
 *
 * @see StructuredAddressBuilder
 */
class StructuredAddress extends InputAddress
{

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
    public function __construct($streetInfo, $pobox, $placeInfo)
    {
        $this->streetInfo = $streetInfo;
        $this->pobox = $pobox;
        $this->placeInfo = $placeInfo;
    }

    /**
     * @return StructuredAddressBuilder
     */
    static function builder()
    {
        return new StructuredAddressBuilder();
    }

}

