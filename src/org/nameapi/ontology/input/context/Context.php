<?php

namespace org\nameapi\ontology\input\context;

include_once('ContextBuilder.php');
include_once('TextCase.php');
include_once('Priority.php');


class Context {

    public $priority = null;
    public $place = null;
    public $textCase = null;
    public $properties = null;

    static function builder() {
        return new ContextBuilder();
    }

    /**
     * @param priority $priority
     * @param string $place
     * @param TextCase $textCase
     * @param array $properties
     * @access public
     */
    public function __construct($priority, $place, $textCase, $properties) {
        $this->priority = ($priority==null) ? null : (string)$priority;
        $this->place = $place;
        $this->textCase = ($textCase==null) ? null : (string)$textCase;
        $this->properties = isSet($properties) ? $properties : array();
    }

}
