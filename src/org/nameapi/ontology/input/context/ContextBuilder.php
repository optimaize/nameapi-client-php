<?php

namespace org\nameapi\ontology\input\context;

class ContextBuilder {

    private $priority   = null;
    private $place      = null;
    private $properties = null;
    private $textCase   = null;


    /**
     * @param string $place
     * @return ContextBuilder
     */
    function place($place) {
        $this->place = $place;
        return $this;
    }

    /**
     * @param Priority $priority
     * @return ContextBuilder
     */
    function priority($priority) {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @param TextCase $textCase
     * @return ContextBuilder
     */
    function textCase($textCase) {
        $this->textCase = $textCase;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return ContextBuilder
     */
    function property($key, $value) {
        if ($this->properties==null) $this->properties = array();
        $this->properties[$key] = $value;
        return $this;
    }


    /**
     * @return Context
     */
    function build() {
        return new Context($this->priority, $this->place, $this->textCase, $this->properties);
    }

}
