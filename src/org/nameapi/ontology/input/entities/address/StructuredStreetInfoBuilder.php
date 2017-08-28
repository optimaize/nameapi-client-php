<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/StructuredStreetInfo.php');

/**
 * Builder for a StructuredStreetInfo.
 *
 * <p>The setters don't do anything other than setting the value. They don't check if the value was
 * set already, they don't trim the values.</p>
 */
class StructuredStreetInfoBuilder {

    /**
     * @var string|null $streetName
     */
    private $streetName;
    /**
     * @var string|null $houseNumber
     */
    private $houseNumber;
    /**
     * @var string|null $building
     */
    private $building;
    /**
     * @var string|null $staircase
     */
    private $staircase;
    /**
     * @var string|null $floor
     */
    private $floor;
    /**
     * @var string|null $apartment
     */
    private $apartment;


    function __construct() {
    }


    /**
     * @param string|null $streetName
     * @return StructuredStreetInfoBuilder
     */
    public function streetName($streetName) {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @param string|null $houseNumber
     * @return StructuredStreetInfoBuilder
     */
    public function houseNumber($houseNumber) {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    /**
     * @param string|null $building
     * @return StructuredStreetInfoBuilder
     */
    public function building($building) {
        $this->building = $building;
        return $this;
    }

    /**
     * @param string|null $staircase
     * @return StructuredStreetInfoBuilder
     */
    public function staircase($staircase) {
        $this->staircase = $staircase;
        return $this;
    }

    /**
     * @param string|null $floor
     * @return StructuredStreetInfoBuilder
     */
    public function floor($floor) {
        $this->floor = $floor;
        return $this;
    }

    /**
     * @param string|null $apartment
     * @return StructuredStreetInfoBuilder
     */
    public function apartment($apartment) {
        $this->apartment = $apartment;
        return $this;
    }


    /**
     * @return StructuredStreetInfo
     */
    public function build() {
        return new StructuredStreetInfo(
            $this->streetName,
            $this->houseNumber,
            $this->building,
            $this->staircase,
            $this->floor,
            $this->apartment
        );
    }

}

