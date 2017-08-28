<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/StructuredPlaceInfo.php');

/**
 * Builder for a StructuredPlaceInfo.
 *
 * <p>The setters don't do anything other than setting the value. They don't check if the value was
 * set already, they don't trim the values.</p>
 */
class StructuredPlaceInfoBuilder {

    /**
     * @var string|null $locality
     */
    private $locality = null;
    /**
     * @var string|null $postalCode
     */
    private $postalCode;
    /**
     * @var string|null $neighborhood
     */
    private $neighborhood;
    /**
     * @var string|null $region
     */
    private $region;
    /**
     * @var string|null $country
     */
    private $country;


    function __construct() {
    }


    /**
     * Also known as place name, city etc.
     *
     * @param string|null $locality
     * @return StructuredPlaceInfoBuilder
     */
    public function locality($locality) {
        $this->locality = $locality;
        return $this;
    }

    /**
     * Also known as zip code in the USA.
     *
     * @param string|null $postalCode
     * @return StructuredPlaceInfoBuilder
     */
    public function postalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @param string|null $neighborhood
     * @return StructuredPlaceInfoBuilder
     */
    public function neighborhood($neighborhood) {
        $this->neighborhood = $neighborhood;
        return $this;
    }

    /**
     * @param string|null $region
     * @return StructuredPlaceInfoBuilder
     */
    public function region($region) {
        $this->region = $region;
        return $this;
    }

    /**
     * Either fully spelled out such as "Germany" or the ISO 3166 alpha-2 code such as "DE".
     *
     * @param string|null $country
     * @return StructuredPlaceInfoBuilder
     */
    public function country($country) {
        $this->country = $country;
        return $this;
    }


    /**
     * @return StructuredPlaceInfo
     */
    public function build() {
        return new StructuredPlaceInfo(
            $this->locality,
            $this->postalCode,
            $this->neighborhood,
            $this->region,
            $this->country
        );
    }


}

