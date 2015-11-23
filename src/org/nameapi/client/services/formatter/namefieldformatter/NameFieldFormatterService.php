<?php

namespace org\nameapi\client\services\formatter\namefieldformatter;

use org\nameapi\client\services\BaseService;
use org\nameapi\client\services\formatter\FormatterProperties;
use org\nameapi\client\services\formatter\FormatterResult;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\name\NameField;


/**
 *
 */
class NameFieldFormatterService extends BaseService {

    private static $RESOURCE_PATH = "formatter/namefieldformatter";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NameField $nameField
     * @param FormatterProperties $properties
     * @return FormatterResult
     */
    public function format(NameField $nameField, FormatterProperties $properties) {
        throw new \Exception("Method not implemented as of now.", 501);
    }

} 