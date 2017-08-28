<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/PlaceInfo.php');

/**
 * @see StructuredPlaceInfoBuilder
 */
class StructuredPlaceInfo extends PlaceInfo {

    /**
     * @return StructuredPlaceInfoBuilder
     */
    static function builder() {
        return new StructuredPlaceInfoBuilder();
    }


    /**
     * @var string|null $locality
     */
    public $locality;
    /**
     * @var string|null $postalCode
     */
    public $postalCode;
    /**
     * @var string|null $neighborhood
     */
    public $neighborhood;
    /**
     * @var string|null $region
     */
    public $region;
    /**
     * @var string|null $country
     */
    public $country;

    /**
     * @param string $locality
     * @param string $postalCode
     * @param string $neighborhood
     * @param string $region
     * @param string $country
     */
    public function __construct($locality, $postalCode, $neighborhood, $region, $country) {
        $this->locality     = $locality;
        $this->postalCode   = $postalCode;
        $this->neighborhood = $neighborhood;
        $this->region       = $region;
        $this->country      = $country;
    }


    public function jsonSerialize() {
        return array(
            'type'           => "StructuredPlaceInfo",
            'locality'       => $this->locality,
            'postalCode'     => $this->postalCode,
            'neighborhood'   => $this->neighborhood,
            'region'         => $this->region,
            'country'        => $this->country,
        );
    }

}

