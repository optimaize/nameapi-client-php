<?php

namespace Org\NameApi\Ontology\Input\Context;

class Context
{

    public $priority = null;
    public $place = null;
    public $textCase = null;
    public $properties = null;

    /**
     * @param priority $priority
     * @param string $place
     * @param TextCase $textCase
     * @param array $properties
     * @access public
     */
    public function __construct($priority, $place, $textCase, $properties)
    {
        $this->priority = ($priority == null) ? null : (string)$priority;
        $this->place = $place;
        $this->textCase = ($textCase == null) ? null : (string)$textCase;
        $this->properties = isset($properties) ? $properties : array();
    }

    static function builder()
    {
        return new ContextBuilder();
    }

    /**
     * @return string|null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return string|null
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @return string|null
     */
    public function getTextCase()
    {
        return $this->textCase;
    }

    /**
     * @return array|null
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
