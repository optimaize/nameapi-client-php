<?php

namespace org\nameapi\ontology\input\context;

class ContextBuilder {

    private $apiKey = null;
    private $priority = null;
    private $geo = null;
    private $properties = null;
    private $textCase = null;


    /**
     * @param string $apiKey
     * @return ContextBuilder
     */
    function apiKey($apiKey) {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @param string $geo
     * @return ContextBuilder
     */
    function geo($geo) {
        $this->geo = $geo;
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
        return new Context($this->apiKey, $this->priority, $this->geo, $this->textCase, $this->properties);
    }

}
