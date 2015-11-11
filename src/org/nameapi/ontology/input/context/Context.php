<?php

namespace org\nameapi\ontology\input\context;

include_once('ContextBuilder.php');
include_once('TextCase.php');
include_once('Priority.php');


class Context {

    private $apiKey = null;
    private $priority = null;
    private $place = null;
    private $textCase = null;
    private $properties = null;

    static function builder() {
        return new ContextBuilder();
    }

    /**
     * @param string $apiKey
     * @param priority $priority
     * @param string $place
     * @param TextCase $textCase
     * @param array $properties
     * @access public
     */
    public function __construct($apiKey, $priority, $place, $textCase, $properties) {
        $this->apiKey = $apiKey;
        $this->priority = $priority;
        $this->place = $place;
        $this->textCase = $textCase;
        $this->properties = isSet($properties) ? $properties : array();
    }



    /**
     * @return null|string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @return null|string
     */
    public function getPlace() {
        return $this->place;
    }

    /**
     * @return null|Priority
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * @return null|TextCase
     */
    public function getTextCase() {
        return $this->textCase;
    }

    /**
     * @return null|array
     */
    public function getProperties() {
        return $this->properties;
    }

}
