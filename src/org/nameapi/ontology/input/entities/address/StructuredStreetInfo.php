<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/StreetInfo.php');

/**
 * @see StructuredStreetInfoBuilder
 */
class StructuredStreetInfo extends StreetInfo {

    /**
     * @return StructuredStreetInfoBuilder
     */
    static function builder() {
        return new StructuredStreetInfoBuilder();
    }

    /**
     * Used for JSON marshalling only.
     */
    public $type = 'StructuredStreetInfo';


    /**
     * @var string|null $streetName
     */
    public $streetName;
    /**
     * @var string|null $houseNumber
     */
    public $houseNumber;
    /**
     * @var string|null $building
     */
    public $building;
    /**
     * @var string|null $staircase
     */
    public $staircase;
    /**
     * @var string|null $floor
     */
    public $floor;
    /**
     * @var string|null $apartment
     */
    public $apartment;


    /**
     * StructuredStreetInfo constructor.
     * @param string $streetName
     * @param string $houseNumber
     * @param string $building
     * @param string $staircase
     * @param string $floor
     * @param string $apartment
     */
    public function __construct($streetName, $houseNumber, $building, $staircase, $floor, $apartment) {
        $this->streetName = $streetName;
        $this->houseNumber = $houseNumber;
        $this->building = $building;
        $this->staircase = $staircase;
        $this->floor = $floor;
        $this->apartment = $apartment;
    }

}

