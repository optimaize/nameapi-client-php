<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/StructuredAddress.php');

/**
 * Builder for a StructuredAddress.
 *
 * <p>The setters don't do anything other than setting the value. They don't check if the value was
 * set already, they don't trim the values.</p>
 */
class StructuredAddressBuilder {

    /**
     * @var StreetInfo|null $streetInfo
     */
    private $streetInfo;
    /**
     * @var string|null $pobox
     */
    private $pobox;
    /**
     * @var PlaceInfo|null $placeInfo
     */
    private $placeInfo;


    function __construct() {
    }


    /**
     * @param StreetInfo|null $streetInfo
     * @return StructuredAddressBuilder
     */
    public function streetInfo($streetInfo) {
        $this->streetInfo = $streetInfo;
        return $this;
    }

    /**
     * @param string|null $pobox
     * @return StructuredAddressBuilder
     */
    public function pobox($pobox) {
        $this->pobox = $pobox;
        return $this;
    }

    /**
     * @param PlaceInfo|null $placeInfo
     * @return StructuredAddressBuilder
     */
    public function placeInfo($placeInfo) {
        $this->placeInfo = $placeInfo;
        return $this;
    }


    /**
     * @return StructuredAddress
     */
    public function build() {
        return new StructuredAddress(
            $this->streetInfo,
            $this->pobox,
            $this->placeInfo
        );
    }

}

