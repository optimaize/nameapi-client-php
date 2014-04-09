<?php

namespace org\nameapi\client\services\formatter;

use org\nameapi\ontology\input\context\Context;

require_once('PersonNameFormatterService.php');
require_once('NameFieldFormatterService.php');


/**
 *
 */
class FormatterServiceFactory {

    private $context;
    private $personNameFormatterService;
    private $nameFieldFormatterService;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * @return PersonNameFormatterService
     */
    public function personNameFormatter() {
        if ($this->personNameFormatterService==null) {
            $this->personNameFormatterService = new PersonNameFormatterService($this->context);
        }
        return $this->personNameFormatterService;
    }

    /**
     * @return NameFieldFormatterService
     */
    public function nameFieldFormatter() {
        if ($this->nameFieldFormatterService==null) {
            $this->nameFieldFormatterService = new NameFieldFormatterService($this->context);
        }
        return $this->nameFieldFormatterService;
    }

}
